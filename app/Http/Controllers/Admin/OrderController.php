<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('products')->whereNot(function ($query){
            $query->where('status', 6);
        })->orderBy('created_at','desc')->get();
        $deletedOrders = Order::onlyTrashed()->with('products')->orderBy('deleted_at')->get();
        $archivedOrders = Order::with('products')->where('status',6)->orderBy('created_at','desc')->get();
        
        return view('admin.orders.index', compact('orders','deletedOrders','archivedOrders'));
        
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
        return view('admin.orders.edit',compact('order'));
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
        $request->validate([
            'type' => ['required','max:255', Rule::in(['tienda','envio'])],
            'shipping_address' => [Rule::requiredIf($request->type == 'envio'),'max:255'],
            'status' => Rule::in(['0','1','2','3','4','5']),
            'date' => ['nullable','date'],
        ]);

        $order->type = $request->type;
        $order->shipping_address = $request->shipping_address;
        $order->status = $request->status;
        $order->date = $request->date;
        $order->save();
        $order->refresh();

        return back()->with('message', 'Orden Actualizada Correctamente');
    }

    public function recuperarOrden(Order $order)
    {
        if($order->trashed()){
            $order->status = 0;
            $order->save();
            $order->restore();
        }
        return back()->with('message', 'Orden Recuperada');
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
            $order->status = 5;
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
