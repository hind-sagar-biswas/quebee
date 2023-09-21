<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Query;

// An interface defining the structure of query-building classes
interface QueryStruct
{
    // A method that returns the built SQL query string
    public function build(): string;
}
