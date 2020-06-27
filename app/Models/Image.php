<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    
    protected $fillable = ['url'];

    protected $hidden = [
        'imageable_id',
        'id',
        'imageable_type',
        'created_at',
        'updated_at',
        'url'
    ];
    
    protected $appends = ['link'];
    
    public function imageable()
    {
        return $this->morphTo();
    }


    public function getLinkAttribute()
    {
        return Storage::url($this->url);
    }

}
