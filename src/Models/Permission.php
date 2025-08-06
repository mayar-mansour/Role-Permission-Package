<?php

namespace Mayar\RolePermission\Models;

use Illuminate\Database\Eloquent\Model;
use Mayar\RolePermission\Models\Role;

class Permission extends Model
{
    protected $fillable = ['name', 'guard_name'];

    /**
     * Roles that have this permission
     */
    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'role_has_permissions',
            'permission_id',
            'role_id'
        );
    }

    /**
     * All models that have this permission directly
     */
    public function users()
    {
        return $this->morphedByMany(
            \App\Models\User::class,
            'model',
            'model_has_permissions',
            'permission_id',
            'model_id'
        );
    }
}
