<?php

namespace App\Traits;

trait PivotOrderableTrait
{
    public function scopeOrderByPivot($query, $column = 'created_at', $order = 'desc') 
    {
        return $query->orderBy('pivot_' .$column, $order);
    }
}