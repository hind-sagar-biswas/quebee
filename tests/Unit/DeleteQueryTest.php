<?php

declare(strict_types=1);

use Hindbiswas\QueBee\Query;
use PHPUnit\Framework\TestCase;

final class DeleteQueryTest extends TestCase
{
    public function test_delete_query_build()
    {
        $expected = "DELETE FROM tests WHERE test_id = '1';";
        $query = Query::delete('tests')->where('test_id', '=', 1)->build();
        $this->assertSame($expected, $query);
    }
}