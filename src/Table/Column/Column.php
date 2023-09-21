<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Column;

use Hindbiswas\QueBee\Table\Traits\Constraint;
use Hindbiswas\QueBee\Table\Traits\DefaultValue;
use Hindbiswas\QueBee\Table\Traits\Nullable;

class Column implements ColumnInterface
{
    use Nullable;
    use DefaultValue;
    use Constraint;

    protected string $type;

    public function build(string $name): string
    {
        $sql = "`$name` " . $this->type . " " . $this->nullValue();
        if ($this->defaultValue()) $sql .= " DEFAULT " . $this->defaultValue();
        return $sql;
    }
}
