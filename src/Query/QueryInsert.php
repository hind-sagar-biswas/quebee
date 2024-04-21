<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Query;

use Hindbiswas\QueBee\Query;
use Hindbiswas\QueBee\SanitizeWord;
use Hindbiswas\QueBee\Query\QueryStruct;

class QueryInsert implements QueryStruct
{
    protected string $table;
    protected array $data;

    public function __construct(array $data, protected bool $multiple = false)
    {
        // Check if data array is empty
        if (empty($data)) throw new \InvalidArgumentException('No data provided. Data array cannot be empty.');

        // Handle multiple data insertion
        if ($this->multiple) {
            if (count($data) ===  1) {
                // If single data is provided for multiple, switch to single mode; i.e. multiple = false
                $this->multiple = false;
                $data = $data[0];
            } else {
                // Validate each data for multiple insertion
                foreach ($data as $d) {
                    if (!is_array($d)) throw new \InvalidArgumentException('Data must be an array of arrays.');
                    if (empty($d)) throw new \InvalidArgumentException('Data array must not contain an empty array.');
                    if (array_is_list($d)) throw new \InvalidArgumentException('Data must be an array of associative arrays.');
                }
            }
        }

        // Handle single data insertion
        if (!$this->multiple) {
            if (!is_array($data)) throw new \InvalidArgumentException('Data must be an array.');
            if (array_is_list($data)) throw new \InvalidArgumentException('Data must be an associative array.');
        }

        // Assign the validated data to the class property
        $this->data = $data;
    }

    // Specify the target table for INSERT
    public function into(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    // Build and return the SQL INSERT query string
    public function build(): string
    {
        $sql = 'INSERT INTO ';
        
        if ($this->multiple) {
            $columns = array_map(fn ($d) =>SanitizeWord::run($d), array_keys($this->data[0]));
            $values = array_map(fn ($d) => Query::flattenForValues($d), $this->data);

            // Construct the SQL query for multiple data insertion
            $sql .= $this->table . '(' . implode(', ', $columns) . ') VALUES ';
            $sql .= implode(', ', $values) . ';';
        } else {
            $columns = array_map(fn ($d) =>SanitizeWord::run($d), array_keys($this->data));
            $values = Query::flattenForValues($this->data);

            // Construct the SQL query for single data insertion
            $sql.= $this->table . '(' . implode(', ', $columns) . ') VALUES ' . $values . ';';
        }
        return $sql;
    }
}
