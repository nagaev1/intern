<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class PostService
{
    public function list(): Collection
    {
        $posts = Post::orderBy('created_at')->with('user.subscribers')->get();
        return $posts;
    }

    public function create(int $userId, string $text): Post
    {
        $post = Post::create([
            'user_id' => $userId,
            'text' => $text
        ]);
        return $post;
    }

    public function addSubscriptionStatus(Collection $posts, User $user)
    {
        $posts->each(function (Post $post) use ($user) {
            $post->user->is_subscribed = $this->isSubscribed($user, $post->user);
        });
        return $posts;
    }

    public function isSubscribed(User $subscriber, User $target)
    {
        return $target->subscribers()->where('subscriber_id', $subscriber->id)->exists();
    }

    public function feed(User $user)
    {
        $usersId = $user->subscriptions()->get()->pluck('id');
        $posts = Post::whereIn('user_id', $usersId)->with('user.subscribers')->get();
        return $posts;
    }
}