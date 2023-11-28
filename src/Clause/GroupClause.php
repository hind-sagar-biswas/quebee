<?php

// SELECT column1, column2, SUM(column3)
// FROM table_name
// GROUP BY column1, column2 WITH ROLLUP;

// SELECT column1, column2, SUM(column3)
// FROM table_name
// GROUP BY CUBE (column1, column2);

// SELECT column1, column2, column3, SUM(column4)
// FROM table_name
// GROUP BY GROUPING SETS (
//   (column1, column2),
//   (column2, column3),
//   (column1, column3),
//   (column1, column2, column3),
//   CUBE(column1, column2, column3)
// )
// ORDER BY column1, column2, column3;

declare(strict_types=1);

namespace Hindbiswas\QueBee\Clause;

use BadMethodCallException;
use Hindbiswas\QueBee\Stmt\CubeStmt;
use Hindbiswas\QueBee\Stmt\GroupingSet;
use Hindbiswas\QueBee\Stmt\Set;

trait GroupClause
{
    public ?string $group = null;

    public function groupBy(array|GroupingSet|CubeStmt|Set $statements): self
    {
        if (is_array($statements)) $this->group = 'GROUP BY ' . implode(', ', $statements);
        else $this->group = 'GROUP BY ' . $statements->build();
        return $this;
    }

    public function rollup(): self
    {
        if (!$this->group) throw new BadMethodCallException("Must Group columns before calling rollup");
        else $this->group .= ' WITH ROLLUP';
        return $this;
    }
}
