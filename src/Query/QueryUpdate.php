<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Query;

use Hindbiswas\QueBee\Clause\WhereClause;
use Hindbiswas\QueBee\Query;
use Hindbiswas\QueBee\Query\QueryStruct;

class QueryUpdate implements QueryStruct
{
    use WhereClause;

    protected array $data;

    public function __construct(protected readonly string $table) {}

    public function set(array $data): self
    {
        if (empty($data)) throw new \InvalidArgumentException('No data provided. Data array cannot be empty.');
        if (array_is_list($data)) throw new \InvalidArgumentException('Data must be an associative array.');
        $this->data = $data;
        return $this;
    }

    public function build(): string
    {
        if (!$this->where) throw new \BadMethodCallException('No Where clause added. Updates must have conditions.');

        return 'UPDATE '. $this->table . ' SET ' . Query::flattenByEqual($this->data) . ' WHERE '. $this->where . ';';
    }
}
