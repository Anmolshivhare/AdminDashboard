<?php 
namespace App\Repositories;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getDataFromRequest(Request $request)
    {
        return $request->only([
            'name',
            'product_pic'
        ]);
    }





    // public function getProductsByCategory($categoryId)
    // {
    //     return $this->model::where('category_id', $categoryId)->get();
    // }

    // public function getProductsByPriceRange($minPrice, $maxPrice)
    // {
    //     return $this->model::whereBetween('price', [$minPrice, $maxPrice])->get();
    // }
}
?>