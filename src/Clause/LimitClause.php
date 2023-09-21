<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Clause;

trait LimitClause
{
    protected string $limit = '';

    public function limit(int $limit = 50, int $offset = 0)
    {
        $this->limit = "$offset, $limit";
        return $this;
    }
}
