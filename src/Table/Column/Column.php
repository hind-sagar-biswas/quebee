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

    protected string|null $attribute = null;
    protected string $type;
    protected $ai = false;

    public function build(string $name): string
    {
        $sql = "`$name` " . $this->type . " ";
        $sql .= ($this->attribute) ? $this->attribute . " " . $this->nullValue() : $this->nullValue();
        if ($this->defaultValue()) $sql .= " DEFAULT " . $this->defaultValue();
        if (strpos($this->type, 'INT') !== false && $this->ai) $sql .= " AUTO_INCREMENT";
        return $sql;
    }
}
