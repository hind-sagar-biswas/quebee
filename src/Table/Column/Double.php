<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Column;

use Hindbiswas\QueBee\Table\Traits\Unsigned;
use Hindbiswas\QueBee\Table\Traits\Zerofill;

class Double extends Column
{
    use Zerofill;
    use Unsigned;

    public function __construct(public readonly int $total_digits, public readonly int $decimal_digits)
    {
        $this->type = "DOUBLE($total_digits,$decimal_digits)";
    }
}
