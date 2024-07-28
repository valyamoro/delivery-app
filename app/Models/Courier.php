<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Courier extends Model
{
    use HasFactory;

    protected $fillable = [
        'courier_type_id',
    ];

    public function workingHours(): HasMany
    {
        return $this->hasMany(CourierWorkingHours::class);
    }

    public function courierRegions(): BelongsToMany
    {
        return $this->belongsToMany(Region::class);
    }

    public function courierType(): BelongsTo
    {
        return $this->belongsTo(CourierType::class);
    }

}
