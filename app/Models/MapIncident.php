<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapIncident extends Model
{
    protected $fillable = [
        'api_id',
        'service',
        'place',
        'street',
        'description',
        'latitude',
        'longitude',
        'fetched_at',
    ];

    protected $casts = [
        'fetched_at' => 'datetime',
        'latitude' => 'float',
        'longitude' => 'float',
    ];
}

