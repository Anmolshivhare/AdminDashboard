<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;

     /**
     * Get the name of the index associated with the model.
     */
    public function searchableAs(): string
    {
        return 'products_index';
    }

     /**
     * The attributes that should be searchable.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }


    protected $fillable = ['name','product_pic'];

   
    public function shops(){
        return $this->belongsToMany(Shop::class,'product_shop')->withTimestamps();   
    }
 
}
