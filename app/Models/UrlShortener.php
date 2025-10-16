<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrlShortener extends Model
{
    //
    protected $table = 'url_shortener';
    
    protected $fillable = [
        'id',
        'user_id',
        'original_url',
        'clicks',
        'code',
        'created_at'
    ];

    protected $hidden = [
        'updated_at',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s\Z',
        'updated_at' => 'datetime:Y-m-d\TH:i:s\Z',
    ];
}
