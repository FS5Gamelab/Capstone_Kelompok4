<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/employee', function () {
    return view('employee/index');
});

Route::get('/admin', function () {
    return view('admin/index');
});

Route::get('/login', [AuthController::class, 'index']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/category', [App\Http\Controllers\CategoriesController::class, 'index'])->name('listCategory');

Route::post('/category', [App\Http\Controllers\CategoriesController::class, 'store'])->name('storeCategory');

Route::get('/category/create', [App\Http\Controllers\CategoriesController::class, 'create'])->name('createCategory');

Route::post('/category/create', [App\Http\Controllers\CategoriesController::class, 'store'])->name('storeCategory');

Route::get('/category/{id}/edit', [App\Http\Controllers\CategoriesController::class, 'edit'])->name('editCategory');

Route::post('/category/{id}/edit', [App\Http\Controllers\CategoriesController::class, 'update'])->name('updateCategory');

Route::put('/category/{id}', [App\Http\Controllers\CategoriesController::class, 'update'])->name('updateCategory');

Route::get('/category/{id}/delete', [App\Http\Controllers\CategoriesController::class, 'destroy'])->name('deleteCategory');

Route::get('/employees', [App\Http\Controllers\EmployeesController::class, 'index'])->name('listEmployees');

Route::post('/employees', [App\Http\Controllers\EmployeesController::class, 'store'])->name('storeEmployees');

Route::get('/employees/create', [App\Http\Controllers\EmployeesController::class, 'create'])->name('createEmployees');

Route::post('/employees/create', [App\Http\Controllers\EmployeesController::class, 'store'])->name('storeEmployees');

Route::get('/employees/{id}/edit', [App\Http\Controllers\EmployeesController::class, 'edit'])->name('editEmployees');

Route::post('/employees/{id}/edit', [App\Http\Controllers\EmployeesController::class, 'update'])->name('updateEmployees');

Route::put('/employees/{id}', [App\Http\Controllers\EmployeesController::class, 'update'])->name('updateEmployees');

Route::get('/employees/{id}/delete', [App\Http\Controllers\EmployeesController::class, 'destroy'])->name('deleteEmployees');