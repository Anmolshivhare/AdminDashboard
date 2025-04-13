<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use App\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{

    /**
     * function to get all the permission
     *
     * @return array
     */
    public function getAllPermissions()
    {
        $childPermissions = Permission::all();
        $parentPermissions = $childPermissions->whereNull('parent_id');
        return  [
            'parents' => $parentPermissions,
            'children' => $childPermissions,
        ];
    }
    
    /**
     * function to get the permission data by id
     *
     * @param integer $permissionId
     * @return object
     */
    public function getPermissionById(int $permissionId)
    {
        return Permission::find($permissionId);
    }

    /**
     * function for the creation of the permission
     *
     * @param array $permissionName
     * @return object
     */
    public function createPermission(array $permissionName)
    {
        $permission = Permission::create([
            'guard_name' => 'web',
            'name' => $permissionName['name']
        ]);
        if (isset($permissionName['parent']) && $permissionName['parent'] != 'none') {
            $parent = Permission::find($permissionName['parent']);
            if ($parent) {
                $parent->appendNode($permission);
            }
        }
        if (isset($permissionName['children']) && is_array($permissionName['children'])) {
            foreach ($permissionName['children'] as $childId) {
                $child = Permission::find($childId);
                if ($child) {
                    $permission->appendNode($child);
                }
            }
        }
        return $permission;
    }

    /**
     * function to update the permission data by id
     *
     * @param integer $permissionId
     * @param array $permissionName
     * @return object
     */
    public function updatePermission(int $permissionId, array $permissionName)
    {
        $permission = Permission::findOrFail($permissionId);
        $permission->name = $permissionName['name'];
        if ($permissionName['parent'] ?? 'none' !== 'none') {
            $parent = Permission::find($permissionName['parent']);
            if ($parent) {
                $parent->appendNode($permission);
            }
        } else {
            $permission->makeRoot();
        }
        $permission->save();
        return $permission;
    }

    /**
     * function to delete the permission data by id
     *
     * @param integer $permissionId
     * @return object
     */
    public function deletePermissionById(int $permissionId)
    {
        $permission = Permission::findOrFail($permissionId);
        $permission->delete();
        return $permission;
    }

    /**
     * funtion to getAll the permision from the request
     *
     * @param object $request
     * @return array
     */
    public function getAllPermisionFromRequest($request)
    {
        $parentPermissions = $request->input('parents', []); 
        $childPermissions = $request->input('children', []); 
        return array_merge($parentPermissions, $childPermissions);
    }

    public function getPermissionDataFormRequest($requestData){

    }

}
