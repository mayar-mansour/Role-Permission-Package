<?php
use Illuminate\Database\Seeder;
use Mayar\RolePermission\Models\Role;
use Mayar\RolePermission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);

        $edit = Permission::create(['name' => 'edit-posts']);
        $delete = Permission::create(['name' => 'delete-posts']);

        $admin->permissions()->attach([$edit->id, $delete->id]);

        $user = User::first();
        if ($user) {
            $user->assignRole('admin');
            $user->givePermissionTo('edit-posts');
        }
    }
}
