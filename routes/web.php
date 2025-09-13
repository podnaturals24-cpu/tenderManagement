<?php

use Illuminate\Support\Facades\Route;

// 👇 ADD THESE LINES
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\ApplicationController;

// Home redirect to dashboard
Route::get('/', function() {
    return redirect()->route('dashboard');
});

// Auth
Route::get('register', [RegisterController::class,'show'])->name('register');
Route::post('register', [RegisterController::class,'register']);
Route::get('login', [LoginController::class,'show'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::post('logout', [LoginController::class,'logout'])->name('logout');

// Protected
Route::middleware('auth')->group(function() {
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');

    // Tenders
    Route::get('tenders/create', [TenderController::class,'create'])->name('tenders.create');
    Route::post('tenders', [TenderController::class,'store'])->name('tenders.store');
    Route::get('tenders/{tender}', [TenderController::class,'show'])->name('tenders.show');

    // Admin actions
    Route::post('tenders/{tender}/approve', [TenderController::class,'approve'])->name('tenders.approve');
    Route::post('tenders/{tender}/disapprove', [TenderController::class,'disapprove'])->name('tenders.disapprove');

    // Applications
    Route::post('tenders/{tender}/apply', [ApplicationController::class,'store'])->name('applications.store');
    Route::post('applications/{application}/approve', [ApplicationController::class,'approve'])->name('applications.approve');
    Route::post('applications/{application}/reject', [ApplicationController::class,'reject'])->name('applications.reject');
});
