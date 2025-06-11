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
    protected $signature = 'api-platform:definition {Definition?}';

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

        if (! $customer = $this->argument('Definition')) {

            $customer = text(
                label: 'Please provide a Definition name',
                required: 'A Definition is required',
            );
        }

        New Definitions();




    }
}
