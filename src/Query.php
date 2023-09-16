<?php

namespace Hindbiswas\QueBee;

use Hindbiswas\QueBee\Query\QueryDelete;
use Hindbiswas\QueBee\Query\QueryInsert;
use Hindbiswas\QueBee\Query\QuerySelect;
use Hindbiswas\QueBee\Query\QueryUpdate;

class Query {
    public static function select(array $columns = []) { 
        if (empty($columns)) return new QuerySelect(['*']); 
        return new QuerySelect($columns); 
    }
    public static function insert(array|string $data) { return new QueryInsert($data); }
    public static function update(array|string $data) { return new QueryUpdate($data); }
    public static function delete(string $table) { return new QueryDelete($table); }

    public static function flattenByComma(array|string $data) { 
        if (!is_array($data)) return $data;
        return implode(', ', $data);
    }

    public static function parseCondition(string $conditions) {
        return str_replace(["&&", "||", " !! ", " ?? "], ["AND", "OR", " NOT ", " LIKE "], $conditions);
    }

    public static function buildCondition(
        string $column, 
        int|string|null|bool $value, 
        string $comparison = '=',
        int|string|null|bool $secondValue = null
    )
    {
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