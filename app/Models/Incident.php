<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $fillable = [
        'user_id',
        'assignee_id',
        'title',
        'description',
        'location',
        'type',
        'incident_at',
        'status',
        'priority',
        'attachment',
    ];

    protected $casts = [
        'incident_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }
}
