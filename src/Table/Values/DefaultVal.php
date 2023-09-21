<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Values;

enum DefaultVal: string {
    case NULL = 'NULL';
    case CURRENT_TIME = 'CURRENT_TIMESTAMP';
}