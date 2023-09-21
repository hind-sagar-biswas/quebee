<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee;

use Hindbiswas\QueBee\Table\Column\Varchar;
use Hindbiswas\QueBee\Table\CreateTable;

class Col
{
    public static function varchar(int $length = 255): Varchar
    {
        return new Varchar($length);
    }
}
