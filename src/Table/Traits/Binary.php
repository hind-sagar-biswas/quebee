<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Traits;

trait Binary
{
    protected $binary = false;
    public function binary(): self
    {
        if (!$this->binary) {
            $this->binary = true;
            $this->type .= ' BINARY';
        }
        return $this;
    }
}
