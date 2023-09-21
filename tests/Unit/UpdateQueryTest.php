<?php

declare(strict_types=1);

use Hindbiswas\QueBee\Query;
use PHPUnit\Framework\TestCase;

final class UpdateQueryTest extends TestCase
{
    public function test_update_query_build()
    {
        $expected = "UPDATE users SET name = 'Jane', age = '20' WHERE id = '53';";
        $data = [ 'name' => 'Jane', 'age' => 20, ];
        $query = Query::update('users')->set($data)->where('id', '=', '53')->build();
        $this->assertSame($expected, $query);
    }
}
