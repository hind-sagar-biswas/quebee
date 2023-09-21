<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Clause;

trait LimitClause
{
    protected string $limit = '';

    // Set the LIMIT and OFFSET for the query
    public function limit(int $limit = 50, int $offset = 0): self
    {
        $this->limit = "$offset, $limit";
        return $this;
    }
}
