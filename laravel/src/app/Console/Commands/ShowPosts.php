<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class ShowPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:show-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->table(
            [
                "Id",
                "Text",
                "Image",
                'created_at'
            ],
            Post::all(['id', 'text', 'image', 'created_at'])->toArray()

        );
    }
}
