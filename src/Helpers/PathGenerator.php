<?php

namespace Go2Flow\ApiPlatform\Helpers;

use Illuminate\Support\Str;

class PathGenerator {

    CONST APP_BASE = 'app/';
    CONST PROJECT_BASE = 'Go2Flow/ApiPlatform/';
    const STUB_BASE = __DIR__ . '/../../Stubs/';
    const ROUTE_BASE = 'routes/';
    const PACKAGE_BASE = __DIR__ . '/../';

    public function routeApiPlatform() : string {

        return $this->create('route', 'api-platform');
    }

    public function __call(string $method, array $args)
    {
        $kebab = Str::of($method)->kebab();
        return static::create(
            $kebab->before('-')->toString(),
            $kebab->after('-')->camel()->ucfirst()->toString(),

        );
    }

    private static function create($type, $path) : string
    {

        return match ($type) {
            'package' => static::PACKAGE_BASE . $path,
            'logic' => static::APP_BASE . 'ApiLogic/'  .$path,
            'data' => static::APP_BASE . 'Data/'  .$path,
            'controller' => static::APP_BASE . 'Http/Controllers/'  .$path,
            'project' => static::PROJECT_BASE . $path,
            'stub' => static::STUB_BASE . $path . '.stub',
            'route' => static::ROUTE_BASE . $path . '.php',
            default => throw new \Exception('Invalid path type')
        };
    }
}
