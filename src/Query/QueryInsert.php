<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Query;

use Hindbiswas\QueBee\Query;
use Hindbiswas\QueBee\Query\QueryStruct;

class QueryInsert implements QueryStruct
{
    protected string $table;
    protected array $data;

    public function __construct(array $data, protected bool $multiple = false)
    {
        if (empty($data)) throw new \InvalidArgumentException('No data provided. Data array cannot be empty.');

        if ($this->multiple) {
            if (count($data) ===  1) {
                // If single data is provided for multiple, switch to single mode; i.e. multiple = false
                $this->multiple = false;
                $data = $data[0];
            } else {
                // Validate each data
                foreach ($data as $d) {
                    if (!is_array($d)) throw new \InvalidArgumentException('Data must be an array of arrays.');
                    if (empty($d)) throw new \InvalidArgumentException('Data array must not contain empty array.');
                    if (array_is_list($d)) throw new \InvalidArgumentException('Data must be an array of assoc arrays.');
                }
            }
        }

        // If not multiple or switched from multiple
        if (!$this->multiple) {
            if (!is_array($data)) throw new \InvalidArgumentException('Data must be an array of arrays.');
            if (array_is_list($data)) throw new \InvalidArgumentException('Data must be an associative array.');
        }

        $this->data = $data;
    }

    public function into(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function build(): string
    {
        $sql = 'INSERT INTO ';
        
        if ($this->multiple) {
            $columns = array_keys($this->data[0]);
            $values = array_map(function ($d) { return  Query::flattenForValues($d); }, $this->data);

            $sql .= $this->table . '('. implode(', ', $columns). ') VALUES ';
            $sql .= implode(', ', $values) . ';';
        } else {
            $columns = array_keys($this->data);
            $values = Query::flattenForValues($this->data);

            $sql.= $this->table . '('. implode(', ', $columns). ') VALUES ' . $values . ';';
        }
        return $sql;
    }
}
