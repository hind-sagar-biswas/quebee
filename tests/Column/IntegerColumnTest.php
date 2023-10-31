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

        /// length specified zerofill INT column
        $expected = "`column` INT(11) ZEROFILL NOT NULL";
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

        /// Unsigned zerofill INT column
        $expected = "`column` INT UNSIGNED NOT NULL";
        $query = Col::integer()->unsigned(true)->build('column');
        $this->assertSame($expected, $query);
    }

    public function test_big_integer_column_build()
    {
        /// Basic BIGINT column
        $expected = "`column` BIGINT NOT NULL";
        $query = Col::bigInt()->build('column');
        $this->assertSame($expected, $query);

        /// length specified BIGINT column
        $expected = "`column` BIGINT(16) NOT NULL";
        $query = Col::bigInt(16)->build('column');
        $this->assertSame($expected, $query);

        /// Nullable BIGINT column with default NULL
        $expected = "`column` BIGINT NULL DEFAULT NULL";
        $query = Col::bigInt()->nullable()->default(DefaultVal::NULL)->build('column');
        $this->assertSame($expected, $query);

        /// Unsigned BIGINT column
        $expected = "`column` BIGINT UNSIGNED NOT NULL";
        $query = Col::bigInt()->unsigned()->build('column');
        $this->assertSame($expected, $query);

        /// Unsigned zerofill BIGINT column
        $expected = "`column` BIGINT UNSIGNED ZEROFILL NOT NULL";
        $query = Col::bigInt()->unsigned(true)->build('column');
        $this->assertSame($expected, $query);
    }

    public function test_medium_integer_column_build()
    {
        /// Basic MEDIUMINT column
        $expected = "`column` MEDIUMINT NOT NULL";
        $query = Col::mediumInt()->build('column');
        $this->assertSame($expected, $query);

        /// length specified MEDIUMINT column
        $expected = "`column` MEDIUMINT(16) NOT NULL";
        $query = Col::mediumInt(16)->build('column');
        $this->assertSame($expected, $query);

        /// Nullable MEDIUMINT column with default NULL
        $expected = "`column` MEDIUMINT NULL DEFAULT NULL";
        $query = Col::mediumInt()->nullable()->default(DefaultVal::NULL)->build('column');
        $this->assertSame($expected, $query);

        /// Unsigned MEDIUMINT column
        $expected = "`column` MEDIUMINT UNSIGNED NOT NULL";
        $query = Col::mediumInt()->unsigned()->build('column');
        $this->assertSame($expected, $query);

        /// Unsigned zerofill MEDIUMINT column
        $expected = "`column` MEDIUMINT UNSIGNED ZEROFILL NOT NULL";
        $query = Col::mediumInt()->unsigned(true)->build('column');
        $this->assertSame($expected, $query);
    }

    public function test_small_integer_column_build()
    {
        /// Basic SMALLINT column
        $expected = "`column` SMALLINT NOT NULL";
        $query = Col::smallInt()->build('column');
        $this->assertSame($expected, $query);

        /// length specified SMALLINT column
        $expected = "`column` SMALLINT(6) NOT NULL";
        $query = Col::smallInt(6)->build('column');
        $this->assertSame($expected, $query);

        /// Nullable SMALLINT column with default NULL
        $expected = "`column` SMALLINT NULL DEFAULT NULL";
        $query = Col::smallInt()->nullable()->default(DefaultVal::NULL)->build('column');
        $this->assertSame($expected, $query);

        /// Unsigned SMALLINT column
        $expected = "`column` SMALLINT UNSIGNED NOT NULL";
        $query = Col::smallInt()->unsigned()->build('column');
        $this->assertSame($expected, $query);

        /// Unsigned zerofill SMALLINT column
        $expected = "`column` SMALLINT UNSIGNED ZEROFILL NOT NULL";
        $query = Col::smallInt()->unsigned(true)->build('column');
        $this->assertSame($expected, $query);
    }

    public function test_tiny_integer_column_build()
    {
        /// Basic TINYINT column
        $expected = "`column` TINYINT NOT NULL";
        $query = Col::tinyInt()->build('column');
        $this->assertSame($expected, $query);

        /// length specified TINYINT column
        $expected = "`column` TINYINT(2) NOT NULL";
        $query = Col::tinyInt(2)->build('column');
        $this->assertSame($expected, $query);

        /// Nullable TINYINT column with default NULL
        $expected = "`column` TINYINT NULL DEFAULT NULL";
        $query = Col::tinyInt()->nullable()->default(DefaultVal::NULL)->build('column');
        $this->assertSame($expected, $query);

        /// Unsigned TINYINT column
        $expected = "`column` TINYINT UNSIGNED NOT NULL";
        $query = Col::tinyInt()->unsigned()->build('column');
        $this->assertSame($expected, $query);

        /// Unsigned zerofill TINYINT column
        $expected = "`column` TINYINT UNSIGNED ZEROFILL NOT NULL";
        $query = Col::tinyInt()->unsigned(true)->build('column');
        $this->assertSame($expected, $query);
    }
}