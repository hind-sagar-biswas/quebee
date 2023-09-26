<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Column;

class Text extends Column
{
    public function __construct()
    {
        $this->type = "TEXT";
    }
}
