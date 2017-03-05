<?php

namespace App\Traits;

trait OrderableTrait
{
    public function scopeLatestFirst($query) 
    {
        return $query->orderBy('created_at', 'desc');
    }
}