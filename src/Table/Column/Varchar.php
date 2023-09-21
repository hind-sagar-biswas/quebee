<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Column;

class Varchar extends Column
{
    public function __construct(public readonly int $length)
    {
    }
}
