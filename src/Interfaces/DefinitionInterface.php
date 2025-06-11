<?php

namespace Go2Flow\ApiPlatform\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

interface DefinitionInterface
{

    public static function sort() : array;

    public static function filters(): array;

    public static function relations() : array;

    public static function index(Request $request) : LengthAwarePaginator;
    public static function show(int $model) : Model;

    public static function store(Data $payload) : Data;

    public static function update(Data $payload, $model) : Data;

}