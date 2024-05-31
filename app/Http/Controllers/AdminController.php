<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Customers;
use App\Models\Employees;

class AdminController extends Controller
{
    public function admin()
    {
        $categories = Categories::count();
        $customer = Customers::count();
        $employees = Employees::count();

        $data = array(
            'categories' => $categories,
            'customer' => $customer,
            'employees' => $employees,
        );

        return view('admin.index', $data);
    }
}
