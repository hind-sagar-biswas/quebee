<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Query;

use Hindbiswas\QueBee\Query\QueryStruct;

class QueryUnion implements QueryStruct{
    private array $select_queries = [];


    public function __construct(public readonly bool $union_all = false, QuerySelect ...$select_queries)
    {
        array_push($this->select_queries, ...$select_queries);
    }

    public function push(QuerySelect ...$select_queries)
    {
        array_push($this->select_queries, ...$select_queries);
    }

    public function build(bool $semi_colon = true): string {
        $queries = array_map(fn ($v): string => $v->build(false), $this->select_queries);
        $query = implode(($this->union_all) ? ' UNION ALL ' : ' UNION ', $queries);
        return $query;
    }
}