<?php

namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ProductFilter extends AbstractFilter
{
    protected array $keys = [
        'integer',
        'checkbox',
        'select',
    ];

    protected function integer(Builder $builder, $value)
    {
        if (isset($value['from'])) {
            $builder->whereHas('paramProduct', function ($query) use ($value) {
                foreach ($value['from'] as $key => $v) {
                    $query->where('param_id', $key)->whereRaw('CAST(value as INT) >= ?', $v);
                }
            });
        }
        if (isset($value['to'])) {
            $builder->whereHas('paramProduct', function ($query) use ($value) {
                foreach ($value['to'] as $key => $v) {
                    $query->where('param_id', $key)->whereRaw('CAST(value as INT) <= ?', $v);
                }
            });
        }
    }

    protected function select(Builder $builder, $value)
    {
        $builder->whereHas('paramProduct', function ($query) use ($value) {
            foreach ($value as $key => $v) {
                $query->where('param_id', $key)->where('value', $v);
            }
        });
    }

    protected function checkbox(Builder $builder, $value)
    {
        $builder->whereHas('paramProduct', function ($query) use ($value) {
            foreach ($value as $key => $v) {
                $query->where('param_id', $key)->whereIn('value', $v);
            }
        });
    }
}
