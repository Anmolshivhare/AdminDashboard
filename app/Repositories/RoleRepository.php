<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * function to get all the roles
     *
     * @return object
     */
    public function getAllRoles()
    {
        return Role::get();
    }

    /**
     * function to get the role data by id
     *
     * @param integer $roleId
     * @return object
     */
    public function getRoleById(int $roleId)
    {
        return Role::find($roleId);
    }

    /**
     * function to get the role data by name
     *
     * @param string $roleName
     * @return object
     */
    public function getRoleByName(string $roleName)
    {
        return Role::where('name', $roleName)->first();
    }

    /**
     * function to create the role and assign the permission
     *
     * @param array $roleName
     * @param array $permission
     * @return object
     */
    public function createRole(array $roleName, $permissions)
    {
        $role = Role::create(['guard_name' => 'web', 'name' => $roleName['name']]);
        if (!empty($permissions)) {
            $role->permissions()->sync($permissions);
        }
        return $role;
    }

    /**
     * function to update the role data
     *
     * @param integer $roleId
     * @param array $roleName
     * @param array $permissions
     * @return object
     */
    public function updateRole(int $roleId, array $roleName, $permissions)
    {
        $role = Role::findOrFail($roleId);
        $role->name = $roleName['name'];
        $role->save();
        $role->permissions()->sync($permissions);
        return $role;
    }

    /**
     * function to delete the role data by id
     *
     * @param integer $roleId
     * @return object
     */
    public function deleteRoleById(int $roleId)
    {
        $role = Role::findOrFail($roleId);
        $role->delete();
        return $role;
    }

    /**
     * This function get company wise role
     */
    public function getRoleByCompany()
    {
        // return Role::whereNotIn('name', [SUPER_ADMIN_ROLE_NAME, ADMIN_ROLE_NAME])->get();
    }
}
