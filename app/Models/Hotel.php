<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Hotel extends Model
{
    protected $fillable = ['name', 'location', 'description', 'rating', 'image'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    // Scope for filtering
    public function scopeFilter($query, $filters)
    {
        if (!empty($filters['location'])) {
            $query->where('location', 'like', '%' . $filters['location'] . '%');
        }

        if (!empty($filters['min_price']) && !empty($filters['max_price'])) {
            $query->whereHas('rooms', function ($q) use ($filters) {
                $q->whereBetween('price', [$filters['min_price'], $filters['max_price']]);
            });
        }

        return $query;
    }
}