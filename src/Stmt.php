<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee;

use Hindbiswas\QueBee\Stmt\UnionStmt;
use Hindbiswas\QueBee\Query\QuerySelect;

class Stmt
{
    public static function union(QuerySelect ...$select_queries): UnionStmt
    {
        return new UnionStmt(false, ...$select_queries);
    }
    
    public static function unionAll(QuerySelect ...$select_queries): UnionStmt
    {
        return new UnionStmt(true, ...$select_queries);
    }
}
