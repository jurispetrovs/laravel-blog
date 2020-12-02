<?php

namespace App\Providers;

use App\Events\ArticleWasCreated;
use App\Events\UserAddsArticle;
use App\Events\UserDeletesArticle;
use App\Listeners\ArticleWasCreated\Test2Listener;
use App\Listeners\ArticleWasCreated\TestListener;
use App\Listeners\UserAddsArticle\AddUserArticlesCount;
use App\Listeners\UserDeletesArticle\ReduceUserArticlesCount;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ArticleWasCreated::class => [
            TestListener::class,
            Test2Listener::class
        ],
        UserAddsArticle::class => [
          AddUserArticlesCount::class
        ],
        UserDeletesArticle::class => [
            ReduceUserArticlesCount::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
