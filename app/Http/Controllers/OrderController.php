<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Orders;
use App\Models\Customers;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

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

        $snapToken = session('snapToken');
        $orderId = session('orderId');

        session()->forget(['snapToken', 'orderId']);
        return view('customer.index', compact('orders','snapToken', 'orderId'));
    }

    public function orderan()
    {
        $orders = Orders::all();
        $orders->transform(function ($order) {
            $order->order_date = Carbon::parse($order->order_date);
            $order->delivery_date = $order->delivery_date ? Carbon::parse($order->delivery_date) : null;
            return $order;
        });

        $statusCounts = [
            'already_paid' => Orders::where('status', 'already paid')->count(),
            'being_picked_up' => Orders::where('status', 'being picked up')->count(),
            'delivered' => Orders::where('status', 'delivered')->count(),
            'completed' => Orders::where('status', 'completed')->count(),
        ];
        return view('employee.index', compact('orders', 'statusCounts'));
    }

    public function detailOrder($id)
    {   
        $order = Orders::with('customer', 'category')->findOrFail($id);
        if ($order->type_pay == 'online' && $order->status != 'already paid') {
            // Konfigurasi Midtrans
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');

            // Tambahkan pengidentifikasi unik ke order_id
            $uniqueOrderId = $order->order_number . '_' . uniqid();

            $params = [
                'transaction_details' => [
                    'order_id' => $uniqueOrderId,
                    'gross_amount' => $order->total_price,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->first_name,
                    'last_name' => Auth::user()->last_name,
                    'email' => Auth::user()->email,
                    'phone' => $order->phone_number,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            return view('customer.detailOrder', compact('snapToken', 'order'))->with('success', 'Order created successfully.');
        }
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
            'amount_paid' => 'nullable|integer|min:0',
            'type_pay' => 'required|in:cod,online',
            'change_money' => 'nullable|integer|min:0'
        ]);

        $order=Orders::create([
            'order_number' => Orders::generateOrderNumber(),
            'order_date' => $request->order_date,
            'delivery_date' => $request->delivery_date,
            'customer_id' => Auth::id(),
            'category_id' => $request->category_id,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'quantity_kg' => $request->quantity_kg,
            'total_price' => $this->calculateTotalPrice($request->category_id, $request->quantity_kg),
            'amount_paid' => $request->amount_paid,
            'status' => 'queued',
            'type_pay' => $request->type_pay,
            'change_money' => $request->change_money,
        ]);
        if ($request->type_pay == 'online') {
            // Konfigurasi Midtrans
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');
    
            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => $order->total_price,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->first_name,
                    'last_name' => Auth::user()->last_name,
                    'email' => Auth::user()->email,
                    'phone' => $request->phone_number,
                ],
            ];
    
            $snapToken = Snap::getSnapToken($params);
            return redirect()->route('orderCustomer')->with('success', 'Order created successfully.');
        }
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
            'delivery_date' => 'nullable|date|after_or_equal:order_date'
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

    public function printPdf()
    {
    	$order = Orders::all();
 
    	// Hitung total quantity dan total harga
        $totalQuantity = $order->sum('quantity_kg');
        $totalPrice = $order->sum('total_price');

        $pdf = PDF::loadView('admin.order.printPdf', [
            'orders' => $order,
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice
        ]);
    	return $pdf->download('report-order.pdf');
    }

    public function payCOD($orderId)
    {
        $order = Orders::findOrFail($orderId);
        return view('employee.paycod', compact('order'));
    }

    public function processPayCOD(Request $request, $orderId)
    {
        $request->validate([
            'amount_paid' => 'required|integer|min:0',
        ]);

        $order = Orders::findOrFail($orderId);
        $totalPrice = $order->total_price;
        $amountPaid = $request->amount_paid;

        // Check if the amount paid is less than the total price
        if ($amountPaid < $totalPrice) {
            return redirect()->back()->withErrors(['amount_paid' => 'Insufficient amount paid. Please enter the correct amount.']);
        }

        // Calculate change money
        $changeMoney = $amountPaid - $totalPrice;

        // Save the amount paid
        $order->amount_paid = $amountPaid;
        // Save the change money
        $order->change_money = $changeMoney;
        // Update status to 'already paid'
        $order->status = 'already paid';
        $order->save();

        return redirect()->route('employee.index')->with('success', 'Payment processed successfully.');
    }



    public function paymentSuccess($orderId)
    {
        // Logic to handle successful payment
        $order = Orders::find($orderId);
        $order->status = 'already paid';
        $order->save();

        return redirect()->route('orderCustomer')->with('success', 'Payment successful.');
    }

    public function paymentPending($orderId)
    {
        // Logic to handle pending payment
        $order = Orders::find($orderId);
        $order->status = 'pending';
        $order->save();

        return redirect()->route('orderCustomer')->with('info', 'Payment pending.');
    }

    public function paymentError($orderId)
    {
        // Logic to handle payment error
        $order = Orders::find($orderId);
        $order->status = 'failed';
        $order->save();

        return redirect()->route('orderCustomer')->with('error', 'Payment failed.');
    }
}
