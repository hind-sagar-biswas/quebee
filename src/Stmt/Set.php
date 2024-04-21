<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Stmt;

use Hindbiswas\QueBee\SanitizeWord;
use Hindbiswas\QueBee\Stmt\StmtStruct;

class Set implements StmtStruct
{
    protected string $columns;

    public function __construct(string ...$columns)
    {
        $this->columns = implode(', ', array_map(fn (string $c): string => SanitizeWord::run($c), $columns));
    }

    public function build(): string
    {
        return "($this->columns)";
    }
}
