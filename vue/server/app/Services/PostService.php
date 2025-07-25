<?php

namespace App\Services;

use App\Models\Hashtag;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class PostService
{
    public function list(int|null $page = 1)
    {
        $posts = Post::with('user.subscribers')->orderBy('created_at', 'desc')->paginate(5, page: $page);
        return $posts;
    }

    public function create(int $userId, string $text)
    {
        $post = Post::create([
            'user_id' => $userId,
            'text' => $text
        ]);

        preg_match_all("/(@[^@]+@)|(#[^#]+#)/u", $post->text, $matches);
        foreach ($matches[1] as $userNameTag) {
            $user = User::where(column: 'name', operator: substr($userNameTag, offset: 1, length: -1))->first();
            if ($user) {
                $post->user_tags()->attach($user->id);
            }
        }
        foreach ($matches[2] as $tag) {
            $hashtagName = substr($tag, 1, -1);
            $hashtag = Hashtag::where('name', $hashtagName)->first();
            if (!$hashtag) {
                $hashtag = Hashtag::create([
                    'name' => $hashtagName
                ]);
            }
            $post->hashtags()->attach($hashtag->id);
        }
        return $post;

    }

    public function addSubscriptionStatus($posts, User $user)
    {
        $posts->each(function (Post $post) use ($user) {
            $post->user->is_subscribed = $this->isSubscribed($user, $post->user);
            $post->user->makeHidden('subscribers');
        });
        return $posts;
    }

    public function isSubscribed(User $subscriber, User $target)
    {
        return $target->subscribers()->where('subscriber_id', $subscriber->id)->exists();
    }

    public function feed(User $user, int|null $page = 1)
    {
        $usersId = $user->subscriptions()->get()->pluck('id');
        $posts = Post::whereIn('user_id', $usersId)
            ->orWhere('user_id', $user->id)
            ->orWhereHas('user_tags', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            })
            ->with('user.subscribers')->orderBy('created_at', 'desc')->paginate(5, page: $page);
        ;
        return $posts;
    }

    public function userPostsList(int $userId, int|null $page = 1)
    {
        $posts = Post::where('user_id', $userId)
            ->orWhereHas('user_tags', function ($q) use ($userId) {
                $q->where('users.id', $userId);
            })
            ->with('user.subscribers')->orderBy('created_at', 'desc')->paginate(5, page: $page);
        return $posts;
    }

    public function hashtagPostsList(string $hashtagName, int|null $page = 1)
    {
        $hashtag = Hashtag::where('name', $hashtagName)->first();
        if (!$hashtag) {
            return null;
        }
        $posts = Post::whereHas('hashtags', function ($q) use ($hashtag) {
            $q->where('hashtags.id', $hashtag->id);
        })
            ->with('user.subscribers')->orderBy('created_at', 'desc')->paginate(5, page: $page);
        return $posts;
    }

    public function subscriptionsList(int $userId)
    {
        $subscriptions = Subscription::where('subscriber_id', $userId)->with('user')->get();
        return $subscriptions;
    }
}