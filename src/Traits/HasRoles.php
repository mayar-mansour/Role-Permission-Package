<?php

namespace Mayar\RolePermission\Traits;

use Mayar\RolePermission\Models\Role;
use Mayar\RolePermission\Models\Permission;

trait HasRoles
{
    /**
     * Roles assigned to this user
     */
    public function roles()
    {
        return $this->morphToMany(
            Role::class,
            'model',
            'model_has_roles',
            'model_id',
            'role_id'
        );
    }

    /**
     * Permissions assigned directly to this user
     */
    public function permissions()
    {
        return $this->morphToMany(
            Permission::class,
            'model',
            'model_has_permissions',
            'model_id',
            'permission_id'
        );
    }

    /**
     * Check if user has a role
     */
    public function hasRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }

    /**
     * Check if user has a permission (direct or via role)
     */
    public function hasPermission(string $permission): bool
    {
        // Direct permission
        if ($this->permissions()->where('name', $permission)->exists()) {
            return true;
        }

        // Via role
        return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
            $query->where('name', $permission);
        })->exists();
    }

    /**
     * Assign role to user
     */
    public function assignRole($role)
    {
        $roleId = $role instanceof Role ? $role->id : $role;
        $this->roles()->attach($roleId);
    }

    /**
     * Give direct permission to user
     */
    public function givePermissionTo($permission)
    {
        $permissionId = $permission instanceof Permission ? $permission->id : $permission;
        $this->permissions()->attach($permissionId);
    }
}
