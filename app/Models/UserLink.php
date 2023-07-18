<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'link_id',
        'label',
        'url'
    ];
}
