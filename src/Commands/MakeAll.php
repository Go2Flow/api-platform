<?php

namespace Go2Flow\ApiPlatform\Commands;

use Go2Flow\ApiPlatform\Actions\Controllers;
use Go2Flow\ApiPlatform\Actions\Definitions;
use Go2Flow\ApiPlatform\Actions\Entities;
use Go2Flow\ApiPlatform\Actions\Routes;
use Illuminate\Console\Command;
use function Laravel\Prompts\text;

class MakeAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-platform:all {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Definition, Entities, Controller and Route for the api-platform ';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        if (! $name = $this->argument('name')) {

            $name = text(
                label: 'Please provide a name',
                required: 'A name is required',
            );
        }

        foreach([Controllers::class, Definitions::class, Entities::class, Routes::class] as $action) {
            $action = new $action();
            $action->create($name);
        }
    }
}
