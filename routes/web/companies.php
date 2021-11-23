<?php

use App\Http\Controllers\Admin\Companies\CompaniesController;
use App\Http\Controllers\Admin\Companies\EmployeesController;

Route::get('/', [CompaniesController::class, 'index'])->name('dashboard');
Route::get('create', [CompaniesController::class, 'create'])->name('create');
Route::get('{company}/edit', [CompaniesController::class, 'edit'])->name('edit');
Route::get('{company}', [CompaniesController::class, 'show'])->name('show');
Route::post('/', [CompaniesController::class, 'store'])->name('store');
Route::put('{company}', [CompaniesController::class, 'update'])->name('update');
Route::get('{company}/employee/create', [EmployeesController::class, 'create'])->name('employees.create');
Route::post('{company}/employee', [EmployeesController::class, 'store'])->name('employees.store');
Route::get('/employee/{employee}/edit', [EmployeesController::class, 'edit'])->name('employees.edit');
Route::put('/employee/{employee}', [EmployeesController::class, 'update'])->name('employees.update');
Route::put('{company}/company-logo', [CompaniesController::class, 'updateCompanyLogo'])->name('update.company-logo');
Route::delete('{company}/company-logo', [CompaniesController::class, 'destroyCompanyLogo'])->name('delete.company-logo');
Route::delete('employee/{employee}', [EmployeesController::class, 'destroy'])->name('employees.delete');
Route::delete('{company}', [CompaniesController::class, 'destroy'])->name('delete');
Route::get('employeelist/{company}', [CompaniesController::class, 'showEmployees'])->name('showEmployees');
Route::get('/generate-company-token/{company}', [CompaniesController::class, 'generateCompanyToken']);
// Route::get('send-mail', function() {
//     $details = {
//         'title' => 'Mail From Mini-CRM',
//         'body' => 'Congratulations, your company has been successfully added to Mini-CRM'
//     }

//     \Mail::to('')
// })
