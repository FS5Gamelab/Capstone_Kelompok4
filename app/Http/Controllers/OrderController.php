<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orderCustomer()
    {
        return view('customer.order');
    }

    public function orderan()
    {
        return view('employee.order');
    }

    public function create()
    {
    $data_orders = Categories::all(); // Asumsikan ini mengambil data dari tabel categories
    return view('orders.create', compact('data_orders'));
    }


    // Metode untuk pelanggan membuat pesanan
    public function createOrder(Request $request)
    {
        $order = new Orders();
        $order->order_number = uniqid();
        $order->order_date = now();
        $order->delivery_date = $request->delivery_date;
        $order->customer_id = Auth::id();
        $order->category_id = $request->category_id;
        $order->quantity_kg = $request->quantity_kg;
        $order->total_price = $request->total_price;
        $order->status = 'queued';
        $order->save();

        return response()->json(['message' => 'Order created successfully']);
    }

    // Metode untuk pelanggan melihat pesanan mereka sendiri
    public function viewOrders()
    {
        $orders = Orders::where('customer_id', Auth::id())->get();
        return response()->json($orders);
    }

    // Metode untuk karyawan mengubah status pesanan
    public function updateOrderStatus(Request $request, $id)
    {
        $order = Orders::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Order status updated successfully']);
    }

    // Metode untuk admin mengedit pesanan
    public function editOrder(Request $request, $id)
    {
        $order = Orders::findOrFail($id);
        $order->delivery_date = $request->delivery_date;
        $order->category_id = $request->category_id;
        $order->quantity_kg = $request->quantity_kg;
        $order->total_price = $request->total_price;
        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Order updated successfully']);
    }

    // Metode untuk admin menghapus pesanan (soft delete)
    public function deleteOrder($id)
    {
        $order = Orders::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully']);
    }
}
