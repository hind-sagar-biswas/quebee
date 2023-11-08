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

trait GroupClause
{}