<?php

namespace App\Http\Controllers;

use App\DataTables\ProductsDataTable;
use App\Http\Requests\Product\CreateProudctRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\User;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(ProductsDataTable $productsDataTable)
    {

        return $productsDataTable->render('product.index');
    }

    public function data(ProductsDataTable $dataTable)
    {
        return $dataTable->ajax();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProudctRequest $request)
    {
        $requestData = $this->productRepository->getDataFromRequest($request);
        if (!empty($requestData['product_pic'])) {
            $image = $requestData['product_pic'];
            $destination = 'uploads/products';
            $requestData['product_pic'] = uploadImages($image, $destination);
        }

        try {
            $this->productRepository->addData($requestData);
            // Product::create($validated);
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'project create successfully',
                    'redirect' => route('products.index'),
                ]);
            }

            // return redirect()->route('products.index');

        } catch (Exception $exception) {

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function searchData(Request $request)
    {
        $searchTerm = $request['query'];
        try {

            $products  = User::search($searchTerm)->get();

            $data = [];
            foreach ($products as $product) {
                $data[] = [
                    'id' => $product->id,
                    'name' => $product->name, // Adjust this to the field you want to show
                    'email' => $product->email // Adjust this to the field you want to show
                ];
            }

            return response()->json($data);
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productData = Product::find($id);
        return view('product.edit', compact('productData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $productDetails = $request->only([
            'name',
            'product_pic'
        ]);
        try {
            $productData = Product::findOrFail($id);
            if (!empty($productDetails['product_pic'])) {
                $image = $productDetails['product_pic'];
                $destination = 'uploads/products';
                $productDetails['product_pic'] = uploadImages($image, $destination);
                
                // Check if there is an existing profile picture
                if (!empty($productData['product_pic'])) {
                    $existingImagePath = public_path($destination . '/' . $productData['product_pic']);
                    // Delete the old profile picture if it exists
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath);
                    }
                }
            }
            $productData->update($productDetails);
            return redirect()->route('products.index')->with('message', 'Product Update Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index')->with('message', 'Product Delete');
    }
}
