<?php

namespace App\Providers;

use App\Service\AbstractRequestProvider;
use App\Service\BrasilApiRequestProvider;
use App\Service\IBGERequestProvider;
use Exception;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AbstractRequestProvider::class, function () {
            $provider = env('PROVIDER');

            return match ($provider) {
                'IBGE' => $this->app->get(IBGERequestProvider::class),
                'BRASIL_API' => $this->app->get(BrasilApiRequestProvider::class),
                default => throw new Exception('Provider does not exist or has not been configured.'),
            };
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
