<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Clause;

trait OrderClause
{
    protected array $order = [];

    // Add an ORDER BY clause to the query
    public function orderBy(string $column, string $direction = 'asc'): self
    {
        $direction = strtoupper($direction);

        // Validate the order direction
        if (!in_array($direction, ['ASC', 'DESC'])) {
            throw new \InvalidArgumentException('Order Direction must be either ASC or DESC');
        }

        // Add the column and direction to the order array
        $this->order[] = "$column $direction";
        return $this;
    }
}
