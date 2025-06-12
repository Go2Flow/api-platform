<?php

namespace Go2Flow\ApiPlatform\Includes;

use Spatie\QueryBuilder\Includes\IncludeInterface;
use Illuminate\Database\Eloquent\Builder;

class AggregateInclude implements IncludeInterface
{
    protected string $column;

    protected string $function;

    public function __construct(string $column, string $function)
    {
        $this->column = $column;

        $this->function = $function;
    }

    public function __invoke(Builder $query, string $include): void
    {
        $query->withAggregate($include, $this->column, $this->function);
    }
}
