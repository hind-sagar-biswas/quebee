<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table;

class CreateTable {
    protected array $columns = [];

    public function __construct(public readonly string $name)
    {}

    public function columns(array $columns): self {
        $this->columns = $columns;
        return $this;
    }

    public function foreigns(array $constrains): self {
        return $this;
    }
}