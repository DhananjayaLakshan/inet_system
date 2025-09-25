<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CompanyDetails;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:employee'])
    ->prefix('employee')
    ->as('employee.')
    ->group(function () {
        Route::get('/dashboard', [EmployeeController::class, 'index'])->name('dashboard');

        Route::resource('company-details', CompanyDetails::class)
        ->parameters(['company-details' => 'company'])
        ->except(['show']);

    });
