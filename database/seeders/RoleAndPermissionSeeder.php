<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //create permision user management
        $userManagementPermission = Permission::create(['name' => 'user-management']);
        Permission::create(['name' => 'role-list', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'role-create', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'role-edit', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'role-delete', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'role-show', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'permission-list', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'permission-create', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'permission-edit', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'permission-delete', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'permission-show', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'user-list', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'user-create', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'user-delete', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'user-edit', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'user-show', 'parent_id' => $userManagementPermission->id]);

        $superAdmin = Role::create(['guard_name' => 'web', 'name' => SUPER_ADMIN_ROLE_NAME]);
        $superAdmin->givePermissionTo(Permission::all());

        $adminRole = Role::create(['guard_name' => 'web', 'name' => ADMIN_ROLE_NAME]);
        $adminRole->givePermissionTo(Permission::all());
    }
}
