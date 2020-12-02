<?php

namespace App\Listeners\UserAddsArticle;

use App\Events\UserAddsArticle;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddUserArticlesCount
{
    public function handle(UserAddsArticle $event)
    {
        $user = $event->user;

        $user->update([
            'articles_count' => $user->articles()->count()
        ]);
    }
}
