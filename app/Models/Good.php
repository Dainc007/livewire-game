<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'value',
        'type',
        'description'
    ];

    protected $casts = [
        'value' => 'integer'
    ];
}
