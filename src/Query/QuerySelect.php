<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Query;

use Hindbiswas\QueBee\Clause\JoinClause;
use Hindbiswas\QueBee\Clause\LimitClause;
use Hindbiswas\QueBee\Clause\OrderClause;
use Hindbiswas\QueBee\Clause\WhereClause;
use Hindbiswas\QueBee\Query\QueryStruct;

class QuerySelect implements QueryStruct
{
    use WhereClause;  // Include WHERE clause functionality
    use OrderClause;  // Include ORDER BY clause functionality
    use LimitClause;  // Include LIMIT clause functionality
    use JoinClause;   // Include JOIN clause functionality

    protected string $columns;
    protected string $table;
    protected string|null $alias;

    // Constructor to initialize columns for SELECT
    public function __construct(array $columns)
    {
        if (!array_is_list($columns)) {
            $columnStrings = [];
            foreach ($columns as $alias => $columnName) {
                $columnStrings[] = "$columnName AS $alias";
            }
            $columns = $columnStrings;
        }
        $this->columns = implode(', ', $columns);
    }

    // Set the FROM clause table and optional alias
    public function from($table, $alias = null): self
    {
        $this->table = $table;
        $this->alias = $alias;
        return $this;
    }

    // Build and return the SQL query string
    public function build(bool $semi_colon = true): string
    {
        // Check if the table name is not null or empty
        if (!$this->table || empty($this->table)) {
            throw new \InvalidArgumentException("Table name cannot be null or empty");
        }

        // Initialize the query string with the SELECT clause and specified columns
        $query = 'SELECT ' . $this->columns . ' FROM ' . $this->table;

        // Add an optional table alias to the query
        if ($this->alias) {
            $query .= ' AS ' . $this->alias;
        }

        // Add any JOIN clauses to the query
        $query .= $this->joinClause();

        // Add a WHERE clause to the query if it's defined
        if ($this->where) $query .= ' WHERE ' . $this->where;

        // Add an ORDER BY clause to the query if sorting is specified
        if (!empty($this->order)) $query .= ' ORDER BY ' . implode(', ', $this->order);

        // Add a LIMIT clause to the query if it's specified
        if ($this->limit) $query .= ' LIMIT ' . $this->limit;

        // Append a semicolon to the query to complete it
        return ($semi_colon) ? $query . ';' : $query;
    }
}
