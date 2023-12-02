<?php

namespace App\Providers;

use App\Services\HtmlService;
use App\Services\SnappyService;
use Barryvdh\Snappy\PdfWrapper;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SnappyService::class, function($app) {
            return new SnappyService(
                $app->make(PdfWrapper::class),
                $app->make(HtmlService::class)
            );
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
