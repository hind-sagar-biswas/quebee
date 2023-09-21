<?php

declare(strict_types=1);

use Hindbiswas\QueBee\Col;
use Hindbiswas\QueBee\Table\Values\DefaultVal;
use PHPUnit\Framework\TestCase;

final class IntegerColumnTest extends TestCase
{
    public function test_integer_column_build()
    {
        /// Basic INT column
        $expected = "`column` INT NOT NULL";
        $query = Col::integer()->build('column');
        $this->assertSame($expected, $query);

        /// length specified INT column
        $expected = "`column` INT(11) NOT NULL";
        $query = Col::integer(11)->build('column');
        $this->assertSame($expected, $query);

        /// Nullable INT column with default NULL
        $expected = "`column` INT NULL DEFAULT NULL";
        $query = Col::integer()->nullable()->default(DefaultVal::NULL)->build('column');
        $this->assertSame($expected, $query);

        /// Unsigned INT column
        $expected = "`column` INT UNSIGNED NOT NULL";
        $query = Col::integer()->unsigned()->build('column');
        $this->assertSame($expected, $query);
    }
}