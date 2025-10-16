<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModules extends Model
{
    //
     protected $fillable = [
        'user_id',
        'module_id',
        'active',
        
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function module():BelongsTo
    {
        return $this->belongsTo(Modules::class);
    }
}
