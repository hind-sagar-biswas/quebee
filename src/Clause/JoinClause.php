<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Clause;

trait JoinClause
{
    protected $joins = [];

    // Add a join clause to perform an INNER JOIN
    public function join(string $table, string $alias, string $joinOnCondition): self
    {
        $this->joins[] = ['type' => 'INNER', 'table' => $table, 'alias' => $alias, 'condition' => $joinOnCondition];
        return $this;
    }

    // Add a join clause to perform a LEFT JOIN
    public function leftJoin(string $table, string $alias, string $joinOnCondition): self
    {
        $this->joins[] = ['type' => 'LEFT', 'table' => $table, 'alias' => $alias, 'condition' => $joinOnCondition];
        return $this;
    }

    // Add a join clause to perform a RIGHT JOIN
    public function rightJoin(string $table, string $alias, string $joinOnCondition): self
    {
        $this->joins[] = ['type' => 'RIGHT', 'table' => $table, 'alias' => $alias, 'condition' => $joinOnCondition];
        return $this;
    }

    // Add a join clause to perform a FULL JOIN
    public function fullJoin(string $table, string $alias, string $joinOnCondition): self
    {
        $this->joins[] = ['type' => 'FULL', 'table' => $table, 'alias' => $alias, 'condition' => $joinOnCondition];
        return $this;
    }

    // Build the JOIN clause based on the defined joins
    protected function joinClause(): string
    {
        $clause = '';
        foreach ($this->joins as $join) {
            // Construct the JOIN clause for each defined join
            $clause .= ' ' . $join['type'] . ' JOIN ' . $join['table'] . ' AS ' . $join['alias'] . ' ON ' . $join['condition'];
        }
        return $clause;
    }
}
