<?php

namespace App\Providers;

use App\Observers\VoteObserver;
use App\Vote;
use Illuminate\Support\ServiceProvider;

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
        Vote::observe(VoteObserver::class);
    }
}
