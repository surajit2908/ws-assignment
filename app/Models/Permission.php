<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    protected $fillable = [
        'id',
        'module_name'
    ];

    public function getState()
    {
        return $this->hasOne(State::class,'id','state_id');
    }
}
