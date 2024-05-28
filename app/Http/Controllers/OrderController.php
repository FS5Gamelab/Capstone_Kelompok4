<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
