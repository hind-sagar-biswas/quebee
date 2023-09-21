<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Query;

use Hindbiswas\QueBee\Clause\WhereClause;
use Hindbiswas\QueBee\Query\QueryStruct;

class QueryUpdate implements QueryStruct
{
    use WhereClause;

    public function build(): string
    {
        return '';
    }
}
