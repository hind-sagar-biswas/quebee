<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Stmt;

// An interface defining the structure of query-building classes
interface StmtStruct
{
    // A method that returns the built SQL query string
    public function build(): string;
}
