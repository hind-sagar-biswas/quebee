<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Traits;

trait Zerofill
{
    public function zerofill(): self
    {
        if ($this->attribute) $this->attribute .= ' ZEROFILL';
        else $this->attribute = 'ZEROFILL';
        return $this;
    }
}
