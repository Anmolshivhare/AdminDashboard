<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductProfile extends Model
{
    protected $table = 'productprofiles';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'profile_pic'
    ];

}
