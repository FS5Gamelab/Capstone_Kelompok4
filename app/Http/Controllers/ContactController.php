<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        return view('landingpages.contact');
    }

    public function contactCustomer()
    {
        return view('customer.contact');
    }

    public function contactEmployee()
    {
        return view('employee.contact');
    }
}
