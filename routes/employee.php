<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CompanyDetails;
use App\Http\Controllers\HardwareController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\VisitController;
use App\Models\Payment;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:employee'])
    ->prefix('employee')
    ->as('employee.')
    ->group(function () {
        Route::get('/dashboard', [VisitController::class, 'index'])->name('dashboard');

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

        Route::resource('softwares', SoftwareController::class)
        ->except(['show']);

        Route::resource('hardwares', HardwareController::class)
        ->except(['show']);

        Route::resource('visits', VisitController::class)
        ->except(['show']);

        Route::resource('payments', PaymentController::class)
        ->except(['show']);

        

    });
