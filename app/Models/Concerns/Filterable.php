<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

trait Filterable
{
    public function scopeFilter(Builder $query)
    {
        $criteria = $this->filterCriteria();
        return app(Pipeline::class)
            ->send($query)
            ->through($criteria)
            ->thenReturn();
    }

    public function filterCriteria(): array
    {
        if (method_exists($this, 'getFilters')) {
            return $this->getFilters();
        }

        return property_exists($this, 'filters') ? $this->filters : [];
    }
}
