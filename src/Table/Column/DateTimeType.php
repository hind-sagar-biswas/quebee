<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Column;

use Hindbiswas\QueBee\Table\Traits\UpdateTime;

class DateTimeType extends Column
{
    use UpdateTime;
    
    public function __construct()
    {
        $this->type = "DATETIME";
    }
}
