<?php

namespace App\Listeners\UserDeletesArticle;

use App\Events\UserDeletesArticle;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReduceUserArticlesCount
{
    public function handle(UserDeletesArticle $event)
    {
        $user = $event->user;

        $user->update([
            'articles_count' => $user->articles()->count()
        ]);
    }
}
