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
    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s\Z',
        'updated_at' => 'datetime:Y-m-d\TH:i:s\Z',
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
