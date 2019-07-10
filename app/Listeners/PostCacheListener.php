<?php

namespace App\Listeners;

use App\Models\Post;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostCacheListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        cache()->forget('articles');
        $posts = Post::with('category', 'user')
            ->orderByDesc('created_at')
            ->take(100)
            ->get();
        cache()->forever('articles', $posts);
    }
}
