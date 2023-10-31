<?php

declare(strict_types=1);

use Hindbiswas\QueBee\Col;
use Hindbiswas\QueBee\Table\Values\DefaultVal;
use PHPUnit\Framework\TestCase;

final class DecimalColumnTest extends TestCase
{
    public function test_decimal_column_build()
    {
        /// Basic DECIMAL column
        $expected = "`column` DECIMAL(11,5) NOT NULL";
        $query = Col::decimal(11, 5)->build('column');
        $this->assertSame($expected, $query);

        /// zerofill DECIMAL column
        $expected = "`column` DECIMAL(11,5) ZEROFILL NOT NULL";
        $query = Col::decimal(11, 5)->zerofill()->build('column');
        $this->assertSame($expected, $query);

        /// Nullable DECIMAL column with default NULL
        $expected = "`column` DECIMAL(11,5) NULL DEFAULT NULL";
        $query = Col::decimal(11, 5)->nullable()->default(DefaultVal::NULL)->build('column');
        $this->assertSame($expected, $query);

        /// Unsigned DECIMAL column
        $expected = "`column` DECIMAL(11,5) UNSIGNED NOT NULL";
        $query = Col::decimal(11, 5)->unsigned()->build('column');
        $this->assertSame($expected, $query);

        /// Unsigned zerofill DECIMAL column
        $expected = "`column` DECIMAL(11,5) UNSIGNED ZEROFILL NOT NULL";
        $query = Col::decimal(11, 5)->unsigned()->zerofill()->build('column');
        $this->assertSame($expected, $query);
        $expected = "`column` DECIMAL(11,5) ZEROFILL UNSIGNED NOT NULL";
        $query = Col::decimal(11, 5)->zerofill()->unsigned()->build('column');
        $this->assertSame($expected, $query);
    }

    public function test_float_column_build()
    {
        /// Basic FLOAT column
        $expected = "`column` FLOAT(11,5) NOT NULL";
        $query = Col::float(11, 5)->build('column');
        $this->assertSame($expected, $query);

        /// zerofill FLOAT column
        $expected = "`column` FLOAT(11,5) ZEROFILL NOT NULL";
        $query = Col::float(11, 5)->zerofill()->build('column');
        $this->assertSame($expected, $query);

        /// Nullable FLOAT column with default NULL
        $expected = "`column` FLOAT(11,5) NULL DEFAULT NULL";
        $query = Col::float(11, 5)->nullable()->default(DefaultVal::NULL)->build('column');
        $this->assertSame($expected, $query);

        /// Unsigned FLOAT column
        $expected = "`column` FLOAT(11,5) UNSIGNED NOT NULL";
        $query = Col::float(11, 5)->unsigned()->build('column');
        $this->assertSame($expected, $query);

        /// Unsigned zerofill FLOAT column
        $expected = "`column` FLOAT(11,5) UNSIGNED ZEROFILL NOT NULL";
        $query = Col::float(11, 5)->unsigned()->zerofill()->build('column');
        $this->assertSame($expected, $query);
        $expected = "`column` FLOAT(11,5) ZEROFILL UNSIGNED NOT NULL";
        $query = Col::float(11, 5)->zerofill()->unsigned()->build('column');
        $this->assertSame($expected, $query);
    }

    public function test_double_column_build()
    {
        /// Basic DOUBLE column
        $expected = "`column` DOUBLE(11,5) NOT NULL";
        $query = Col::double(11, 5)->build('column');
        $this->assertSame($expected, $query);

        /// zerofill DOUBLE column
        $expected = "`column` DOUBLE(11,5) ZEROFILL NOT NULL";
        $query = Col::double(11, 5)->zerofill()->build('column');
        $this->assertSame($expected, $query);

        /// Nullable DOUBLE column with default NULL
        $expected = "`column` DOUBLE(11,5) NULL DEFAULT NULL";
        $query = Col::double(11, 5)->nullable()->default(DefaultVal::NULL)->build('column');
        $this->assertSame($expected, $query);

        /// Unsigned DOUBLE column
        $expected = "`column` DOUBLE(11,5) UNSIGNED NOT NULL";
        $query = Col::double(11, 5)->unsigned()->build('column');
        $this->assertSame($expected, $query);

        /// Unsigned zerofill DOUBLE column
        $expected = "`column` DOUBLE(11,5) UNSIGNED ZEROFILL NOT NULL";
        $query = Col::double(11, 5)->unsigned()->zerofill()->build('column');
        $this->assertSame($expected, $query);
        $expected = "`column` DOUBLE(11,5) ZEROFILL UNSIGNED NOT NULL";
        $query = Col::double(11, 5)->zerofill()->unsigned()->build('column');
        $this->assertSame($expected, $query);
    }

    public function test_real_column_build()
    {
        /// Basic REAL column
        $expected = "`column` REAL(11,5) NOT NULL";
        $query = Col::real(11, 5)->build('column');
        $this->assertSame($expected, $query);

        /// zerofill REAL column
        $expected = "`column` REAL(11,5) ZEROFILL NOT NULL";
        $query = Col::real(11, 5)->zerofill()->build('column');
        $this->assertSame($expected, $query);

        /// Nullable REAL column with default NULL
        $expected = "`column` REAL(11,5) NULL DEFAULT NULL";
        $query = Col::real(11, 5)->nullable()->default(DefaultVal::NULL)->build('column');
        $this->assertSame($expected, $query);

        /// Unsigned REAL column
        $expected = "`column` REAL(11,5) UNSIGNED NOT NULL";
        $query = Col::real(11, 5)->unsigned()->build('column');
        $this->assertSame($expected, $query);

        /// Unsigned zerofill REAL column
        $expected = "`column` REAL(11,5) UNSIGNED ZEROFILL NOT NULL";
        $query = Col::real(11, 5)->unsigned()->zerofill()->build('column');
        $this->assertSame($expected, $query);
        $expected = "`column` REAL(11,5) ZEROFILL UNSIGNED NOT NULL";
        $query = Col::real(11, 5)->zerofill()->unsigned()->build('column');
        $this->assertSame($expected, $query);
    }
}
