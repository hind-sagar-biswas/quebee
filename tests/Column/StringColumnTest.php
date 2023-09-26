<?php

declare(strict_types=1);

use Hindbiswas\QueBee\Col;
use Hindbiswas\QueBee\Table\Values\DefaultVal;
use PHPUnit\Framework\TestCase;

final class StringColumnTest extends TestCase
{
    public function test_varchar_column_build() {
        /// Basic VARCHAR column
        $expected = "`column` VARCHAR(255) NOT NULL";
        $query = Col::varchar()->build('column');
        $this->assertSame($expected, $query);

        /// Binary VARCHAR column
        $expected = "`column` VARCHAR(255) BINARY NOT NULL";
        $query = Col::varchar()->binary()->build('column');
        $this->assertSame($expected, $query);
        
        // Nullable VARCHAR column with default NULL
        $expected = "`column` VARCHAR(255) NULL DEFAULT NULL";
        $query = Col::varchar()->nullable()->default(DefaultVal::NULL)->build('column');
        $this->assertSame($expected, $query);
        
        // Basic VARCHAR column with default string
        $expected = "`column` VARCHAR(200) NOT NULL DEFAULT 'default value'";
        $query = Col::varchar(200)->default('default value')->build('column');
        $this->assertSame($expected, $query);
    }

    public function test_text_column_build() {
        /// Basic TEXT column
        $expected = "`column` TEXT NOT NULL";
        $query = Col::text()->build('column');
        $this->assertSame($expected, $query);
        
        // Nullable VARCHAR column with default NULL
        $expected = "`column` TEXT NULL DEFAULT NULL";
        $query = Col::text()->nullable()->default(DefaultVal::NULL)->build('column');
        $this->assertSame($expected, $query);
        
        
        // Basic VARCHAR column with default string
        $expected = "`column` TEXT NOT NULL DEFAULT 'default value'";
        $query = Col::text()->default('default value')->build('column');
        $this->assertSame($expected, $query);
    }
}
