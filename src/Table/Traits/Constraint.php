<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Traits;

trait Constraint
{
    protected string|null $constraint = null;

    public function unique(): self
    {
        $this->constraint = 'unique';
        return $this;
    }

    public function primary(): self
    {
        $this->constraint = 'primary';
        return $this;
    }
}
