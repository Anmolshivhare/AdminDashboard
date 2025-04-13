<?php

namespace App\Interfaces;

interface PermissionRepositoryInterface
{
    public function getAllPermissions();

    public function getPermissionById(int $permissionId);

    public function createPermission(array $permissionName);

    public function updatePermission(int $permissionId, array $permissionName);

    public function deletePermissionById(int $permissionId);

    public function getAllPermisionFromRequest($request);

    public function getPermissionDataFormRequest($requestData);
}
