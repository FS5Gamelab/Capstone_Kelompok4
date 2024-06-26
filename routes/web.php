<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingpages/landingpages');
});


// Landing Pages
Route::get('/', [App\Http\Controllers\PagesController::class, 'pages'])->name('pages');
Route::get('/about', [App\Http\Controllers\AboutController::class, 'about'])->name('about');
Route::get('/services', [App\Http\Controllers\ServicesController::class, 'services'])->name('services');
Route::get('/pricing', [App\Http\Controllers\PricingController::class, 'pricing'])->name('pricing');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'contact'])->name('contact');

Route::middleware(['auth', 'role:Customer'])->group(function () {
    // Customer Pages
    Route::get('/customerPages', [App\Http\Controllers\PagesController::class, 'customerPages'])->name('customerPages')->middleware('auth');
    Route::get('/orderCustomer', [App\Http\Controllers\OrderController::class, 'orderCustomer'])->name('orderCustomer')->middleware('auth');
    Route::get('/aboutCustomer', [App\Http\Controllers\AboutController::class, 'aboutCustomer'])->name('aboutCustomer')->middleware('auth');
    Route::get('/serviceCustomer', [App\Http\Controllers\ServicesController::class, 'serviceCustomer'])->name('serviceCustomer')->middleware('auth');
    Route::get('/pricingCustomer', [App\Http\Controllers\PricingController::class, 'pricingCustomer'])->name('pricingCustomer')->middleware('auth');
    Route::get('/contactCustomer', [App\Http\Controllers\ContactController::class, 'contactCustomer'])->name('contactCustomer')->middleware('auth');

    //order customer
    Route::get('/orderCustomer/create', [App\Http\Controllers\OrderController::class, 'createOrder'])->name('createOrder')->middleware('auth');
    Route::post('/orderCustomer', [App\Http\Controllers\OrderController::class, 'storeOrder'])->name('storeOrder')->middleware('auth');
    Route::get('/detailOrder', [App\Http\Controllers\OrderController::class, 'detailOrder'])->name('detailOrder')->middleware('auth');
    Route::get('/orderCustomer/detail/{id}', [OrderController::class, 'detailOrder'])->name('detailOrder');

    //midtrans
    Route::get('/payment/success/{order}', [OrderController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/pending/{order}', [OrderController::class, 'paymentPending'])->name('payment.pending');
    Route::get('/payment/error/{order}', [OrderController::class, 'paymentError'])->name('payment.error');

});

Route::middleware(['auth', 'role:Employee'])->group(function () {
    // Employee Pages
    Route::get('/employeePages', [App\Http\Controllers\PagesController::class, 'employeePages'])->name('employeePages')->middleware('auth');
    Route::get('/orderan', [App\Http\Controllers\OrderController::class, 'orderan'])->name('orderan')->middleware('auth');
    Route::get('/aboutEmployee', [App\Http\Controllers\AboutController::class, 'aboutEmployee'])->name('aboutEmployee')->middleware('auth');
    Route::get('/serviceEmployee', [App\Http\Controllers\ServicesController::class, 'serviceEmployee'])->name('serviceEmployee')->middleware('auth');
    Route::get('/pricingEmployee', [App\Http\Controllers\PricingController::class, 'pricingEmployee'])->name('pricingEmployee')->middleware('auth');
    Route::get('/contactEmployee', [App\Http\Controllers\ContactController::class, 'contactEmployee'])->name('contactEmployee')->middleware('auth');

    // Rute Employee pada halaman daftar Order
    Route::get('/employee/order/edit/{id}', [OrderController::class, 'editOrder'])->name('editOrder');
    Route::post('/employee/order/update/{id}', [OrderController::class, 'updateOrder'])->name('updateOrder');
    Route::get('/employee/orders', [OrderController::class, 'orderan'])->name('employee.index');

    // Pay COD
    Route::get('/paycod/{orderId}', [OrderController::class, 'payCOD'])->name('payCOD')->middleware('auth');
    Route::post('/paycod/{orderId}', [OrderController::class, 'processPayCOD'])->name('processPayCOD')->middleware('auth');

});

Route::middleware(['auth', 'role:Super-admin'])->group(function () {
    //halaman admin
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin')->middleware('auth');

    // Crud Category
    Route::get('/category', [App\Http\Controllers\CategoriesController::class, 'index'])->name('listCategory');
    Route::post('/category', [App\Http\Controllers\CategoriesController::class, 'store'])->name('storeCategory');
    Route::get('/category/create', [App\Http\Controllers\CategoriesController::class, 'create'])->name('createCategory');
    Route::post('/category/create', [App\Http\Controllers\CategoriesController::class, 'store'])->name('storeCategory');
    Route::get('/category/{id}/edit', [App\Http\Controllers\CategoriesController::class, 'edit'])->name('editCategory');
    Route::post('/category/{id}/edit', [App\Http\Controllers\CategoriesController::class, 'update'])->name('updateCategory');
    Route::put('/category/{id}', [App\Http\Controllers\CategoriesController::class, 'update'])->name('updateCategory');
    Route::get('/category/{id}/delete', [App\Http\Controllers\CategoriesController::class, 'destroy'])->name('deleteCategory');

    // Soft Delete Category
    Route::patch('/category/{id}/restore', [CategoriesController::class, 'restore'])->name('restoreCategory');
    Route::delete('/category/{id}/delete', [CategoriesController::class, 'destroy'])->name('deleteCategory');
    Route::get('/category/trash', [CategoriesController::class, 'trash'])->name('trashCategory');
    Route::delete('/category/{id}/forceDelete', [CategoriesController::class, 'forceDelete'])->name('forceDeleteCategory');

    // CRUD Employee
    Route::get('/employees', [App\Http\Controllers\EmployeesController::class, 'index'])->name('listEmployees');
    Route::post('/employees', [App\Http\Controllers\EmployeesController::class, 'store'])->name('storeEmployees');
    Route::get('/employees/create', [App\Http\Controllers\EmployeesController::class, 'create'])->name('createEmployees');
    Route::post('/employees/create', [App\Http\Controllers\EmployeesController::class, 'store'])->name('storeEmployees');
    Route::get('/employees/{id}/edit', [App\Http\Controllers\EmployeesController::class, 'edit'])->name('editEmployees');
    Route::post('/employees/{id}/edit', [App\Http\Controllers\EmployeesController::class, 'update'])->name('updateEmployees');
    Route::put('/employees/{id}', [App\Http\Controllers\EmployeesController::class, 'update'])->name('updateEmployees');
    Route::get('/employees/{id}/delete', [App\Http\Controllers\EmployeesController::class, 'destroy'])->name('deleteEmployees');

    // Soft Delete Employee
    Route::get('employees', [EmployeesController::class, 'index'])->name('listEmployees');
    Route::get('employees/trash', [EmployeesController::class, 'trash'])->name('trashEmployees');
    Route::patch('employees/restore/{id}', [EmployeesController::class, 'restore'])->name('restoreEmployees');
    Route::delete('employees/delete/{id}', [EmployeesController::class, 'destroy'])->name('deleteEmployees');
    Route::delete('employees/force-delete/{id}', [EmployeesController::class, 'forceDelete'])->name('forceDeleteEmployees');

    // CRUD Customer
    Route::get('/customer', [App\Http\Controllers\AuthController::class, 'customer'])->name('listCustomer');
    Route::post('/customer', [App\Http\Controllers\AuthController::class, 'store'])->name('storeCustomer');
    Route::get('/customer/{id}/edit', [App\Http\Controllers\AuthController::class, 'edit'])->name('editCustomer');
    Route::post('/customer/{id}/edit', [App\Http\Controllers\AuthController::class, 'update'])->name('updateCustomer');
    Route::put('/customer/{id}', [App\Http\Controllers\AuthController::class, 'update'])->name('updateCustomer');
    Route::get('/customer/{id}/delete', [App\Http\Controllers\AuthController::class, 'destroy'])->name('deleteCustomer');

    // Soft Delete Customer
    Route::patch('/customers/{id}/restore', [AuthController::class, 'restore'])->name('restoreCustomer');
    Route::delete('/customers/{id}/delete', [AuthController::class, 'destroy'])->name('deleteCustomer');
    Route::get('/customers/trash', [AuthController::class, 'trash'])->name('trashCustomer');
    Route::delete('/customer/{id}/forceDelete', [AuthController::class, 'forceDelete'])->name('forceDeleteCustomer');

    // Soft Delete Employee
    Route::get('employees', [EmployeesController::class, 'index'])->name('listEmployees');
    Route::get('employees/trash', [EmployeesController::class, 'trash'])->name('trashEmployees');
    Route::patch('employees/restore/{id}', [EmployeesController::class, 'restore'])->name('restoreEmployees');
    Route::delete('employees/delete/{id}', [EmployeesController::class, 'destroy'])->name('deleteEmployees');
    Route::delete('employees/force-delete/{id}', [EmployeesController::class, 'forceDelete'])->name('forceDeleteEmployees');

    // CRUD + Soft Delete Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('listOrders')->middleware('auth');
    Route::delete('/admin/orders/{id}', [OrderController::class, 'softDelete'])->name('orders.softdelete');
    Route::get('orders/trash', [OrderController::class, 'trash'])->name('trashOrders');
    Route::patch('orders/restore/{id}', [OrderController::class, 'restore'])->name('restoreOrders');
    Route::delete('orders/delete/{id}', [OrderController::class, 'destroy'])->name('deleteOrders');
    Route::delete('orders/force-delete/{id}', [OrderController::class, 'forceDelete'])->name('forceDeleteOrders');

    //pdf
    Route::get('/printPdf', [OrderController::class, 'printPdf'])->name('printPdf');
});

//Login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'store']);

//forgot password and reset password
Route::get('forgot-password', [AuthController::class, 'forgot'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->middleware('guest')->name('password.reset');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.update');


//Feedback
Route::post('/order/{id}/feedback', [FeedbackController::class, 'submitFeedback'])->name('submitFeedback')->middleware('auth');
Route::get('/pagesFeedback', [FeedbackController::class, 'pagesFeedback'])->name('pagesFeedback');
Route::get('/employeeFeedback', [FeedbackController::class, 'employeeFeedback'])->name('employeeFeedback');
Route::get('/customerFeedback', [FeedbackController::class, 'customerFeedback'])->name('customerFeedback');


