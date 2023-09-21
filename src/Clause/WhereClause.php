<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Clause;

use Hindbiswas\QueBee\Query;
use Hindbiswas\QueBee\Query\QueryStruct;

trait WhereClause
{
    protected null|string $where = null;

    // Add a custom WHERE clause to the query
    public function whereClause(string $condition): self
    {
        if ($this->where) $this->where .= Query::parseCondition($condition);
        else $this->where = Query::parseCondition($condition);
        return $this;
    }

    // Add a simple WHERE clause
    public function where(
        string $column,
        string $comparison = '=',
        int|string|null|bool $value,
        int|string|null|bool $secondValue = null,
    ): self {
        if ($this->where !== null) return $this->andWhere($column, $comparison, $value, $secondValue);
        $this->where = Query::buildCondition($column, $value, $comparison, $secondValue);
        return $this;
    }

    // Add an AND WHERE clause
    public function andWhere(
        string $column,
        string $comparison = '=',
        int|string|null|bool $value,
        int|string|null|bool $secondValue = null,
        bool $not = false,
    ): self {
        if ($this->where === null) return $this->where($column, $value, $comparison, $secondValue);

        $initial = ($not) ? ' AND NOT ' : ' AND ';
        $this->where .= $initial . Query::buildCondition($column, $value, $comparison, $secondValue);
        return $this;
    }

    // Add an OR WHERE clause
    public function orWhere(
        string $column,
        string $comparison = '=',
        int|string|null|bool $value,
        int|string|null|bool $secondValue = null,
        bool $not = false,
    ): self {
        if ($this->where === null) return $this->where($column, $value, $comparison, $secondValue);

        $initial = ($not) ? ' OR NOT ' : ' OR ';
        $this->where .= $initial .  Query::buildCondition($column, $value, $comparison, $secondValue);
        return $this;
    }

    // Add a WHERE EXISTS clause
    public function whereExists(QueryStruct $query): self
    {
        if ($this->where !== null) return $this->andWhereExists($query);
        $this->where = ' EXISTS (' . $query->build() . ')';
        return $this;
    }

    // Add an AND WHERE EXISTS clause
    public function andWhereExists(QueryStruct $query): self
    {
        if ($this->where === null) return $this->whereExists($query);
        $this->where .= ' AND EXISTS (' . $query->build() . ')';
        return $this;
    }

    // Add an OR WHERE EXISTS clause
    public function orWhereExists(QueryStruct $query): self
    {
        if ($this->where === null) return $this->whereExists($query);
        $this->where .= ' OR EXISTS (' . $query->build() . ')';
        return $this;
    }
}
