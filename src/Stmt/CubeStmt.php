<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Stmt;

use Hindbiswas\QueBee\SanitizeWord;
use Hindbiswas\QueBee\Stmt\StmtStruct;

class CubeStmt implements StmtStruct
{
    protected string $columns;

    public function __construct(string ...$columns)
    {
        if (!array_is_list($columns)) {
            $columnStrings = [];
            foreach ($columns as $alias => $columnName) {
                $columnName = SanitizeWord::run($columnName);
                if (!is_numeric($alias)) $alias = SanitizeWord::run($alias);
                $columnStrings[] = "$columnName AS $alias";
            }
            $columns = $columnStrings;
        }
        $this->columns = implode(', ', $columns);
    }

    public function build(): string
    {
        return "CUBE($this->columns)";
    }
}
