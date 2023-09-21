<?php

declare(strict_types=1);

use Hindbiswas\QueBee\Query;
use PHPUnit\Framework\TestCase;

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


    public function test_single_insert_query_build()
    {
        // For single insert
        $data = $this->data[0];
        $expected = "INSERT INTO users(id, name, age) VALUES ('1', 'John', '30');";
        $query = Query::insert($data)->into('users')->build();
        $this->assertSame($expected, $query);
    }

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
    }


    public function test_empty_data_insert_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        Query::insert([])->into('users')->build();
    }


    public function test_data_non_assoc_insert_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        Query::insert([1, 2, 3])->into('users')->build();
    }


    public function test_empty_data_multiple_insert_single_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        Query::insert([['name' => 'John'], [], ['name' => 'Jane']])->into('users')->build();
    }


    public function test_multiple_data_non_assoc_insert_single_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        Query::insert([['John'], ['Jane']])->into('users')->build();
    }
}
