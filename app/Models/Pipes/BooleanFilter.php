<?php

namespace App\Models\Pipes;

use Illuminate\Database\Eloquent\Builder;

class BooleanFilter extends BaseFilter
{
    protected function apply(Builder $query): Builder
    {
        return $query->where($this->inputName, request()->input($this->inputName) ? 1 : 0);
    }
}
