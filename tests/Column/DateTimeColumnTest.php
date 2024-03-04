<?php

declare(strict_types=1);

use Hindbiswas\QueBee\Col;
use Hindbiswas\QueBee\Table\Values\DefaultVal;
use PHPUnit\Framework\TestCase;

final class DateTimeColumnTest extends TestCase
{
    public function test_date_column_build()
    {
        // Basic DATE column
        $expected = "`column` DATE NOT NULL";
        $query = Col::date()->build('column');
        $this->assertSame($expected, $query);

        // Nullable DATE column
        $expected = "`column` DATE NULL";
        $query = Col::date()->nullable()->build('column');
        $this->assertSame($expected, $query);
    }

    public function test_datetime_column_build()
    {
        // Basic DATETIME column
        $expected = "`column` DATETIME NOT NULL";
        $query = Col::dateTime()->build('column');
        $this->assertSame($expected, $query);

        // onupdate DATETIME column
        $expected = "`column` DATETIME on update CURRENT_TIMESTAMP NOT NULL";
        $query = Col::dateTime()->setOnUpdate()->build('column');
        $this->assertSame($expected, $query);

        // DATETIME column with DEFAULT CURRENT_TIMESTAMP
        $expected = "`column` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP";
        $query = Col::dateTime()->default(DefaultVal::CURRENT_TIME)->build('column');
        $this->assertSame($expected, $query);

        // Nullable DATETIME column with default NULL
        $expected = "`column` DATETIME NULL DEFAULT NULL";
        $query = Col::dateTime()->default(DefaultVal::NULL)->build('column');
        $this->assertSame($expected, $query);
    }
}
