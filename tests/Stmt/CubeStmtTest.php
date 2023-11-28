<?php

declare(strict_types=1);

use Hindbiswas\QueBee\Stmt;  // Include the Stmt namespace
use PHPUnit\Framework\TestCase;

// PHPUnit test class for testing the CUBE statements builder
final class CubeStmtTest extends TestCase
{
    // Test method to ensure CUBE statements are built correctly
    public function test_cube_stmt_build()
    {
        $expected = 'CUBE(column1, column2)';
        $query = Stmt::cube('column1', 'column2')->build();
        $this->assertSame($expected, $query);
    }
}
