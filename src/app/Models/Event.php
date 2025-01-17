<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Event extends BaseModel
{
    protected $fillable = [
        'title',
        'venue',
        'user_id',
        'latitude',
        'longitude',
        'starting',
        'ending',
        'description',
    ];

    protected $with = [
        'images',
        'tickets'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    protected $appends = [
        'created'
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function scopeForUser(Builder $query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

