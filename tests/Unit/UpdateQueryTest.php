<?php

declare(strict_types=1);

use Hindbiswas\QueBee\Query;  // Include the Query namespace
use PHPUnit\Framework\TestCase;

// PHPUnit test class for testing the UPDATE query builder
final class UpdateQueryTest extends TestCase
{
    // Test method to ensure UPDATE query is built correctly
    public function test_update_query_build()
    {
        $expected = "UPDATE users SET name = 'Jane', age = '20', affiliation = NULL WHERE id = '53';";
        $data = ['name' => 'Jane', 'age' => 20, 'affiliation' => null];
        $query = Query::update('users')->set($data)->where('id', '=', '53')->build();
        $this->assertSame($expected, $query);
    }

    // Test method to ensure an exception is thrown when data array is empty
    public function test_empty_data_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        Query::update('users')->set([])->build();
    }

    // Test method to ensure an exception is thrown when data array is non-associative
    public function test_non_assoc_data_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        Query::update('users')->set(['Jane', 0])->build();
    }

    // Test method to ensure an exception is thrown when no WHERE clause is added
    public function test_no_where_clause_exception()
    {
        $this->expectException(BadMethodCallException::class);
        $data = ['name' => 'Jane', 'age' => 20, 'affiliation' => null];
        Query::update('users')->set($data)->build();
    }
}
