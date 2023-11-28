<?php

declare(strict_types=1);

use Hindbiswas\QueBee\Stmt;  // Include the Stmt namespace
use Hindbiswas\QueBee\Query;  // Include the Query namespace
use PHPUnit\Framework\TestCase;

// PHPUnit test class for testing the UNION query builder
final class UnionStmtTest extends TestCase
{
    // Test method to ensure UNION queries are built correctly
    public function test_union_query_build()
    {
        $expected = 'SELECT * FROM table1 UNION SELECT * FROM table2 UNION SELECT * FROM table3;';
        $query = Stmt::union(
            Query::select()->from('table1'),
            Query::select()->from('table2'),
            Query::select()->from('table3'),
        )->build();
        $this->assertSame($expected, $query);
    }

    // Test method to ensure UNION ALL queries are built correctly
    public function test_union_all_query_build()
    {
        $expected = 'SELECT * FROM table1 UNION ALL SELECT * FROM table2 UNION ALL SELECT * FROM table3;';
        $query = Stmt::unionAll(
            Query::select()->from('table1'),
            Query::select()->from('table2'),
            Query::select()->from('table3'),
        )->build();
        $this->assertSame($expected, $query);
    }
}
