<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackgroundColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color_code',
        'type',
        'status',
    ];
}
