<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Observers\MessageThreadObserver;
use App\MessageThread;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Set default length of string
        // This is for string columns in migration
        // If you don't put this, error will show up upon migration
        Schema::defaultStringLength(191);

        // Set an observer for events for this model
        MessageThread::observe(MessageThreadObserver::class);
    }
}
