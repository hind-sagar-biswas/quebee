<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Column;

interface ColumnInterface {
    public function build(string $name): string;
}