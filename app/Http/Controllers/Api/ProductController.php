<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;

//use App\Services\ProductQuery;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* $filter = new ProductQuery();
        $queryItems = $filter->transform($request); //[['column','operator','value']]

        if(count($queryItems) == 0){
            return new ProductCollection(Product::all());
        }else{
            return new ProductCollection(Product::where($queryItems)->get());
        } */
        
        return new ProductCollection(Product::latest()->filter(request(['id']))->get());

        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $request->validate([
            'name' => 'required|max:30|min:3',
            'price' => 'required|numeric|min:1',
            'category' => 'required|max:20|min:3',
            'description' => 'max:255|min:4',
            'stock' => 'required|integer|min:0',
        ]);

        $createdProduct = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'description' => $request->description,
            'stock' => $request->stock,
        ]);

        return new OrderResource(Order::create($request->all())); */
        /* return view('products',compact('createdProduct')); */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
            return new ProductResource($product);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:30|min:3',
            'price' => 'required|numeric|min:1',
            'category' => 'required|max:20|min:3',
            'description' => 'max:255|min:4',
            'stock' => 'required|integer|min:0',
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->save();

        return Redirect::route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return Redirect::route('products.index');
    }
}
