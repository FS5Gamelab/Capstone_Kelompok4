<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    public function index()
    {
        $orders = Orders::all();
        return view('admin.order.index', compact('orders'));
    }

    public function orderCustomer()
    {
        return view('customer.index');
    }

    public function orderan()
    {
        return view('employee.index');
    }


    public function createOrder()

    {
        return view('customer.create');
    }
}
