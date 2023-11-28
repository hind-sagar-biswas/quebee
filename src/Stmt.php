<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee;

use Hindbiswas\QueBee\Stmt\UnionStmt;
use Hindbiswas\QueBee\Query\QuerySelect;
use Hindbiswas\QueBee\Stmt\CubeStmt;
use Hindbiswas\QueBee\Stmt\GroupingSet;
use Hindbiswas\QueBee\Stmt\Set;

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
    
    public static function cube(array $columns): CubeStmt
    {
        return new CubeStmt($columns);
    }
    
    public static function set(array $columns): Set
    {
        return new Set($columns);
    }
    
    public static function groupingSet(array|Set|CubeStmt ...$columns): GroupingSet
    {
        return new GroupingSet(...$columns);
    }
}
