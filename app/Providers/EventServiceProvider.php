<?php

namespace App\Providers;

use App\Events\ArticleWasCreated;
use App\Listeners\ArticleWasCreated\UpdateArticlesCount;
use App\Listeners\Registered\GeneratePasswordAndSendEmail;
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
            GeneratePasswordAndSendEmail::class,
        ],
        ArticleWasCreated::class => [
            UpdateArticlesCount::class,
        ],
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
