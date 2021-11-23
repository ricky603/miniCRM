<?php

use Illuminate\Support\Facades\Route;
use App\Jobs;
use App\Http\Controllers\Admin\Companies\EmployeesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('send-mail', function() {
//     $details = [
//         'email' => 'asdas@mail.com',
//         'title' => 'Mail From Mini-CRM',
//         'body' => 'Congratulations your company has been addded to mini-CRM.'
//     ];
//     dispatch(new Jobs\SendMail($details));
// });

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('companies')->middleware('auth')->name('admin.companies.')->group(base_path('routes/web/companies.php'));

Route::prefix('employees')->middleware('auth')->name('admin.employees.')->group(base_path('routes/web/employees.php'));

Route::get('/{company}/employee-list', [EmployeesController::class, 'showEmployeesApi'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::prefix('lang')->middleware('auth')->name('lang.')->group(base_path('routes/web/lang.php'));
Route::prefix('timezone')->middleware('auth')->name('timezone.')->group(base_path('routes/web/timezone.php'));
Route::get('open', [EmployeesController::class, 'open']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('/{company}/employee-list', [EmployeesController::class, 'showEmployeesApi']);
});
