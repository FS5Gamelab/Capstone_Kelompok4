<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Orders;
use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    
    public function index()
    {
        $orders = Orders::all();
        $orders->transform(function ($order) {
            $order->order_date = Carbon::parse($order->order_date);
            $order->delivery_date = $order->delivery_date ? Carbon::parse($order->delivery_date) : null;
            return $order;
        });
        return view('admin.order.index', compact('orders'));
    }

    public function orderCustomer()
    {
        $orders = Orders::where('customer_id', Auth::id())->get();
        $orders->transform(function ($order) {
            $order->order_date = Carbon::parse($order->order_date);
            $order->delivery_date = $order->delivery_date ? Carbon::parse($order->delivery_date) : null;
            return $order;
        });
        return view('customer.index', compact('orders'));
    }

    public function orderan()
    {
        $orders = Orders::all();
        $orders->transform(function ($order) {
            $order->order_date = Carbon::parse($order->order_date);
            $order->delivery_date = $order->delivery_date ? Carbon::parse($order->delivery_date) : null;
            return $order;
        });
        return view('employee.index', compact('orders'));
    }

    public function detailOrder($id)
    {
        $order = Orders::with('customer', 'category')->findOrFail($id);
        return view('customer.detailOrder', compact('order'));
    }


    public function createOrder()

    {
        $categories = Categories::all();
        return view('customer.create', compact('categories'));
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'quantity_kg' => 'required|integer|min:1',
            'order_date' => 'required|date',
            'delivery_date' => 'nullable|date|after_or_equal:order_date',
        ]);

        Orders::create([
            'order_number' => Orders::generateOrderNumber(),
            'order_date' => $request->order_date,
            'delivery_date' => $request->delivery_date,
            'customer_id' => Auth::id(),
            'category_id' => $request->category_id,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'quantity_kg' => $request->quantity_kg,
            'total_price' => $this->calculateTotalPrice($request->category_id, $request->quantity_kg),
            'status' => 'queued',
        ]);

        return redirect()->route('orderCustomer')->with('success', 'Order created successfully.');
    }

    private function calculateTotalPrice($categoryId, $quantity)
    {
        $category = Categories::find($categoryId);
        return $category->price * $quantity;
    }

    public function editOrder($id)
    {
        $order = Orders::findOrFail($id);
        return view('employee.edit', compact('order'));
    }

    public function updateOrder(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'delivery_date' => 'nullable|date|after_or_equal:order_date',
        ]);

        $order = Orders::findOrFail($id);
        $order->status = $request->status;
        $order->delivery_date = $request->delivery_date;
        $order->save();

        return redirect()->route('employee.index')->with('success', 'Order updated successfully.');
    }
    
    public function softDelete($id)
    {
    $order = Orders::findOrFail($id);
    $order->delete();

    // Redirect atau respons sesuai kebutuhan Anda
    return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function trash()
    {
        $orders = Orders::onlyTrashed()->get();
        return view('admin.order.trash', compact('orders'));
    }

    public function restore($id)
    {
        $order = Orders::withTrashed()->find($id);
        if ($order) {
            $order->restore();
        }
        return redirect()->route('trashOrders')->with('success', 'Order restored successfully.');
    }

    public function destroy($id)
    {
        $order = Orders::find($id);
        if ($order) {
            $order->delete();
        }
        return redirect()->route('listOrders')->with('success', 'Order deleted successfully.');
    }

    public function forceDelete($id)
    {
        $order = Orders::withTrashed()->find($id);
        if ($order) {
            $order->forceDelete();
        }
        return redirect()->route('trashOrders')->with('success', 'Order permanently deleted.');
    }
}
