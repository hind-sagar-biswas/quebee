<?php

namespace Hindbiswas\QueBee\Clause;

trait OrderClause {
    private array $order = [];

    public function orderBy(string $column, string $direction = 'asc'): self
    {
        $direction = strtoupper($direction);

        if (!in_array($direction, ['ASC', 'DESC'])) throw new \InvalidArgumentException('Order Direction must be either ASC or DESC');

        $this->order[] = "$column $direction";
        return $this;
    }
}