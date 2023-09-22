<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Traits;

trait Unsigned
{
    public function unsigned(bool $zerofill = false): self
    {
        $this->attribute = 'UNSIGNED';
        if ($zerofill) $this->attribute .= ' ZEROFILL';
        return $this;
    }
}
