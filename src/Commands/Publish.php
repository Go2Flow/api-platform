<?php

namespace Go2Flow\ApiPlatform\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\select;

class Publish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-platform:publish {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish resources to the ApiLogic folder';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        if (! $name = $this->argument('name')) {

            $name = select(
                label: 'Please provide a Route name',
                required: 'A Name is required',
                options: ['Filter', 'Includes', 'Transformers'],
            );
        }

        $publish = New Publish();

        $publish->create($name);
    }
}
