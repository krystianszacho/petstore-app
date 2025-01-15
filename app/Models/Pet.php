<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'id',
        'name',
        'category',
        'photoUrls',
        'tags',
        'status'
    ];
}
