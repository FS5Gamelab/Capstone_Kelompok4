<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers= Customers::all();
        return view('customer.index', [
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = validator($request->all(), [
            'customer_name' => 'required|string',
            'phone_number' => 'required|string',
            'address' => 'required|string',
        ])->validate();

        $customer = new Customers($validateData);
        $customer->save();

        return redirect(route('listCustomer'))->with('success', 'Data Pelanggan Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customers $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customers::findOrFail($id);
        return view('customer.edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateData = validator($request->all(), [
            'customer_name' => 'required|string',
            'phone_number' => 'required|string',
            'address' => 'required|string',
        ])->validate();

        $customer = Customers::findOrFail($id);

        $customer->update([
            'customer_name' => $request->customer_name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);

        return redirect(route('listCustomer'))->with('success', 'Data Pelanggan Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customers::findOrFail($id);
        $customer->delete();
        return redirect(route('listCustomer'))->with('success', 'Data Pelanggan Berhasil Dihapus');
    }
}