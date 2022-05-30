<?php

namespace App\Models\Pipes;

use Illuminate\Database\Eloquent\Builder;

class RelativeFilter extends BaseFilter
{
    protected function apply(Builder $query): Builder
    {
        return $query->where($this->inputName, 'like', "%" . request()->input($this->inputName) . "%");
    }
}
