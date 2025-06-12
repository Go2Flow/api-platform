<?php

namespace Go2Flow\ApiPlatform\Commands;

use Go2Flow\ApiPlatform\Actions\Controllers;
use Go2Flow\ApiPlatform\Actions\Routes;
use Illuminate\Console\Command;
use function Laravel\Prompts\text;

class MakeRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-platform:route {name?}';

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
                label: 'Please provide a Route name',
                required: 'A Name is required',
            );
        }

        $routes = New Routes();

        $routes->create($name);
    }
}
