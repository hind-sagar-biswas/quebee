<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Query;

use Hindbiswas\QueBee\Clause\WhereClause;
use Hindbiswas\QueBee\Query;
use Hindbiswas\QueBee\Query\QueryStruct;

class QueryUpdate implements QueryStruct
{
    use WhereClause;  // Include WHERE clause functionality

    protected array $data;

    public function __construct(protected readonly string $table)
    {
    }

    // Set the data to be updated
    public function set(array $data): self
    {
        // Check if data array is empty
        if (empty($data)) throw new \InvalidArgumentException('No data provided. Data array cannot be empty.');

        // Check if data is an associative array
        if (array_is_list($data)) throw new \InvalidArgumentException('Data must be an associative array.');

        // Assign the data to the class property
        $this->data = $data;
        return $this;
    }

    // Build and return the SQL UPDATE query string
    public function build(): string
    {
        // Check if a WHERE clause is added, as updates must have conditions
        if (!$this->where) throw new \BadMethodCallException('No WHERE clause added. Updates must have conditions.');

        // Construct the SQL UPDATE query with SET and WHERE clauses
        return 'UPDATE ' . $this->table . ' SET ' . Query::flattenByEqual($this->data) . ' WHERE ' . $this->where . ';';
    }
}
