<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Stmt;

use Hindbiswas\QueBee\Stmt\StmtStruct;

class Set implements StmtStruct
{
    protected string $columns;

    public function __construct(array $columns)
    {
        $this->columns = implode(', ', $columns);
    }

    public function build(): string
    {
        return "($this->columns)";
    }
}
