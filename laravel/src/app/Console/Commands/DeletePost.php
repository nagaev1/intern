<?php

namespace App\Console\Commands;

use App\Services\PostService;
use Illuminate\Console\Command;

class DeletePost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-post {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(PostService $postService)
    {
        try {
            $postService->deleteById(intval($this->argument('id')));
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }
    }
}
