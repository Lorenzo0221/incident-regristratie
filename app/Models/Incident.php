<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'type',
        'incident_at',
        'status',
        'attachment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
