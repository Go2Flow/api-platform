<?php

namespace Go2Flow\ApiPlatform\Actions;

use Go2Flow\ApiPlatform\Helpers\PathGenerator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

abstract class Action {

    protected File $disk;
    protected PathGenerator $paths;


    public function __construct() {

        $this->disk = new File();
        $this->paths = new PathGenerator();
    }

    protected function makeDirectory(string $path) : void
    {
        if (! $this->disk::isDirectory($path)) {
            $this->disk::makeDirectory(
                $path, 0755, true
            );
        }
    }

    protected function getStub(string $stub) : Stringable
    {
        return Str::of(File::get($this->paths->{'stub' . $stub}()));
    }

    protected function setStubName(Stringable $stub, string $name)
    {
        return $stub->replace('$NAME$', $name);

    }

    protected function writeFile(Stringable $stub, string $path)
    {
        $this->disk::put(
            $path,
            $stub
        );
    }
}
