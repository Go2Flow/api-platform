<?php

namespace Go2Flow\ApiPlatform\Actions;

use Illuminate\Support\Str;

class Entities extends Action
{
    public function create($name) : void {

        $this->makeDirectory($this->paths->dataEntities() . '/' . Str::plural($name));


        foreach (['AbstractEntity', 'Entity', 'EntityPayload'] as $type) {

            $stub = $this->getStub($type);

            $stub = $this->setStubName($stub, $name);

            $this->writeFile(
                $stub,
                $this->paths->dataEntities() . '/' . Str::plural($name)  .  '/' . Str::replace('Entity', $name, $type) . '.php',
            );
        }
    }
}
