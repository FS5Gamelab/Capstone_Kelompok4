<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {
        return view('landingpages.about');
    }

    public function aboutCustomer()
    {
        return view('customer.about');
    }

    public function aboutemployee()
    {
        return view('employee.about');
    }
}
