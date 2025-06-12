<?php

namespace Go2Flow\ApiPlatform\Actions;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class Publish extends Action
{

    public function create($type)
    {
        $folders = $this->getFolders($type);

        $this->makeDirectory($folders['app']);

        foreach ($this->getFiles($folders['package']) as $file) {

            $this->writeFile(
                $this->modifyFileNamespace($file, $type),
                $folders['app'] . '/' . $file->getRelativePathname(),
            );
        }
    }

    private function getFiles($folder) : array
    {
        return $this->disk::files(
            $folder
        );
    }

    private function getFolders($type) : array
    {
        return match($type) {
            'Filters' => [
                'package' => $this->paths->packageFilters(),
                'app' => $this->paths->logicFilters()
            ],
            'Includes' => [
                'package' => $this->paths->packageIncludes(),
                'app' => $this->paths->logicIncludes()
            ],
            'Transformers' => [
                'package' => $this->paths->packageTransformers(),
                'app' => $this->paths->logicTransformers()
            ],
            default => throw new \Exception("You can't publish $type")
        };
    }

    private function modifyFileNamespace($file, $type) : Stringable {

        return Str::of($this->disk::get($file))->replace(
            "Go2Flow\\ApiPlatform\\" . $type,
            "App\\ApiLogic\\" . $type
        );
    }
}
