<?php

namespace App\Controllers;

use App\Models\Post;

class PostController
{
    public function index()
    {
        $posts = Post::all();
        $post = null;
        if (isset($_GET['id'])) {
            $post = Post::find($_GET['id']);
        }
        generate('posts', ['posts' => $posts, 'post' => $post]);
    }

    public function store()
    {
        $post = new Post();
        $post->text = strip_tags($_POST['text']);
        $post->save();
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    }

    public function show()
    {
        $post = Post::find($_POST['id']);
        generate('posts', ['posts' => [$post]]);
    }    
}
