<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Traits;

trait Binary
{
    public function binary(): self
    {
        $this->attribute = 'BINARY';
        return $this;
    }
}
