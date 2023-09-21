<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee;

use Hindbiswas\QueBee\Table\Column\Integer;
use Hindbiswas\QueBee\Table\Column\Varchar;

class Col
{
    public static function varchar(int $length = 255): Varchar
    {
        return new Varchar($length);
    }


    public static function integer(int|null $length = null): Integer
    {
        return new Integer($length);
    }
}
