<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    //
     protected $fillable = [
        'user_id',
        'balance',
        
    ];
    protected $hidden = [
        'id',
        'updated_at',
        'created_at'
    ];

}
