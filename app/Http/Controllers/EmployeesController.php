<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            'profile_picture' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'employees_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'role' => 'required|string',
            'gender' => 'required|string',
            'phone_number' => 'required|string',
            'address' => 'required|string'
        ]);

        $profile_picture = $request->file('profile_picture');
        $profile_picture->storeAs('public/artikels', $profile_picture->hashName());

        $user = User::create([
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
            'role' => $validateData['role']
        ]);

        Employees::create([
            'profile_picture' => $profile_picture->hashName(),
            'employees_name' => $request->employees_name,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'user_id' => $user->id
        ]);

        // $employees = new Employees($validateData);
        // $employees->save();

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
    $employees = Employees::with('user')->findOrFail($id);
    $validateData = $request->validate([
        'profile_picture' => 'image|mimes:jpeg,jpg,png|max:2048', // Gambar tidak lagi required
        'employees_name' => 'required|string',
        'email' => 'required|email|unique:users,email,'.$employees->user_id,
        'gender' => 'required|string',
        'phone_number' => 'required|string',
        'address' => 'required|string',
        'role' => 'required|string|in:Employee,Super-admin'
    ]);

    $employees = Employees::findOrFail($id);

    //cek apabila gambar akan di upload
    if ($request->hasFile('profile_picture')) {
        // Upload gambar baru
        $profile_picture = $request->file('profile_picture');
        $profile_picture->storeAs('public/artikels', $profile_picture->hashName());

        // Hapus gambar lama jika ada
        if ($employees->profile_picture) {
            Storage::delete('public/artikels/' . $employees->profile_picture);
        }

        // Update artikel dengan gambar baru
        $employees->profile_picture = $profile_picture->hashName();
    }

    // Update data lainnya
    $employees->update([
        'employees_name' => $request->employees_name,
        'gender' => $request->gender,
        'phone_number' => $request->phone_number,
        'address' => $request->address,
        'profile_picture' => $employees->profile_picture // Pastikan gambar diupdate jika ada
    ]);

    // Update user data
    $user = $employees->user;
    $user->email = $request->email;
    $user->role = $request->role;
    $user->save();

    return redirect(route('listEmployees'))->with('success', 'Employee Data Updated Successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employees = Employees::findOrFail($id);
        Storage::delete('public/artikels/' . $employees->profile_picture);
        $employees->delete();
        return redirect(route('listEmployees'))->with('success', 'Employee Data Deleted Successfully');
    }
}