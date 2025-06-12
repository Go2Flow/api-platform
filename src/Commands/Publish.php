<?php

namespace Go2Flow\ApiPlatform\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\select;
use Go2Flow\ApiPlatform\Actions\Publish as PublishAction;
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
                options: ['Filters', 'Includes', 'Transformers'],
                required: 'A Name is required',
            );
        }

        $publish = New PublishAction();

        $publish->create($name);

        $this->info('Resource Published');
    }
}
