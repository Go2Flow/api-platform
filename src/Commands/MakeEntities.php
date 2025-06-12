<?php

namespace Go2Flow\ApiPlatform\Commands;

use Go2Flow\ApiPlatform\Actions\Controllers;
use Go2Flow\ApiPlatform\Actions\Entities;
use Illuminate\Console\Command;
use function Laravel\Prompts\text;

class MakeEntities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-platform:entity {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Data Entities to the Data folder';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        if (! $name = $this->argument('name')) {

            $name = text(
                label: 'Please provide an Entities name',
                required: 'A name is required',
            );
        }

        $entities = New Entities();

        $entities->create($name);

        $this->info('Entities created successfully.');
    }
}
