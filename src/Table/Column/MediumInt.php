<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Column;

use Hindbiswas\QueBee\Table\Traits\AutoIncrement;
use Hindbiswas\QueBee\Table\Traits\Unsigned;
use Hindbiswas\QueBee\Table\Traits\Zerofill;

class MediumInt extends Column
{
    use Zerofill;
    use Unsigned;
    use AutoIncrement;

    public function __construct(public readonly int|null $length = null)
    {
        $this->type = ($length) ? "MEDIUMINT($length)" : "MEDIUMINT";
    }
}
