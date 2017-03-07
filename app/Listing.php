<?php

namespace App;

use App\Traits\OrderableTrait;
use App\Traits\PivotOrderableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Listing extends Model
{
    use SoftDeletes, OrderableTrait, PivotOrderableTrait, Searchable;

    public function scopeIsLive($query)
    {
        return $query->where('live', true);
    }

    public function scopeIsNotLive($query)
    {
        return $query->where('live', false);
    }

    public function scopeFromCategory($query, Category $category)
    {
        return $query->where('category_id', $category->id);
    }

    public function scopeInArea($query, Area $area)
    {
        return $query->whereIn('area_id', array_merge([$area->id],
            $area->descendants->pluck('id')->toArray()));
    }

    public function live()
    {
        return $this->live;
    }

    public function cost()
    {
        return number_format($this->category->price / 100, 2);
    }

    public function ownedByUser(User $user)
    {
        return $this->user->id === $user->id;
    }

    public function toSearchableArray()
    {
        $properties = $this->toArray();

        $properties['created_at_human'] = $this->created_at->diffForHumans();
        $properties['user'] = $this->user;
        $properties['category'] = $this->category;
        $properties['area'] = $this->area;

        return $properties;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function favorites()
    {
        return $this->morphToMany(User::class, 'favoriteable');
    }

    public function favoritedBy(User $user)
    {
        return $this->favorites->contains($user);
    }

    public function viewedUsers()
    {
        return $this->belongsToMany(User::class, 'user_listing_views')
            ->withTimestamps()
            ->withPivot(['count']);
    }

    public function views()
    {
        return $this->viewedUsers()->sum('count');

        //return array_sum($this->viewedUsers->pluck('pivot.count')->toArray());  //alternate method
    }
}
