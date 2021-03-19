<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\SupplierProduct;
use Illuminate\Http\Request;

class SupplierProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $supplierProduct = SupplierProduct::with('supplier', 'product')->get();
        
        return response(['supplierProduct' => $supplierProduct]);
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
            'supplier_id' => 'required',
            'product_id' => 'required'
        ]);
        $supplier=Supplier::find($validatedData['supplier_id']);
        if (!$supplier){
            return response([ 'message' => 'Supplier ' .$validatedData['supplier_id']. ' Does Not Exist']);
        }
        $product=Product::find($validatedData['product_id']);
        if (!$product){
            return response([ 'message' => 'Product ' .$validatedData['product_id']. ' Does Not Exist']);
        }
        if ($request->has('id')){
            $supplierProduct=SupplierProduct::find($request->id);
            if ($supplierProduct){
                $supplierProduct->update($validatedData);
                return response([ 'supplierProduct' => $supplierProduct]);
            }
            else{
                return response([ 'message' => 'SupplierProduct Does Not Exist']);
            }
        }
        else{
            $supplierProduct = SupplierProduct::create($validatedData);
        }
        return response([ 'supplierProduct' => $supplierProduct]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierProduct  $supplierProduct
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $supplierProduct = SupplierProduct::with('supplier', 'product')->find($id);
        if ($supplierProduct){
            return response([ 'supplierProduct' => $supplierProduct]);
        }
        else{
            return response([ 'message' => 'SupplierProduct Does Not Exist']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierProduct  $supplierProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierProduct $supplierProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplierProduct  $supplierProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplierProduct $supplierProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierProduct  $supplierProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $supplierProduct = SupplierProduct::find($id);
        if ($supplierProduct){
            $supplierProduct->delete();

            return response([ 'message' => 'SupplierProduct Deleted']);
        }
        else{
            return response([ 'message' => 'SupplierProduct Does Not Exist']);
        }
    }
}
