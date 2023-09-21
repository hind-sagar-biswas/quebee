<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Traits;

use Hindbiswas\QueBee\Table\Values\DefaultVal;

trait DefaultValue
{
    protected string|null $dafault = null;

    public function default(DefaultVal|string $default): self
    {
        if (is_string($default)) $this->default = "'$default'";

        if ($default == DefaultVal::NULL) $this->nullable();
        $this->default = $default->name;
        
        return $this;
    }

    public function defaultValue(): string|null { return $this->default; }
}
