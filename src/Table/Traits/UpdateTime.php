<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Traits;

trait UpdateTime
{
    public function setOnUpdate(): self
    {
        $this->attribute = 'on update CURRENT_TIMESTAMP';
        return $this;
    }
}
