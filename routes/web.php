<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EmployeeMiddleware;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::match(['get', 'post'] , '/login', [Authentication::class, 'login']);
Route::match(['get', 'post'] , '/logout', [Authentication::class, 'logout']);

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::match(['get','post'],'/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::match(['get','post'],'/employee-list', [AdminController::class, 'employeeList'])->name('admin.employee_list');
    Route::match(['get','post'],'/add-employee', [AdminController::class, 'addEmployee'])->name('admin.addemployee');
});

Route::middleware(['auth', EmployeeMiddleware::class])->group(function () {
    Route::match(['get','post'],'/employee/dashboard', [EmployeeController::class, 'dashboard'])->name('customer.dashboard');
});
