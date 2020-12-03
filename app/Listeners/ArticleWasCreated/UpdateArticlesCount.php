<?php

namespace App\Listeners\ArticleWasCreated;

use App\Events\ArticleWasCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateArticlesCount implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ArticleWasCreated $event)
    {
        $user = $event->user;

        $user->update([
            'articles_count' => $user->articles()->count()
        ]);
    }
}
