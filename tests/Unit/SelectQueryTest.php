<?php

declare(strict_types=1);

use Hindbiswas\QueBee\Query;  // Include the Query namespace
use PHPUnit\Framework\TestCase;

// PHPUnit test class for testing the SELECT query builder
final class SelectQueryTest extends TestCase
{
    // Test method to ensure basic SELECT queries are built correctly
    public function test_basic_select_query_build()
    {
        // For select ALL
        $expected = 'SELECT * FROM test;';
        $query = Query::select()->from('test')->build();
        $this->assertSame($expected, $query);

        // For select ALL with table alias
        $expected = 'SELECT * FROM test AS t;';
        $query = Query::select()->from('test', 't')->build();
        $this->assertSame($expected, $query);

        // For select specific columns
        $expected = "SELECT id, name, email FROM test;";
        $cols = ['id', 'name', 'email'];
        $query = Query::select($cols)->from('test')->build();
        $this->assertSame($expected, $query);

        // For select specific columns with alias
        $expected = "SELECT user_id AS id, name AS user, email AS email FROM test;";
        $aliased_cols = ['id' => 'user_id', 'user' => 'name', 'email' => 'email'];
        $query = Query::select($aliased_cols)->from('test')->build();
        $this->assertSame($expected, $query);
    }

    // Test method to ensure ordered SELECT queries are built correctly
    public function test_ordered_select_query_build()
    {
        $expected = 'SELECT * FROM test ORDER BY class ASC, id DESC;';
        $query = Query::select()->from('test')->orderBy('class')->orderBy('id', 'desc')->build();
        $this->assertSame($expected, $query);
    }

    // Test method to ensure SELECT queries with LIMIT clauses are built correctly
    public function test_select_query_with_limit_build()
    {
        // For default limit
        $expected = 'SELECT * FROM test LIMIT 0, 50;';
        $query = Query::select()->from('test')->limit()->build();
        $this->assertSame($expected, $query);

        // For limit without offset
        $expected = 'SELECT * FROM test LIMIT 0, 20;';
        $query = Query::select()->from('test')->limit(20)->build();
        $this->assertSame($expected, $query);

        // For limit with offset
        $expected = 'SELECT * FROM test LIMIT 10, 50;';
        $query = Query::select()->from('test')->limit(50, 10)->build();
        $this->assertSame($expected, $query);
    }

    // Test method to ensure SELECT queries with WHERE and JOIN clauses are built correctly
    public function test_select_query_with_conditions_build()
    {
        // Basic conditions 
        $expected = "SELECT * FROM test WHERE id > '45';";
        $query = Query::select()->from('test')->where('id', 'gt', 45)->build();
        $this->assertSame($expected, $query);

        // Basic conditions - OR
        $expected = "SELECT * FROM test WHERE test_name = 'clause' OR id > '45';";
        $query = Query::select()->from('test')->where('test_name', '=', 'clause')->orWhere('id', 'gt', 45)->build();

        // Basic conditions - AND
        $expected = "SELECT * FROM test WHERE test_name = 'clause' AND id > '45';";
        $query = Query::select()->from('test')->where('test_name', '=', 'clause')->andWhere('id', 'gt', 45)->build();
        $this->assertSame($expected, $query);

        // Basic conditions - LIKE
        $expected = "SELECT * FROM test WHERE test_name LIKE '%clause%';";
        $query = Query::select()->from('test')->where('test_name', '??', '%clause%')->build();
        $this->assertSame($expected, $query);

        // Full Condition clause
        $expected = "SELECT * FROM test WHERE test_name LIKE '%clause%' OR id > '45' AND passed = '1';";
        $query = Query::select()->from('test')
            ->where('test_name', '??', '%clause%')
            ->orWhere('id', 'gt', 45)
            ->andWhere('passed', '=', 1)
            ->build();
        $this->assertSame($expected, $query);

        // Full Condition - via Clause
        $expected = "SELECT * FROM test WHERE test_name LIKE '%clause%' OR id > '45' AND passed = '1';";
        $query = Query::select()->from('test')
            ->whereClause("test_name LIKE '%clause%' OR id > '45' AND passed = '1'")
            ->build();
        $this->assertSame($expected, $query);
    }

    // Test method to ensure SELECT queries with JOIN clauses are built correctly
    public function test_select_query_with_joins_build()
    {
        // Basic - INNER JOIN
        $expected = "SELECT * FROM users AS u INNER JOIN tests AS t ON u.id = t.user_id;";
        $query = Query::select()->from('users', 'u')->join('tests', 't', 'u.id = t.user_id')->build();
        $this->assertSame($expected, $query);

        // Basic - LEFT JOIN
        $expected = "SELECT * FROM users AS u LEFT JOIN tests AS t ON u.id = t.user_id;";
        $query = Query::select()->from('users', 'u')->leftJoin('tests', 't', 'u.id = t.user_id')->build();
        $this->assertSame($expected, $query);

        // Basic - RIGHT JOIN
        $expected = "SELECT * FROM users AS u RIGHT JOIN tests AS t ON u.id = t.user_id;";
        $query = Query::select()->from('users', 'u')->rightJoin('tests', 't', 'u.id = t.user_id')->build();
        $this->assertSame($expected, $query);

        // Basic - FULL JOIN
        $expected = "SELECT * FROM users AS u FULL JOIN tests AS t ON u.id = t.user_id;";
        $query = Query::select()->from('users', 'u')->fullJoin('tests', 't', 'u.id = t.user_id')->build();
        $this->assertSame($expected, $query);

        // Full - use all joins
        $expected = "SELECT e.employee_name, d.department_name, p.project_name, c.customer_name FROM employees AS e LEFT JOIN departments AS d ON e.department_id = d.department_id INNER JOIN projects AS p ON e.employee_id = p.employee_id RIGHT JOIN customers AS c ON e.customer_id = c.customer_id;";
        $cols = ['e.employee_name', 'd.department_name', 'p.project_name', 'c.customer_name',];
        $query = Query::select($cols)->from('employees', 'e')
            ->leftJoin('departments', 'd', 'e.department_id = d.department_id')
            ->join('projects', 'p', 'e.employee_id = p.employee_id')
            ->rightJoin('customers', 'c', 'e.customer_id = c.customer_id')
            ->build();
        $this->assertSame($expected, $query);
    }

    // Test method to ensure a full SELECT query with all clauses is built correctly
    public function test_full_select_query_build()
    {
        // For select ALL
        $expected = "SELECT e.employee_name AS employee, d.department_name AS department, p.project_name AS project, c.customer_name AS customer FROM employees AS e LEFT JOIN departments AS d ON e.department_id = d.department_id INNER JOIN projects AS p ON e.employee_id = p.employee_id RIGHT JOIN customers AS c ON e.customer_id = c.customer_id WHERE e.employee_name LIKE '%clause%' OR d.id > '45' AND p.passed = '1' ORDER BY p.class ASC, c.id DESC LIMIT 10, 30;";
        $cols = [
            'employee' => 'e.employee_name',
            'department' => 'd.department_name',
            'project' => 'p.project_name',
            'customer' => 'c.customer_name',
        ];
        $query = Query::select($cols)->from('employees', 'e')
            ->leftJoin('departments', 'd', 'e.department_id = d.department_id')
            ->join('projects', 'p', 'e.employee_id = p.employee_id')
            ->rightJoin('customers', 'c', 'e.customer_id = c.customer_id')
            ->where('e.employee_name', '??', '%clause%')
            ->orWhere('d.id', 'gt', 45)
            ->andWhere('p.passed', '=', 1)
            ->orderBy('p.class')->orderBy('c.id', 'desc')
            ->limit(30, 10)
            ->build();
        $this->assertSame($expected, $query);
    }

    // Test method to ensure an exception is thrown when the table name is empty
    public function test_select_query_empty_table_name_throws_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        Query::select()->from('')->build();
    }

    // Test method to ensure an exception is thrown when no table name is provided
    public function test_select_query_no_table_name_throws_exception()
    {
        $this->expectException(Error::class);
        Query::select()->build();
    }
}
