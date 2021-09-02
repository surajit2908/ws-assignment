<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{

    protected $fillable = [
        'id',
        'role_id',
        'permission_id'
    ];

    public function getPermission()
    {
        return $this->hasOne(Permission::class,'id','permission_id');
    }
}
