<?php

use App\Http\Controllers\TimeZoneController;

Route::get('/', [TimeZoneController::class, 'index'])->name('timezone');
Route::get('change', [TimeZoneController::class, 'setUserTimeZone'])->name('setUserTimeZone');
