<?php

namespace Go2Flow\ApiPlatform\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class NullFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        // property:null
        $propParts = explode(':', $property);
        if ($value) {
            $query->whereNull($propParts[0]);
        } else {
            $query->whereNotNull($propParts[0]);
        }
    }
}
