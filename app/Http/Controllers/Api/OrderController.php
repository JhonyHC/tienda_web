<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Http\Requests\Api\StoreOrderRequest;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\HttpException;

//use App\Services\ProductQuery;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* $filter = new OrderQuery();
        $queryItems = $filter->transform($request); //[['column','operator','value']]

        if(count($queryItems) == 0){
            return new OrderCollection(Order::all());
        }else{
            return new OrderCollection(Order::where($queryItems)->get());
        } */
        
        return new OrderCollection(Order::all());
                
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
            $newOrder = new Order($request->except(['products_array','user_id']));
            $user = User::find($request->user_id);
            $user->orders()->save($newOrder);
            $newOrder->refresh();
            $productsString = $request->products_array;
            /* $productsID = json_decode($productsString,true); */
            $newOrder->products()->attach($productsString);
            //$user->orders()->save($post)
            return new OrderResource($newOrder);
        /* return view('Orders',compact('createdOrder')); */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $Order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $Order)
    {
            /* return new OrderResource($Order); */
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $Order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $product)
    {
        /* $request->validate([
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

        return Redirect::route('products.index'); */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $product)
    {
        /* $product->delete();
        return Redirect::route('products.index'); */
    }
}
