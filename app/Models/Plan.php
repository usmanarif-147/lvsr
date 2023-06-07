<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'price_id',
        'title',
        'name',
        'status',
        'currency',
        'interval',
        'interval_count',
        'amount',
    ];
}
