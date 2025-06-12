<?php

namespace Go2Flow\ApiPlatform\Commands;

use Go2Flow\ApiPlatform\Actions\Controllers;
use Illuminate\Console\Command;
use function Laravel\Prompts\text;

class MakeController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-platform:controller {name?}';

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
                label: 'Please provide a Controller name',
                required: 'A Name is required',
            );
        }

        $controller = New Controllers();

        $controller->create($name);
    }
}
