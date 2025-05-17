<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;

class UserRepository extends BaseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getDataFromRequest(Request $request)
    {
        return $request->only([
            'name',
            'email',
            'phone_no',
            'address',
            'profile_pic',
            'password',
            'role',
        ]);
    }
}
