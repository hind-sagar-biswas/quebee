<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee;

use Hindbiswas\QueBee\Query\QueryDelete;
use Hindbiswas\QueBee\Query\QueryInsert;
use Hindbiswas\QueBee\Query\QuerySelect;
use Hindbiswas\QueBee\Query\QueryUpdate;

class Query
{
    public static function select(array $columns = []): QuerySelect
    {
        if (empty($columns)) return new QuerySelect(['*']);
        return new QuerySelect($columns);
    }
    public static function insert(array $data): QueryInsert
    {
        return new QueryInsert($data);
    }
    public static function insertMultiple(array $data): QueryInsert
    {
        return new QueryInsert($data, true);
    }
    public static function update(string $table): QueryUpdate
    {
        return new QueryUpdate($table);
    }
    public static function delete(string $table): QueryDelete
    {
        return new QueryDelete($table);
    }

    public static function flattenByComma(array|string $data): string
    {
        if (!is_array($data)) return $data;
        return implode(', ', $data);
    }

    public static function flattenByEqual(array $data): string
    {
        $parsed_data = array_map(
            fn (string $k, $d): string => ($d === null) ? "$k = NULL" : "$k = '$d'",
            array_keys($data),
            array_values($data)
        );
        return implode(', ', $parsed_data);
    }

    public static function flattenForValues(array|string $data): string
    {
        if (!is_array($data)) return $data;
        $parsed_data = array_map(fn (string $d): string => ($d === null) ? 'NULL' : "'$d'", $data);
        return '(' . implode(', ', $parsed_data) . ')';
    }

    public static function parseCondition(string $conditions): string
    {
        return str_replace(["&&", "||", " !! ", " ?? "], ["AND", "OR", " NOT ", " LIKE "], $conditions);
    }

    public static function buildCondition(
        string $column,
        int|string|null|bool $value,
        string $comparison = '=',
        int|string|null|bool $secondValue = null
    ): string {
        $sqlValue = ($value === null) ? 'NULL' : "'$value'";

        if ($secondValue !== null)  return "$column BETWEEN $sqlValue AND $secondValue";

        $sqlComp = match ($comparison) {
            'gt', '>' => '>',
            'gte', '>=' => '>=',
            'lt', '<' => '<',
            'lte', '<=' => '<=',
            'eq', '==', '=', null => '=',
            'ne', '!=', '<>' => '!=',
            'ns', '<=>' => '<=>',
            'like', '??' => 'LIKE',
        };

        return "$column $sqlComp $sqlValue";
    }
}
