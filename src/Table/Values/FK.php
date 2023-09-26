<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Values;

enum FK: string {
    case CASCADE = "CASCADE";
    case NO_ACTION = "NO ACTION";
    case NULL = "SET NULL";
}