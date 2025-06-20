<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostService;
use Inertia\Inertia;
use App\Models\Subscription;
use App\Models\User;

class PostController extends Controller
{
    public function __construct(
        private PostService $postService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = $this->postService->list();
        if ($request->user()) {
            $posts = $this->postService->addSubscriptionStatus($posts, $request->user());
        }
        return Inertia::render('Posts', compact('posts'));
    }

    public function feed(Request $request)
    {
        $posts = $this->postService->feed($request->user());
        $posts = $this->postService->addSubscriptionStatus($posts, $request->user());
        return Inertia::render('Posts', compact('posts'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|max:280'
        ]);
        $this->postService->create($request->user()->id, $request->text);
    }

    public function switchSubscription(Request $request, int $userId)
    {
        $subscription = Subscription::where([
            'subscriber_id' => $request->user()->id,
            'user_id' => $userId
        ])->first();

        if ($subscription) {
            $subscription->delete();
        } else {
            Subscription::create([
                'subscriber_id' => $request->user()->id,
                'user_id' => $userId
            ]);
        }
    }
}
