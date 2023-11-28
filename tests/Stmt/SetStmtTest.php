<?php

declare(strict_types=1);

use Hindbiswas\QueBee\Stmt;  // Include the Stmt namespace
use PHPUnit\Framework\TestCase;

// PHPUnit test class for testing the SET statements builder
final class SetStmtTest extends TestCase
{
    // Test method to ensure SET statements are built correctly
    public function test_set_stmt_build()
    {
        $expected = '(column1, column2)';
        $query = Stmt::set(['column1', 'column2'])->build();
        $this->assertSame($expected, $query);
    }

    // Test method to ensure GROUPING SETS statements are built correctly
    public function test_grouping_sets_stmt_build()
    {
        $expected = 'GROUPING SETS ((column1, column2), (column1, column2), CUBE(column1, column2))';
        $query = Stmt::groupingSet(['column1', 'column2'], Stmt::set(['column1', 'column2']), Stmt::cube(['column1', 'column2']))->build();
        $this->assertSame($expected, $query);
    }
}
