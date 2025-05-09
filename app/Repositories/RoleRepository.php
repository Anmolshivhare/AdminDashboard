<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $model) {
       parent::__construct($model);
    }

     public function getRoleDataFormRequest($requestData)
    {
        return $requestData->only([
            'name',
        ]);
    }

}
