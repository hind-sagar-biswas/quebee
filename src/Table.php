<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee;

use Hindbiswas\QueBee\Table\CreateTable;

class Table
{
    public static function create(string $name): CreateTable
    {
        return new CreateTable($name);
    }
}
