<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Traits;

use Hindbiswas\QueBee\Table\Values\DefaultVal;

trait DefaultValue
{
    protected string|null $default = null;

    public function default(DefaultVal|string|null $default): self
    {
        if ($default === null) $default = DefaultVal::NULL;
        
        if (is_string($default)) {
            $this->default = "'$default'";
            return $this;
        }

        if (!$default->isAllowed($this->type)) {
            $msg = "The type `" . $this->type . "` can't have `" . $default->name . "` as DEFAULT value.";
            throw new \InvalidArgumentException($msg);
        }

        if ($default == DefaultVal::NULL) $this->nullable();
        $this->default = $default->name;

        return $this;
    }

    public function defaultValue(): string|null
    {
        return $this->default;
    }
}
