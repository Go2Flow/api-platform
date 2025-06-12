<?php

namespace Go2Flow\ApiPlatform\Actions;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class Routes extends Action
{

    public function create($name) : void {

        $file = $this->getBaseFile();
        $file = $this->addMiddleWareGroupIfNecessary($file);
        $file = $this->addUse($file, $name);
        $file = $this->addRoute($file, $name);

        $this->writeFile(
            $file,
            $this->paths->routeApiPlatform()
        );
    }

    private function getBaseFile() : Stringable {

        return $this->disk::exists($this->paths->routeApiPlatform())
            ? $this->getRoutesFile()
            : $this->getStub('Route');
    }

    private function addMiddleWareGroupIfNecessary($file) : Stringable {

        if (! $file->contains("Route::middleware('auth:sanctum')->group(function () {")) {
            $authStub = $this->getStub('RouteAuthMiddlewareEntry')->trim();

            // Insert just before the closing PHP tag or at the end of the file
            if ($file->contains('?>')) {
                $file = $file->replace(
                    '?>',
                    "\n\n" . $authStub . "\n\n?>"
                );
            } else {
                $file = $file->append("\n\n" . $authStub);
            }
        }

        return $file;
    }

    private function addUse($file, $name) : Stringable {

        $line = $this->getStub('RouteUseEntry');

        $line = $this->setStubName($line, $name);


        if (! $file->contains(trim($line))) {
            if ($file->contains('use ')) {
                $file = $file->replaceMatches(
                    '/((?:use\s+[^\n]+;\s*)+)(?=\n)/',
                    fn ($match) => rtrim($match[1]) . "\n" . trim($line) . "\n"
                );
            } else {
                $file = $file->replaceFirst(
                    "<?php\n\n",
                    "<?php\n\n" . $line . "\n\n"
                );
            }
        }

        return $file;
    }

    private function addRoute($file, $name) : Stringable {

        $line = $this->getStub('RouteResourceEntry');
        $line = $this->setStubName($line, $name);

        if (! $file->contains(trim($line))) {
            $file = $file->replaceMatches(
                '/Route::middleware\(.*?\)->group\(function\s*\(\)\s*\{\n(.*?)^\}\);/sm',
                function ($match) use ($line) {
                    return preg_replace(
                        '/\{(\n)/',
                        "{\n    " . trim($line) . "\n",
                        $match[0],
                        1
                    );
                }
            );
        }
        return $file;
    }
}
