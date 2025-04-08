<?php

namespace App\Http\Controllers;

use App\DataTables\ShopsDataTable;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShopsDataTable $shopsDataTable)
    {
         return  $shopsDataTable->render('shop.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $shopData = Shop::first();
        $productData =Product::All();
        // $productData = $shopData->products();
        
        return view('shop.create',compact('productData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->only([
            'shop_name',
            'product_id',
        ]);
        $shop = Shop::create([
            'shop_name' => $data['shop_name'],
        ]);
        $pivotData = [];
        foreach($data['product_id'] as $productData)
        {
            $pivotData[$productData] = [
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        $shop->products()->sync($pivotData);
        
 
        return redirect()->route('shops.index') ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
