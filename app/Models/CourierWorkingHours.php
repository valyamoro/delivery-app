<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourierWorkingHours extends Model
{
    use HasFactory;

    protected $fillable = [
        'courier_id',
        'working_hours',
    ];

    public function courier(): BelongsTo
    {
        return $this->belongsTo(Courier::class);
    }

}
