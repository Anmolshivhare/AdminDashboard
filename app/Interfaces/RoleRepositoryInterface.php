<?php

namespace App\Interfaces;

interface RoleRepositoryInterface
{
    public function getAllRoles();

    public function getRoleById(int $roleId);

    public function getRoleByName(string $roleName);

    public function createRole(array $roleName, array $permissions);

    public function updateRole(int $roleId, array $roleName, $permissions);

    public function deleteRoleById(int $roleId);

    public function getRoleByCompany();
}
