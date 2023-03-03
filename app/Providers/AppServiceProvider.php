<?php

namespace App\Providers;

use App\Service\AbstractRequestProvider;
use App\Service\IBGERequestProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AbstractRequestProvider::class, function () {
            return $this->app->get(IBGERequestProvider::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
