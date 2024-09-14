<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\RegisterController;

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


use App\Http\Controllers\ServiceController;

Route::get('services', [ServiceController::class, 'index'])->name('services.index');
Route::get('services/create', [ServiceController::class, 'create'])->name('services.create');
Route::post('services', [ServiceController::class, 'store'])->name('services.store');
Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
Route::put('services/{service}', [ServiceController::class, 'update'])->name('services.update');
Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');



use App\Http\Controllers\StoreController;

Route::get('stores', [StoreController::class, 'index'])->name('stores.index');
Route::get('stores/create', [StoreController::class, 'create'])->name('stores.create');
Route::post('stores', [StoreController::class, 'store'])->name('stores.store');
Route::get('stores/{store}', [StoreController::class, 'show'])->name('stores.show');
Route::get('stores/{store}/edit', [StoreController::class, 'edit'])->name('stores.edit');
Route::put('stores/{store}', [StoreController::class, 'update'])->name('stores.update');
Route::delete('stores/{store}', [StoreController::class, 'destroy'])->name('stores.destroy');



use App\Http\Controllers\EmployeeController;

Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');


use App\Http\Controllers\ClientController;

Route::get('clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::put('clients/{id}', [ClientController::class, 'update'])->name('clients.update');


use App\Http\Controllers\JobController;

Route::get('jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('jobs/create', [JobController::class, 'create'])->name('jobs.create');
Route::post('jobs', [JobController::class, 'store'])->name('jobs.store');
Route::get('jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
Route::put('jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
Route::delete('jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');


use App\Http\Controllers\InvoiceController;

Route::get('invoices/create/{client_id}', [InvoiceController::class, 'create'])->name('invoices.create');
Route::post('invoices', [InvoiceController::class, 'store'])->name('invoices.store');
Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index');



use App\Http\Controllers\AppointmentController;

Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
Route::get('appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
Route::put('appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::delete('appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

Route::get('/test', [AppointmentController::class, 'showAppointment']);
Route::get('/test/{client_id}', [AppointmentController::class, 'showAppointment'])->name('appointments.email');

Route::get('/email', [AppointmentController::class, 'indexEmail'])->name('email.index');



Route::post('saveContent/{client_id}', [AppointmentController::class, 'saveContent'])->name('appointments.saveContent');


Route::get('/', function () {
    return view('welcome');
});
