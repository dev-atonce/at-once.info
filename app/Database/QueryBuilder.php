<?php

namespace App\Database;

use Illuminate\Database\Query\Builder;

class QueryBuilder extends Builder
{
    /**
     * Laravel 8 accepted null here and produced "0 = 1" (or "1 = 1" for NOT IN);
     * Laravel 10+ throws a TypeError. Keep the old behaviour for existing callers.
     */
    public function whereIn($column, $values, $boolean = 'and', $not = false)
    {
        return parent::whereIn($column, $values ?? [], $boolean, $not);
    }
}
