<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Stmt;

use Hindbiswas\QueBee\Stmt\StmtStruct;

class GroupingSet implements StmtStruct
{
    protected string $sets;

    public function __construct(array|Set|CubeStmt ...$sets)
    {
        foreach ($sets as $key => $set) {
            $val = '';
            if (is_array($set)) $val = '(' . implode(', ', $set) . ')';
            else $val = $set->build();
            $sets[$key] = $val;
        }
        $this->sets = implode(', ', $sets);
    }

    public function build(): string
    {
        return "GROUPING SETS ($this->sets)";
    }
}
