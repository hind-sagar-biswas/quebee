<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Traits;

trait Unsigned
{
    public function unsigned(): self
    {
        if ($this->attribute) $this->attribute .= ' UNSIGNED';
        else $this->attribute = 'UNSIGNED';
        return $this;
    }
}
