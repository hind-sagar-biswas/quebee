<?php

namespace Hindbiswas\QueBee\Query;

use Hindbiswas\QueBee\Clause\JoinClause;
use Hindbiswas\QueBee\Clause\LimitClause;
use Hindbiswas\QueBee\Clause\OrderClause;
use Hindbiswas\QueBee\Clause\WhereClause;
use Hindbiswas\QueBee\Query\QueryStruct;

class QuerySelect implements QueryStruct
{
    use WhereClause;
    use OrderClause;
    use LimitClause;
    use JoinClause;

    protected string $columns;
    protected string $table;
    protected string|null $alias;

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

    public function from($table, $alias = null)
    {
        $this->table = $table;
        $this->alias = $alias;
        return $this;
    }

    public function build(): string
    {
        if (!$this->table || empty($this->table)) {
            throw new \InvalidArgumentException("Table name cannot be null or empty");
        }

        $query = 'SELECT ' . $this->columns . ' FROM ' . $this->table;

        if ($this->alias) {
            $query .= ' AS ' . $this->alias;
        }

        $query .= $this->joinClause();

        if ($this->where) $query .= ' WHERE ' . $this->where;
        if (!empty($this->order)) $query .= ' ORDER BY ' . implode(', ', $this->order);
        if ($this->limit) $query .= ' LIMIT ' . $this->limit;

        return $query;
    }
}
