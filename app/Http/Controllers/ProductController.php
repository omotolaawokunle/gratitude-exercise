<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Http\Resources\Product as ProductResource;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($search = request()->input('search'))
        {
            $products = Product::where('name', 'LIKE', "%$search%")->orWhere('description', 'LIKE', "%$search%")->paginate(10);
            $products->appends(['search'=>$search]);
        }else{
            $products = Product::paginate(12);
        }
        return ProductResource::collection($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("products.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        $accepted = $request->validated();

        if($product = Product::create($accepted)){
            return response()->json(['status'=>1, 'message'=>'Product created successfully', 'id'=> $product->id]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json(['product'=> new ProductResource($product)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view("products.edit", ['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreProduct  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProduct $request, Product $product)
    {
        $accepted = $request->validated();

        $product->name = $accepted['name'];
        $product->price = $accepted['price'];
        $product->description = $accepted['description'];
        if ($product->save()) {
            return response()->json(['status' => 1, 'message' => 'Product edited successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->delete()){
            return response()->json(['status' => 1, 'message' => 'Product deleted successfully']);
        }
    }
}
