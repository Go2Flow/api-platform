<?php

namespace Go2Flow\ApiPlatform\Commands;

use Go2Flow\ApiPlatform\Actions\Controllers;
use Go2Flow\ApiPlatform\Actions\Definitions;
use Go2Flow\ApiPlatform\Actions\Entities;
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
    protected $description = 'Command description';

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

        $controller = New Controllers();
        $definition = New Definitions();
        $entities = New Entities();

        $definition->create($name);
        $controller->create($name);
        $entities->create($name);

    }
}
