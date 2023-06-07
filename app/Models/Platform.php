<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'base_url',
        'icon',
        'status',
        'placeholder_en',
        'placeholder_fr',
        'placeholder_sp',
        'description_en',
        'description_fr',
        'description_sp',
    ];
}
