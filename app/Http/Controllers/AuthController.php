<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function register()
    {
        return view('Auth.register', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
            'customer_name' => 'required|max:255',
            'phone_number' => 'required|max:15',
            'address' => 'required|max:255'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create([
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'role' => 'Customer'
        ]);

        Customers::create([
            'user_id' => $user->id,
            'customer_name' => $validatedData['customer_name'],
            'phone_number' => $validatedData['phone_number'],
            'address' => $validatedData['address'],
        ]);

        return redirect('/login')->with('success','Registrasi berhasil. Selamat datang!');
    }

    public function index()
    {
        return view('Auth.login', [
            'title' => 'Login'
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect based on user role
            switch ($user->role) {
                case 'Super-admin':
                    return redirect()->intended('admin');
                case 'Employee':
                    return redirect()->intended('employeePages');
                case 'Customer':
                    return redirect()->intended('customerPages');
                default:
                    Auth::logout();
                    return back()->with('loginError', 'Role tidak dikenali!');
            }
        }

        return back()->with('loginError', 'Login Gagal!!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/login');
    }

    public function forgot()
    {
        return view('Auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __('Kami telah mengirimkan link reset password ke email anda'))
            : back()->withErrors(['email' => __('Email tidak ditemukan atau tidak valid')]);
    }

    public function showResetPasswordForm(string $token)
    {
        return view('Auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __())
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function show($id)
    {
        $customer = Customers::with('user')->find($id);
    
        // Mengakses email dan password dari user yang terkait dengan customer
        $email = $customer->user->email;
        $password = $customer->user->password;
    
        return view('customer.show', compact('customer', 'email', 'password'));
    }

    public function customer()
    {
        $customers = Customers::with('user')->get();
        return view('admin.customer.index', [
            'customers' => $customers
        ]);
    }


    public function edit($id)
    {
        $customer = Customers::with('user')->findOrFail($id);
        return view('admin.customer.edit', [
            'customer' => $customer
        ]);
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        $customer = Customers::findOrFail($id);
        $customer->update($validateData);

        return redirect()->route('listCustomer')->with('success', 'Customer Data Updated Successfully');
    }

    public function restore(string $id)
    {
        $customer = Customers::withTrashed()->findOrFail($id);
        
        // Lakukan restore pada data customer
        $customer->restore();

        return redirect()->route('listCustomer')->with('success', 'Customer Data Restored Successfully');
    }

    public function destroy($id)
    {
        $customer = Customers::findOrFail($id);
        $user = $customer->user; // Ambil data user yang terkait dengan customer

        // Hapus data customer terlebih dahulu
        $customer->delete();

        // Hapus data user yang terkait
        if ($user) {
            $user->delete();
        }

        return redirect()->route('listCustomer')->with('success', 'Customer Data Deleted Successfully');
    }

    public function trash()
    {
        $trashedCustomers = Customers::onlyTrashed()->get();
        return view('admin.customer.trash', [
            'trashedCustomers' => $trashedCustomers
        ]);
    }

    public function forceDelete(string $id)
    {
        $customer = Customers::withTrashed()->findOrFail($id);
        $user = $customer->user;

        // Hapus data pelanggan secara permanen
        $customer->forceDelete();

        // Hapus pengguna terkait secara permanen jika ada
        if ($user) {
            $user->forceDelete();
        }

        return redirect(route('trashCustomer'))->with('success', 'Customer Data Permanently Deleted Successfully');
    }
}
