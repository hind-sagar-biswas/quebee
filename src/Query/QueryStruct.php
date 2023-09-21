<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Query;

// An interface defining the structure of query-building classes
interface QueryStruct
{
    // Constructor declaration for query-building classes (to be implemented by concrete classes)
    public function __construct();

    // A method that returns the built SQL query string
    public function build(): string;
}
