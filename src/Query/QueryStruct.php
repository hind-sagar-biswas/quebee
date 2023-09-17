<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Query;

interface QueryStruct
{
    public function build(): string;
}
