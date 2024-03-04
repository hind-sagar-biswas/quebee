<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Traits;

trait Nullable
{
    protected bool $nullable = false;

    public function nullable(): self {
        $this->nullable = true;
        return $this;
    }

    public function nullValue(): string {
        return ($this->nullable) ? 'NULL ' : 'NOT NULL ';
    }
}
