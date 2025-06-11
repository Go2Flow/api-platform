<?php

namespace Go2Flow\ApiPlatform;

use Go2Flow\Ezport\Commands\MakeCustomer;
use Go2Flow\Ezport\Commands\PrepareProject;
use Go2Flow\Ezport\Commands\PublishHelpers;
use Illuminate\Support\ServiceProvider;

class ApiPlatformServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
//                PrepareProject::class,
//                MakeCustomer::class,
//                PublishHelpers::class
            ]);
        }
    }

}