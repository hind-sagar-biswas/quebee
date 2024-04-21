<?php

declare(strict_types=1);

use Hindbiswas\QueBee\Query;  // Include the Query namespace
use PHPUnit\Framework\TestCase;

// PHPUnit test class for testing the INSERT query builder
final class InsertQueryTest extends TestCase
{
    private array $data =
    [
        [
            'id' => 1,
            'name' => 'John',
            'age' => 30,
        ],
        [
            'id' => 2,
            'name' => 'Jane',
            'age' => 20,
        ]
    ];

    // Test method to ensure a single INSERT query is built correctly
    public function test_single_insert_query_build()
    {
        // For single insert
        $data = $this->data[0];
        $expected = "INSERT INTO users(id, name, age) VALUES ('1', 'John', '30');";
        $query = Query::insert($data)->into('users')->build();
        $this->assertSame($expected, $query);
    }

    // Test method to ensure a multiple INSERT query is built correctly
    public function test_multiple_insert_query_build()
    {
        // For normal insertMultiple
        $expected = "INSERT INTO users(id, name, age) VALUES ('1', 'John', '30'), ('2', 'Jane', '20');";
        $query = Query::insertMultiple($this->data)->into('users')->build();
        $this->assertSame($expected, $query);

        // For single array in multiple data
        $data = [$this->data[0]];
        $expected = "INSERT INTO users(id, name, age) VALUES ('1', 'John', '30');";
        $query = Query::insertMultiple($data)->into('users')->build();
        $this->assertSame($expected, $query);

        // For restricted keys
        $expected = "INSERT INTO office(name, `rank`, phone, types) VALUES ('Liza', 'COMPUTER TECHNICIAN', '01406727506', 'lab');";
        $query = Query::insert([
            'name' => 'Liza',
            'rank' => 'COMPUTER TECHNICIAN',
            'phone' => '01406727506',
            'types' => 'lab',
        ])->into('office')->build();
        $this->assertSame($expected, $query);
    }

    // Test method to ensure an exception is thrown when trying to insert empty data
    public function test_empty_data_insert_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        Query::insert([])->into('users')->build();
    }

    // Test method to ensure an exception is thrown when trying to insert non-associative data
    public function test_data_non_assoc_insert_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        Query::insert([1, 2, 3])->into('users')->build();
    }

    // Test method to ensure an exception is thrown when trying to insert empty data in multiple insert
    public function test_empty_data_multiple_insert_single_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        Query::insert([['name' => 'John'], [], ['name' => 'Jane']])->into('users')->build();
    }

    // Test method to ensure an exception is thrown when trying to insert non-associative data in multiple insert
    public function test_multiple_data_non_assoc_insert_single_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        Query::insert([['John'], ['Jane']])->into('users')->build();
    }
}
