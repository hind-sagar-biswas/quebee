<?php

declare(strict_types=1);

use Hindbiswas\QueBee\Query;  // Include the Query namespace
use PHPUnit\Framework\TestCase;

// PHPUnit test class for testing the DELETE query builder
final class DeleteQueryTest extends TestCase
{
    // Test method to ensure the DELETE query is built correctly
    public function test_delete_query_build()
    {
        $expected = "DELETE FROM tests WHERE test_id = 1;";
        $query = Query::delete('tests')->where('test_id', 1)->build();
        $this->assertSame($expected, $query);
    }
}