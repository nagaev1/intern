<?php

namespace App\Http\Controllers;

use App\Models\Hashtag;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Models\Subscription;
use App\Models\User;

class PostController extends Controller
{
    public function __construct(
        private PostService $postService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = $this->postService->list();
        if (auth('sanctum')->user()) {
            $posts = $this->postService->addSubscriptionStatus($posts, auth('sanctum')->user());
        }
        return $posts;
    }

    public function feed(Request $request)
    {
        $posts = $this->postService->feed(auth('sanctum')->user());
        $posts = $this->postService->addSubscriptionStatus($posts, auth('sanctum')->user());
        return $posts;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|max:280'
        ]);
        $post = $this->postService->create(auth('sanctum')->user()->id, $request->text);
        return $post;
    }

    public function switchSubscription(Request $request, int $userId)
    {
        $subscription = Subscription::where([
            'subscriber_id' => auth('sanctum')->user()->id,
            'user_id' => $userId
        ])->first();

        if ($subscription) {
            $subscription->delete();
        } else {
            Subscription::create([
                'subscriber_id' => auth('sanctum')->user()->id,
                'user_id' => $userId
            ]);
        }
    }

    public function postsUser(Request $request, User $user)
    {
        $posts = $this->postService->userPostsList($user->id);
        if (auth('sanctum')->user()) {
            $posts = $this->postService->addSubscriptionStatus($posts, auth('sanctum')->user());
        }
        return $posts;
    }

    public function postsHashtag(Request $request, Hashtag $hashtag)
    {
        $posts = $this->postService->hashtagPostsList($hashtag->name);
        if (!$posts) {
            return null;
        }
        if (auth('sanctum')->user()) {
            $posts = $this->postService->addSubscriptionStatus($posts, auth('sanctum')->user());
        }
        return $posts;
    }

    public function subscriptionList(Request $request)
    {
        $subscriptions = $this->postService->subscriptionsList(auth('sanctum')->user()->id);
        return $subscriptions;
    }

}
