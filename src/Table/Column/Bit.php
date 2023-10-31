<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Column;

class Bit extends Column
{
    public function __construct(public readonly int|null $length = null)
    {
        $this->type = ($length) ? "BIT($length)" : "BIT";
    }
}
