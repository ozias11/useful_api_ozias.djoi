<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransfertAmount extends Model
{
    //
    protected $fillable = [
        'id',
        'sender_id',
        'receiver_id',
        'amount',
        'status',
        'created_at'

    ];
    protected $hidden = [
        'updated_at',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s\Z',
    ];
}
