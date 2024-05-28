<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function pages()
    {
        return view('landingpages.landingpages');
    }

    public function customerPages()
    {
        return view('customer.customer');
    }

    public function employeePages()
    {
        return view('employee.employee');
    }
}
