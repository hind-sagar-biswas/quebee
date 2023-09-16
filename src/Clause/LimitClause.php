<?php

namespace Hindbiswas\QueBee\Clause;

trait LimitClause {
    private string $limit = '';

    public function limit(int $limit = 50, int $offset = 0)
    {
        $this->limit = "$offset, $limit";
        return $this;
    }
}