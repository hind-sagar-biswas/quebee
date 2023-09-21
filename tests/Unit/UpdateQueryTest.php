<?php

declare(strict_types=1);

use Hindbiswas\QueBee\Query;
use PHPUnit\Framework\TestCase;

final class UpdateQueryTest extends TestCase
{
    public function test_update_query_build()
    {
        $expected = "UPDATE users SET name = 'Jane', age = '20', affiliation = NULL WHERE id = '53';";
        $data = [ 'name' => 'Jane', 'age' => 20, 'affiliation' => null ];
        $query = Query::update('users')->set($data)->where('id', '=', '53')->build();
        $this->assertSame($expected, $query);
    }

    public function test_empty_data_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        Query::update('users')->set([])->build();
    }

    public function test_non_assoc_data_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        Query::update('users')->set(['Jane', 0])->build();
    }

    public function test_no_where_clause_exception()
    {
        $this->expectException(BadMethodCallException::class);
        $data = ['name' => 'Jane', 'age' => 20, 'affiliation' => null];
        Query::update('users')->set($data)->build();
    }
}
