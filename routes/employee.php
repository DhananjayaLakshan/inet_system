<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CompanyDetails;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:employee'])
    ->prefix('employee')
    ->as('employee.')
    ->group(function () {
        Route::get('/dashboard', [EmployeeController::class, 'index'])->name('dashboard');

        /**
         * /employee/company-details
         * /employee/company-details/create
         * /employee/company-details
         * /employee/company-details/{company}/edit
         * /employee/company-details/{company}
         * /employee/company-details/{company}
        */
        Route::resource('company-details', CompanyDetails::class)
        ->parameters(['company-details' => 'company'])
        ->except(['show']);

        Route::resource('services', ServiceController::class)
        ->except(['show']);

    });
