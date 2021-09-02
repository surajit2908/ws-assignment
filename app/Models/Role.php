<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'role_name'
    ];

    public function getRolePermission()
    {
        return $this->hasMany(RolePermission::class,'role_id','id');
    }
}
