<?php

namespace App\Listeners\ArticleWasCreated;

use App\Events\ArticleWasCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TestListener
{
    public function handle(ArticleWasCreated $event)
    {
        $article = $event->article;
    }
}
