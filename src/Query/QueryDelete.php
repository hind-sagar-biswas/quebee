<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Query;

use Hindbiswas\QueBee\Clause\WhereClause;
use Hindbiswas\QueBee\Query\QueryStruct;

class QueryDelete implements QueryStruct
{
    use WhereClause;  // Include WHERE clause functionality

    public function __construct(private string $from)
    {
    }

    // Build and return the SQL DELETE query string
    public function build(): string
    {
        // Construct the WHERE clause if it's defined
        $whereClause = ($this->where) ? "WHERE " . $this->where : "";

        // Construct the DELETE query with the FROM clause and optional WHERE clause
        return trim("DELETE FROM $this->from $whereClause;");
    }
}
