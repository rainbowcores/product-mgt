<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $suppliers = Supplier::all();
        return response(['suppliers' => $suppliers]);
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
            'name' => 'required'
        ]);
        if ($request->has('id')){
            $supplier=Supplier::find($request->id);
            if ($supplier){
                $supplier->update($validatedData);
                return response([ 'supplier' => $supplier]);
            }
            else{
                return response([ 'message' => 'Supplier Does Not Exist']);
            }
        }
        else{
            $supplier = Supplier::create($validatedData);
        }
        return response([ 'supplier' => $supplier]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $supplier = Supplier::find($id);
        if ($supplier){
            return response([ 'supplier' => $supplier]);
        }
        else{
            return response([ 'message' => 'Supplier Does Not Exist']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $supplier = Supplier::find($id);
        if ($supplier){
            $supplier->delete();

            return response([ 'message' => 'Supplier Deleted']);
        }
        else{
            return response([ 'message' => 'Supplier Does Not Exist']);
        }
    }
}
