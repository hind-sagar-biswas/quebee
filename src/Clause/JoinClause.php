<?php

namespace Hindbiswas\QueBee\Clause;

trait JoinClause
{
    protected $joins = [];

    public function join(string $table, string $alias, string $joinOnCondition)
    {
        $this->joins[] = ['type' => 'INNER', 'table' => $table, 'alias' => $alias, 'condition' => $joinOnCondition];
        return $this;
    }

    public function leftJoin(string $table, string $alias, string $joinOnCondition)
    {
        $this->joins[] = ['type' => 'LEFT', 'table' => $table, 'alias' => $alias, 'condition' => $joinOnCondition];
        return $this;
    }

    public function rightJoin(string $table, string $alias, string $joinOnCondition)
    {
        $this->joins[] = ['type' => 'RIGHT', 'table' => $table, 'alias' => $alias, 'condition' => $joinOnCondition];
        return $this;
    }

    public function joinClause(): string {
        $clause = '';
        foreach ($this->joins as $join) {
            $clause .= ' ' . $join['type'] . ' JOIN ' . $join['table'] . ' AS ' . $join['alias'] . ' ON ' . $join['condition'];
        }
        return $clause;
    }
}
