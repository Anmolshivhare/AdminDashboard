<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as ModelsPermission;
use Kalnoy\Nestedset\NodeTrait;

class Permission extends ModelsPermission
{
    use NodeTrait;
}
