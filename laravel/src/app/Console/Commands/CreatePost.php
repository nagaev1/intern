<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Services\PostService;

class CreatePost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-post {postText} {imagePath}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new post';

    /**
     * Execute the console command.
     */
    public function handle(PostService $postService)
    {
        $postText = $this->argument('postText');
        $imagePath = $this->argument('imagePath');

        $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp'];
        $contentType = mime_content_type($imagePath);

        if (
            !in_array($contentType, $allowedMimeTypes) &&
            file_exists($imagePath) &&
            !is_dir($imagePath)
        ) {
            $this->error("file is not image or dont exists");
            return 1;
        }
        $post = $postService->store($postText, $imagePath);
    }
}
