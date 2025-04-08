<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Shop extends Model
{
    use Searchable;
    protected $fillable = ['shop_name'];

    public function products(){
        return $this->belongsToMany(Product::class,'product_shop')->withTimestamps();   
    }
 
}
