<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeess = Employees::all();
        return view('admin.employees.index', [
            'employeess' => $employeess
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'employees_name' => 'required|string',
            'phone_number' => 'required|string',
            'address' => 'required|string'
        ]);

        $employees = new Employees($validateData);
        $employees->save();

        //redirect to index
        return redirect(route('listEmployees'))->with('success', 'New Employee Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employees $employees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employees = Employees::findOrFail($id);
        return view('admin.employees.edit', [
            'employees' => $employees
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'employees_name' => 'required|string',
            'phone_number' => 'required|string',
            'address' => 'required|string',
        ]);

        $employees = Employees::findOrFail($id);
        $employees->update($validateData);

        return redirect(route('listEmployees'))->with('success', 'Employee Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employees = Employees::findOrFail($id);
        $employees->delete();
        return redirect(route('listEmployees'))->with('success', 'Employee Data Deleted Successfully');
    }
}