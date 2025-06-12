<?php

namespace Go2Flow\ApiPlatform\Commands;

use Go2Flow\ApiPlatform\Actions\Definitions;
use Illuminate\Console\Command;
use function Laravel\Prompts\text;

class MakeDefinition extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-platform:definition {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Definition for use in an api-platform Controller';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        if (! $name = $this->argument('name')) {

            $name = text(
                label: 'Please provide a Definition name',
                required: 'A Definition is required',
            );
        }

        $definition = New Definitions();

        $definition->create($name);


    }
}
