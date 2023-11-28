<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Stmt;

use Hindbiswas\QueBee\Stmt\StmtStruct;
use Hindbiswas\QueBee\Query\QuerySelect;

class UnionStmt implements StmtStruct
{
    private array $select_queries = [];

    public function __construct(public readonly bool $union_all = false, QuerySelect ...$select_queries)
    {
        // Add the select queries to the array
        array_push($this->select_queries, ...$select_queries);
    }

    public function push(QuerySelect ...$select_queries)
    {
        // Add the select queries to the array
        array_push($this->select_queries, ...$select_queries);
    }

    public function build(bool $semi_colon = true): string
    {
        // Build each select query and store them in an array
        $queries = array_map(fn ($v): string => $v->build(false), $this->select_queries);

        // Join the select queries using UNION or UNION ALL based on the value of $union_all
        $query = implode(($this->union_all) ? ' UNION ALL ' : ' UNION ', $queries);

        // Append a semicolon at the end of the query if $semi_colon is true
        return ($semi_colon) ? $query . ';' : $query;
    }
}
