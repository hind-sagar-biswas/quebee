<?php

namespace Hindbiswas\QueBee\Clause;

use Hindbiswas\QueBee\Query;

trait WhereClause {
    private null|string $where = null;

    public function whereClause(string $condition)
    {
        if ($this->where) $this->where .= Query::parseCondition($condition);
        else $this->where = Query::parseCondition($condition);
        return $this;
    }

    public function where(
        string $column,
        string $comparison = '=',
        int|string|null|bool $value,
        int|string|null|bool $secondValue = null,
    ) {
        $this->where = Query::buildCondition($column, $value, $comparison, $secondValue);
        return $this;
    }

    public function andWhere(
        string $column,
        string $comparison = '=',
        int|string|null|bool $value,
        int|string|null|bool $secondValue = null,
        bool $not = false,
    ) {
        if ($this->where === null) return $this->where($column, $value, $comparison, $secondValue);

        $initial = ($not) ? ' AND NOT ' : ' AND ';
        $this->where .= $initial . Query::buildCondition($column, $value, $comparison, $secondValue);
        return $this;
    }

    public function orWhere(
        string $column,
        string $comparison = '=',
        int|string|null|bool $value,
        int|string|null|bool $secondValue = null,
        bool $not = false,
    ) {
        if ($this->where === null) return $this->where($column, $value, $comparison, $secondValue);
        
        $initial = ($not) ? ' OR NOT ' : ' OR ';
        $this->where .= $initial .  Query::buildCondition($column, $value, $comparison, $secondValue);
        return $this;
    }
}