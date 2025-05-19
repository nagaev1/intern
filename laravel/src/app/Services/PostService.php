<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Storage;

class PostService
{
    public function store(string $postText, UploadedFile|string $file): Post
    {
        $path = Storage::disk('public')->putFile('posts', $file);
        $post = Post::create([
            'text' => $postText,
            'image' => $path
        ]);
        return $post;
    }

    public function delete(Post $post): void
    {
        $post->deleteOrFail();
        Storage::disk('public')->delete($post->image);
    }

    public function deleteById(int $id): void
    {
        $post = Post::findOrFail($id);
        $this->delete($post);
    }

}
