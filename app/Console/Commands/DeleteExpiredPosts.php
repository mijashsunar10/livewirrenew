<?php

namespace App\Console\Commands;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-expired-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permanently delete soft-deleted posts older than a certain time';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $expiredPosts = Post::onlyTrashed()
        ->where('deleted_at', '<=', Carbon::now()->subMinute())
        ->get();

        foreach ($expiredPosts as $post) {
            $post->forceDelete();
        }

        $this->info("Deleted {$expiredPosts->count()} expired posts.");
    
    }
}
