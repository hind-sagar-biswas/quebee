<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Clause;

trait OrderClause
{
    protected array $order = [];

    public function orderBy(string $column, string $direction = 'asc'): self
    {
        $direction = strtoupper($direction);

        if (!in_array($direction, ['ASC', 'DESC'])) throw new \InvalidArgumentException('Order Direction must be either ASC or DESC');

        $this->order[] = "$column $direction";
        return $this;
    }
}
