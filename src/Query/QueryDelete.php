<?php

namespace Hindbiswas\QueBee\Query;

use Hindbiswas\QueBee\Clause\WhereClause;
use Hindbiswas\QueBee\Query\QueryStruct;

class QueryDelete implements QueryStruct
{
    use WhereClause;

    public function __construct(private string $from) {}

    public function build(): string
    {
        $whereClause = ($this->where) ? "WHERE " . $this->where : "";
        return trim("DELETE FROM $this->from $whereClause");
    }
}
