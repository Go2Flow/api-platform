<?php

namespace Go2Flow\ApiPlatform\Traits;

use Illuminate\Support\Carbon;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionUnionType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

trait DataRules
{
    protected static function fixedRules(): array
    {
        return [];
    }

    public static function rules(): array
    {
        $isPartial = in_array(strtoupper(request()->method()), ['PATCH', 'PUT']);
        $reflection = new ReflectionClass(static::class);
        $rules = [];

        foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) ?? [] as $property) {

            if ($property->getDeclaringClass()->getName() === Data::class) {
                continue;
            }

            $name = $property->getName();
            $type = $property->getType();

            if (! $type) continue;

            $isOptional = false;
            $baseType = null;

            if ($type instanceof ReflectionUnionType) {
                foreach ($type->getTypes() as $unionType) {
                    if ($unionType->getName() === Optional::class) {
                        $isOptional = true;
                    } else {
                        $baseType = $unionType->getName();
                    }
                }
            } elseif ($type instanceof ReflectionNamedType) {
                $baseType = $type->getName();
            }

            $rule = match ($baseType) {
                'int' => ['integer'],
                'float' => ['numeric'],
                'bool' => ['boolean'],
                'string' => ['string'],
                'array' => ['array'],
                Carbon::class => ['date'],
                default => [],
            };

            if ($isOptional) {
                array_unshift($rule, 'nullable');
            } else {
                array_unshift($rule, $isPartial ? 'sometimes' : 'required');
            }

            $rules[$name] = $rule;
        }

        foreach (static::fixedRules() as $field => $customRules) {
            $rules[$field] = $customRules;
        }

        return $rules;
    }
}
