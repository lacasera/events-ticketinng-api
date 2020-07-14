<?php

namespace App\Models;

class PaymentAccount extends BaseModel
{
    protected $guarded = [ 'id' ];

    protected $hidden = [
        'secret_key',
        'encryption_key'
    ];

    public function setPublicKeyAttribute($value)
    {
        $this->attributes['public_key'] = encrypt($value);
    }


    public function setSecretKeyAttribute($value)
    {
        $this->attributes['secret_key'] = encrypt($value);
    }

    public function setEncryptionKeyAttribute($value)
    {
        $this->attributes['encryption_key'] = encrypt($value);
    }

    public function getPublicKeyAttribute()
    {
        return decrypt($this->attributes['public_key']);
    }

    public function getSecretKeyAttribute()
    {
        return decrypt($this->attributes['secret_key']);
    }

    public function getEncryptionKeyAttribute()
    {
        return decrypt($this->attributes['encryption_key']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
