<?php

namespace Mayar\RolePermission\Models;

use Illuminate\Database\Eloquent\Model;
use Mayar\RolePermission\Models\Permission;

class Role extends Model
{
    protected $fillable = ['name', 'guard_name'];

    /**
     * Permissions assigned to this role
     */
    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'role_has_permissions',
            'role_id',
            'permission_id'
        );
    }

    /**
     * All models that have this role
     */
    public function users()
    {
        return $this->morphedByMany(
            \App\Models\User::class,
            'model',
            'model_has_roles',
            'role_id',
            'model_id'
        );
    }
}
