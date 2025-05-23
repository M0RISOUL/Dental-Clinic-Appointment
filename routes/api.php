<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('holidays/{year}', [PatientController::class, 'fetchHolidays']);
});