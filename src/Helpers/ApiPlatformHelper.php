<?php

namespace Go2Flow\ApiPlatform\Helpers;

class ApiPlatformHelper
{
    const DEFAULT_PER_PAGE = 20;

    public static function buildSortOptions(array $sorts) :array
    {
        $defaultSorts = ['id', 'updated_at', 'created_at'];

        return array_merge($defaultSorts, $sorts);
    }
}
