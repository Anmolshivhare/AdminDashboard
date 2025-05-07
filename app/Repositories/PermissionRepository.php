<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use App\Models\Permission;

class PermissionRepository extends BaseRepository
{

    /**
     * Create a new class instance.
     */
    public function __construct(Permission $model)
    {
        parent::__construct($model);
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

    public function getPermissionDataFormRequest($requestData)
    {

        return $requestData->only([
            'name',
            'parent'
        ]);
    }
}
