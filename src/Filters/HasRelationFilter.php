<?php

namespace Go2Flow\ApiPlatform\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class HasRelationFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        // relation:has
        $propParts = explode(':', $property);
        if ($value) {
            $query->whereHas($propParts[0]);
        } else {
            $query->whereDoesntHave($propParts[0]);
        }
    }
}
