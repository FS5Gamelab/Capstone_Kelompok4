<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function pricing()
    {
        return view('landingpages.pricing');
    }

    public function pricingCustomer()
    {
        return view('customer.pricing');
    }

    public function pricingEmployee()
    {
        return view('employee.pricing');
    }
}
