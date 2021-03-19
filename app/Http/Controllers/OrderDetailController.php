<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderDetailController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orderDetail = OrderDetail::with('order', 'product')->get();
        return response(['orderDetail' => $orderDetail]);
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
        //
        $validatedData = $request->validate([
            'order_id' => 'required',
            'product_id' => 'required'
        ]);
        $order=Order::find($validatedData['order_id']);
        if (!$order){
            return response([ 'message' => 'Order ' .$validatedData['order_id']. ' Does Not Exist']);
        }
        $product=Product::find($validatedData['product_id']);
        if (!$product){
            return response([ 'message' => 'Product ' .$validatedData['product_id']. ' Does Not Exist']);
        }
        if ($request->has('id')){
            $orderDetail=OrderDetail::find($request->id);
            if ($orderDetail){
                $orderDetail->update($validatedData);
                return response([ 'orderDetail' => $orderDetail]);
            }
            else{
                return response([ 'message' => 'OrderDetail Does Not Exist']);
            }
        }
        else{
            $orderDetail = OrderDetail::create($validatedData);
        }
        return response([ 'orderDetail' => $orderDetail]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $orderDetail = OrderDetail::with('order', 'product')->find($id);
        if ($orderDetail){
            return response([ 'orderDetail' => $orderDetail]);
        }
        else{
            return response([ 'message' => 'OrderDetail Does Not Exist']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $orderDetail = OrderDetail::find($id);
        if ($orderDetail){
            $orderDetail->delete();
            return response([ 'message' => 'OrderDetail Deleted']);
        }
        else{
            return response([ 'message' => 'OrderDetail Does Not Exist']);
        }
    }
}
