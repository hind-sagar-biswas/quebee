<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Column;

class Date extends Column
{
    public function __construct()
    {
        $this->type = "DATE";
    }
}
