<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formularioValidado = $request->validate([
            'name' => 'required|max:50|min:3|unique:products',
            'price' => 'required|numeric|min:1|max:9999',
            'category' => 'required|max:20|min:3',
            'description' => 'max:255|min:4',
            'stock' => 'required|integer|min:0|max:9999',
        ]);

        if($request->hasFile('image')){
            $formularioValidado['image'] = $request->file('image')->store('images', 'public');
        }

        /* $createdProduct = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'description' => $request->description,
            'stock' => $request->stock,
        ]); */
        Product::create($formularioValidado);

        return Redirect::route('admin.products.index')->with('message','Producto Creado Correctamente');
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
        return view('admin.products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit',compact('product'));
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
        $formularioValidado = $request->validate([
            'name' => 'required|max:50|min:3',
            'price' => 'required|numeric|min:1|max:9999',
            'category' => 'required|max:20|min:3',
            'description' => 'max:255|min:4',
            'stock' => 'required|integer|min:0|max:9999',
        ]);
        if($request->hasFile('image')){
            $formularioValidado['image'] = $request->file('image')->store('images', 'public');
            if($product->image != NULL){
                Storage::delete('/public/'.$product->image);
            }
        }

        $product->update($formularioValidado);
        /* $product->name = $request->name;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->save(); */

        return back()->with('message', 'Producto Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->image != NULL){
            Storage::delete($product->image);
        }
        $product->delete();
        return Redirect::route('admin.products.index')->with('message', 'Producto Eliminado Correctamente');;
    }
}
