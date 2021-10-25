<?php

// use App\Http\Controllers\Admin\Companies\CompaniesController;
use App\Http\Controllers\Admin\Companies\EmployeesController;
Route::get('/', [EmployeesController::class, 'index'])->name('dashboard');
