<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Column;

use Hindbiswas\QueBee\Table\Traits\Unsigned;

class Integer extends Column
{
    use Unsigned;

    public function __construct(public readonly int|null $length = null)
    {
        $this->type = ($length) ? "INT($length)" : "INT";
    }
}
