<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Traits;

trait AutoIncrement
{
    public function ai(): self
    {
        $this->ai = true;
        $this->nullable();
        return $this;
    }
}
