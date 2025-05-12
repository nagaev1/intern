<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'image' => 'required|image|max:5120'
        ]);

        $path = $request->file('image')->store('posts', 'public');
        // return $path;
        
        Post::create([
            'text'=> $request->text,
            'image'=> $path
        ]);

        return redirect()->route('home');
    }
}
