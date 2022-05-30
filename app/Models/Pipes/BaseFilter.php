<?php

namespace App\Models\Pipes;

use Illuminate\Database\Eloquent\Builder;

abstract class BaseFilter
{
    public function __construct(protected string $inputName)
    {
    }

    public function handle(Builder $query, \Closure $next)
    {
        if (request()->has($this->inputName)) {
            $query = $this->apply($query);
        }
        return $next($query);
    }

    abstract protected function apply(Builder $query): Builder;
}
