<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyDetails;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('employee.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/admin.php';

require __DIR__.'/employee.php';

require __DIR__.'/profile.php';

require __DIR__.'/auth.php';


