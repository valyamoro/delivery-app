<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCompletion extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'courier_id',
        'complete_time',
    ];

}
