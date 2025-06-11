<?php

namespace Go2Flow\ApiPlatform\Actions;

use Illuminate\Support\Str;

class Controllers extends Action
{

    public function create($name)
    {

        $this->makeDirectory($this->paths->controllerApiPlatform());

        $stub = $this->getStub('Controller');

        $stub = $this->setStubName($stub, $name);

        $this->writeFile(
            $stub,
            $this->paths->controllerApiPlatform() . '/' . $name . 'Controller.php',
        );
    }
}
