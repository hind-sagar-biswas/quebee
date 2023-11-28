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
use Hindbiswas\QueBee\Query;
use Hindbiswas\QueBee\Stmt\Set;
use Hindbiswas\QueBee\Stmt\CubeStmt;
use Hindbiswas\QueBee\Stmt\GroupingSet;

trait GroupClause
{
    public ?string $group = null;
    public ?string $having = null;

    public function groupBy(array|GroupingSet|CubeStmt|Set $statements): self
    {
        if (is_array($statements)) $this->group = 'GROUP BY ' . implode(', ', $statements);
        else $this->group = $statements->build();
        return $this;
    }

    public function rollup(): self
    {
        if (!$this->group) throw new BadMethodCallException("Must Group columns before calling rollup");
        else $this->group .= ' WITH ROLLUP';
        return $this;
    }

    public function having(
        string $aggregate_function,
        string $comparison = '=',
        int|string|null|bool $value,
    ): self {
        if (!$this->group) throw new BadMethodCallException("Must Group columns before calling having");
        if ($this->having !== null) return $this->andHaving($aggregate_function, $comparison, $value);
        $this->having = Query::buildCondition($aggregate_function, $value, $comparison);
        return $this;
    }

    public function andHaving(
        string $aggregate_function,
        int|string|null|bool $value,
        string $comparison = '=',
        bool $not = false,
        ): self {
        if ($this->having === null) return $this->having($aggregate_function, $value, $comparison);

        $initial = ($not) ? ' AND NOT ' : ' AND ';
        $this->having .= $initial . Query::buildCondition($aggregate_function, $value, $comparison);
        return $this;
    }

    public function orHaving(
        string $aggregate_function,
        int|string|null|bool $value,
        string $comparison = '=',
        bool $not = false,
    ): self {
        if ($this->having === null) return $this->having($aggregate_function, $value, $comparison);

        $initial = ($not) ? ' OR NOT ' : ' OR ';
        $this->having .= $initial .  Query::buildCondition($aggregate_function, $value, $comparison);
        return $this;
    }
}
