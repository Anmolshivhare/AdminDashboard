<?php

namespace App\Http\Controllers;

use App\DataTables\productprofilesDataTable;
use App\Models\ProductProfile;
use Illuminate\Http\Request;

class ProductPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(productprofilesDataTable $dataTable)
    {
        return $dataTable->render('price.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('price.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:10,12',
            'address' => 'required|string|max:255',
            'profile_pic' => 'nullable',
        ]);
        $data = $request->only(['name', 'email', 'phone', 'address']);
        ProductProfile::create($data);
        
        return redirect()->route('product-prices.index')->with('success', 'Product price created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productProfile = ProductProfile::find($id);
        return view('price.edit',compact('productProfile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:10,12',
            'address' => 'required|string|max:255',
            'profile_pic' => 'nullable',
        ]);
        $data = $request->only(['name', 'email', 'phone', 'address']);
        $productProfile = ProductProfile::findOrFail($id);
        $productProfile->update($data);
        return redirect()->route('product-prices.index')->with('success','Product Profile Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
