<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Traits;

use BadMethodCallException;

trait Constraint
{
    protected string|null $constraint = null;

    public function unique(): self
    {
        if ($this->constraint === 'PRIMARY KEY') throw new BadMethodCallException("Already marked column as Primary Key. Cannot Mark as UNIQUE.", 1);
        
        if (!$this->constraint) $this->constraint = 'UNIQUE';
        $this->constraint = 'UNIQUE ' . $this->constraint;
        return $this;
    }
    
    public function index(): self
    {
        if ($this->constraint === 'PRIMARY KEY') throw new BadMethodCallException("Already marked column as Primary Key. Cannot Index again.", 1);
        
        if (!$this->constraint) $this->constraint = 'INDEX';
        else $this->constraint .= ' INDEX';
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
