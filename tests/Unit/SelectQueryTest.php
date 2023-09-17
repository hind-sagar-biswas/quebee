<?php
declare(strict_types=1);

use Hindbiswas\QueBee\Query;
use PHPUnit\Framework\TestCase;

final class SelectQueryTest extends TestCase
{
    public function test_basic_select_query_build() {
        $expected = 'SELECT * FROM test';
        $query = Query::select()->from('test')->build();
        
        $this->assertSame($expected, $query);
    }

    public function test_ordered_select_query_build() {
        $expected = 'SELECT * FROM test ORDER BY class ASC, id DESC';
        $query = Query::select()->from('test')->orderBy('class')->orderBy('id', 'desc')->build();
        
        $this->assertSame($expected, $query);
    }

    public function test_select_query_with_limit_build() {
        $expected = 'SELECT * FROM test LIMIT 10, 50';
        $query = Query::select()->from('test')->limit(50, 10)->build();
        
        $this->assertSame($expected, $query);
    }

    public function test_select_query_with_alias_and_conditions_build() {
        $expected = "SELECT * FROM test AS t WHERE name = 'clause' OR id > '45'";
        $query = Query::select()->from('test', 't')->where('name', '=', 'clause')->orWhere('id', 'gt', 45)->build();
        
        $this->assertSame($expected, $query);
    }
    
    public function test_select_query_with_unaliased_columns_build() {
        $expected = "SELECT id, name, email FROM test";

        $cols = [
            'id', 'name', 'email'
        ];
        $query = Query::select($cols)->from('test')->build();
        
        $this->assertSame($expected, $query);
    }
    
    public function test_select_query_with_aliased_columns_build() {
        $expected = "SELECT user_id AS id, name AS user, email AS email FROM test";

        $aliased_cols = [
            'id' => 'user_id', 'user' => 'name', 'email' => 'email'
        ];
        $query = Query::select($aliased_cols)->from('test')->build();
        
        $this->assertSame($expected, $query);
    }

    public function test_full_select_query_build() {
        $expected = 'SELECT * FROM test';
        $query = Query::select()->from('test')->build();
        
        $this->assertSame($expected, $query);
    }
}
