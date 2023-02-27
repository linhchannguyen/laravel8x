<?php

namespace App\Providers;

use App\Events\PostCreated;
use App\Events\RedisEvent;
use App\Listeners\PostCacheListener;
use App\Listeners\RedisEventListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // RedisEvent::class => [
        //     RedisEventListener::class
        // ],
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],
        PostCreated::class => [
            PostCacheListener::class
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
