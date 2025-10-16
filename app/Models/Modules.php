<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Modules extends Model
{
    //
    protected $fillable = [
        'id',
        'name',
        'description',
        
    ];

    public function usermod():HasMany
    {
        return $this->hasMany(UserModules::class,'module_id');
    }

    public function usermodacit():HasMany
    {
        return $this->usermod()->where('active',true);
    }
}
