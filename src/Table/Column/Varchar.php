<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Column;

use Hindbiswas\QueBee\Table\Traits\Binary;

class Varchar extends Column
{
    use Binary;
    
    public function __construct(public readonly int $length)
    {
        $this->type = "VARCHAR($length)";
    }
}
