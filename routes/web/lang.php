<?php

use App\Http\Controllers\LangController;

Route::get('/', [LangController::class, 'index'])->name('lang');
Route::get('change', [LangController::Class, 'change'])->name('changeLang');