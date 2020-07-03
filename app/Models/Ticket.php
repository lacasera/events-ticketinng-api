<?php

namespace App\Models;

class Ticket extends BaseModel
{
    protected $guarded = [ 'id' ];

    protected $hidden = [
        'event_id',
        'updated_at',
        'created_at'
    ];

    protected $appends = [
        'created'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function paymentAccounts()
    {
        return $this->hasMany(PaymentAccount::class);
    }
}
