<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Column;

use Hindbiswas\QueBee\Table\Traits\Constraint;
use Hindbiswas\QueBee\Table\Traits\DefaultValue;
use Hindbiswas\QueBee\Table\Traits\Nullable;

class Column
{
    use Nullable;
    use DefaultValue;
    use Constraint;
}
