<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Contracts\Activity;

class Hotel extends Model
{
    use SoftDeletes;
    use LogsActivity;
    
    protected $fillable = ['name', 'location', 'description', 'rating', 'image'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

  public function scopeFilter($query, $filters = [])
{
    
    if (!empty($filters['location'])) {
        $query->where('location', 'like', '%' . $filters['location'] . '%');
    }
    if (!empty($filters['min_price']) || !empty($filters['max_price'])) {
        $min = $filters['min_price'] ?? null;
        $max = $filters['max_price'] ?? null;

        $query->whereHas('rooms', function ($q) use ($min, $max) {
            if ($min && $max) {
                $q->whereBetween('price', [$min, $max]);
            } elseif ($min) {
                $q->where('price', '>=', $min);
            } elseif ($max) {
                $q->where('price', '<=', $max);
            }
        });
    }
    if (!empty($filters['capacity'])) {
        $query->whereHas('rooms', function ($q) use ($filters) {
            $q->where('capacity', '>=', $filters['capacity']);
        });
    }

}


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('hotels')
            ->logOnly(['name', 'location', 'rating', 'deleted_at'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn (string $eventName) =>
                "Hotel \"{$this->name}\" was {$eventName}"
            );
    }

    public function tapActivity(Activity $activity, string $eventName): void
    {
        $activity->properties = array_merge(
            $activity->properties->toArray() ?? [],
            [
                'ip'         => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]
        );
    }

// make microservise حتى انه كل feature تتقسم 

}