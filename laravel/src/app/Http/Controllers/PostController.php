<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Services\PostService;
use Throwable;

class PostController extends Controller
{
    public function __construct(private readonly PostService $postService) {}

    public function index()
    {
        $posts = Post::all();
        return view("home", ["posts"=> $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        try {
            $this->postService->store($request->text, $request->file('image'));
        } catch (Throwable $e) {
            report($e);
        }

        return redirect()->route('home');
    }

    public function delete(Post $post)
    {
        $this->postService->delete($post);
        return redirect()->route('home');
    }
}
