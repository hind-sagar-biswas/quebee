<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Traits;

trait Constraint
{
    protected string|null $constraint = null;

    public function unique(): self
    {
        $this->constraint = 'UNIQUE';
        return $this;
    }

    public function primary(): self
    {
        $this->constraint = 'PRIMARY KEY';
        return $this;
    }

    public function pk(): self
    {
        $this->constraint = 'PRIMARY KEY';
        return $this;
    }

    public function getConstraints(): string|null {
        return $this->constraint;
    }
}
