<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee;

use Hindbiswas\QueBee\Table\Column\BigInt;
use Hindbiswas\QueBee\Table\Column\Date;
use Hindbiswas\QueBee\Table\Column\Text;
use Hindbiswas\QueBee\Table\Column\Integer;
use Hindbiswas\QueBee\Table\Column\Varchar;
use Hindbiswas\QueBee\Table\Column\DateTimeType;
use Hindbiswas\QueBee\Table\Column\MediumInt;
use Hindbiswas\QueBee\Table\Column\SmallInt;
use Hindbiswas\QueBee\Table\Column\TinyInt;

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
    public static function bigInt(int|null $length = null): BigInt
    {
        return new BigInt($length);
    }
    public static function mediumInt(int|null $length = null): MediumInt
    {
        return new MediumInt($length);
    }
    public static function smallInt(int|null $length = null): SmallInt
    {
        return new SmallInt($length);
    }
    public static function tinyInt(int|null $length = null): TinyInt
    {
        return new TinyInt($length);
    }
    public static function text(): Text
    {
        return new Text();
    }
    public static function date(): Date
    {
        return new Date();
    }
    public static function dateTime(): DateTimeType
    {
        return new DateTimeType();
    }
}
