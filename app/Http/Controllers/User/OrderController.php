<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('products')->where('user_id', Auth::id())->whereNot(function ($query){
            $query->where('status', 6);
        })->orderBy('created_at','desc')->get();
        $deletedOrders = Order::onlyTrashed()->with('products')->where('user_id', Auth::id())->orderBy('deleted_at')->get();
        $archivedOrders = Order::with('products')->where('status',6)->where('user_id', Auth::id())->orderBy('created_at','desc')->get();
        
        return view('user.orders.index', compact('orders','deletedOrders','archivedOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $newOrder = new Order($request->except(['products_array','user_id']));
            $user = User::find($request->user_id);
            $user->orders()->save($newOrder);
            $newOrder->refresh();
            $productsString = $request->products_array;
            $productsID = json_decode($productsString,true);
            $newOrder->products()->attach($productsID);
            ddd($productsID);
            //$user->orders()->save($post)
            return new OrderResource($newOrder); */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        if($order->trashed()){
            $order->status = 0;
            $order->save();
            $order->restore();
        }
        return back()->with('message', 'Orden Recuperada');
    }

    public function recuperarOrden(Order $order)
    {
        if($order->trashed()){
            if($order->status == 5){
                return back()->with('message', 'No puedes recuperar una order cancelada por un administrador');
            }else{
                $order->status = 0;
                $order->save();
                $order->restore();
            }
        }
        return back()->with('message', 'Orden Recuperada');
    }
    public function archivarOrden(Order $order)
    {
        if($order->trashed()){
            $order->status = 6;
            $order->save();
            $order->restore();
        }else{
            $order->status = 6;
            $order->save();
        }
        return back()->with('message', 'Orden Archivada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if($order->trashed()){
            $order->forceDelete();
            return back()->with('message', 'Orden Eliminada Permanentemente');
        }else{
            $order->status = 4;
            $order->save();
            $order->delete();
            return back()->with('message', 'Orden Cancelada');
        }
    }
    public function eliminarPermanente(Order $order)
    {
        if($order->trashed()){
            $order->forceDelete();
            return back()->with('message', 'Orden Eliminada Permanentemente');
        }else{
            if($order->status == 6){
                $order->forceDelete();
                return back()->with('message', 'Orden Eliminada Permanentemente');
            }else{
                $order->status = 4;
                $order->save();
                $order->delete();
                return back()->with('message', 'Orden Cancelada');
            }
        }
    }
}
