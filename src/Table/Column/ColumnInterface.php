<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Column;

use Hindbiswas\QueBee\Table\Values\DefaultVal;

interface ColumnInterface {
    public function unique(): self;
    public function primary(): self;
    public function nullable(): self;
    public function nullValue(): string;
    public function defaultValue(): string|null;
    public function getConstraints(): string|null;
    public function default(DefaultVal|string|null $default): self;
    public function build(string $name): string;
}