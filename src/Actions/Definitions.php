<?php

namespace Go2Flow\ApiPlatform\Actions;

use Go2Flow\ApiPlatform\Helpers\PathGenerator;

class Definitions extends Action {

    public function create($name) : void {

        $this->makeDirectory($this->paths->logicDefinitions());

        $stub = $this->getStub('Definition');

        $stub = $this->setStubName($stub, $name);

        $this->writeFile(
            $stub,
            $this->paths->logicDefinitions() . '/' . $name . 'Definition.php',
        );
    }
}
