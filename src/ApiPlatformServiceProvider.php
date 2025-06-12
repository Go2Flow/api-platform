<?php

namespace Go2Flow\ApiPlatform;

use Go2Flow\ApiPlatform\Commands\MakeAll;
use Go2Flow\ApiPlatform\Commands\MakeController;
use Go2Flow\ApiPlatform\Commands\MakeDefinition;
use Go2Flow\ApiPlatform\Commands\MakeEntities;
use Go2Flow\ApiPlatform\Helpers\PathGenerator;
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
                MakeAll::class,
                MakeDefinition::class,
                MakeEntities::class,
                MakeController::class,
            ]);
        }

    }
}
