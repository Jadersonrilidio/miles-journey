<?php

namespace App\Providers;

use App\Services\OpenAIService;
use App\ValueObjects\OpenAIConfigBag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class OpenAIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->when(OpenAIConfigBag::class)
            ->needs('$config')
            ->give(Config::get('services.openai'));

        $this->app->singleton(OpenAIService::class, function (Application $app) {
            return new OpenAIService($app->make(OpenAIConfigBag::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
