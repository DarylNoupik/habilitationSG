<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Observers\FonctionsObserver;
use App\Observers\UserObserver;
use App\Models\Fonctions;
use App\Models\User;

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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Fonctions::observe(FonctionsObserver::class);
        User::observe(UserObserver::class);
        Fonctions::observe(function ($fonction) {
            $applications = $fonction->applications()->pluck('id')->toArray();
            $users = $fonction->users()->pluck('id')->toArray();
            $diff = array_diff($applications, $users);
            if (!empty($diff)) {
                $fonction->users()->sync($applications);
            }
        });
        
        
    }
}
