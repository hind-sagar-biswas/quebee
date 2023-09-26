<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Values;

enum DefaultVal: string {
    case NULL = 'NULL';
    case CURRENT_TIME = 'CURRENT_TIMESTAMP';

    public function isAllowed(string $type): bool {
        return ($this === self::NULL) ? true : in_array($type, ['DATETIME', 'TIMESTAMP']);
    }
}