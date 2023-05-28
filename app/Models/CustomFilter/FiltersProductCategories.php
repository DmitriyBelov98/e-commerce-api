<?php

namespace App\Models\CustomFilter;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FiltersProductCategories implements Filter
{

    public function __invoke(Builder $query, $value, string $property)
    {
        $query->whereHas('categories', function (Builder $query) use ($value) {
            $query->where('slug', $value);
        });
    }
}
