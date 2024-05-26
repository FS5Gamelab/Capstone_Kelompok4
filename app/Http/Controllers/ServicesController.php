<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function services()
    {
        return view('landingpages.services');
    }

    public function serviceCustomer()
    {
        return view('customer.services');
    }
}
