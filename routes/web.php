<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\TravelScheduleController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Customer\BookingController;
use App\Http\Controllers\Customer\TravelScheduleController as CustomerTravelScheduleController;
use App\Http\Controllers\Customer\PaymentController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/schedules', [TravelScheduleController::class, 'index'])->name('admin.schedules.index');
    Route::get('/schedules/create', [TravelScheduleController::class, 'create'])->name('admin.schedules.create');
    Route::post('/schedules', [TravelScheduleController::class, 'store'])->name('admin.schedules.store');
    Route::put('/schedules/{schedule}', [TravelScheduleController::class, 'update'])->name('admin.schedules.update');
    Route::delete('/schedules/{schedule}', [TravelScheduleController::class, 'destroy'])->name('admin.schedules.destroy');
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
});

Route::middleware(['auth', 'role:customer'])->prefix('customer')->group(function () {
    Route::get('/orders', [CustomerTravelScheduleController::class, 'index'])->name('customer.orders.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('customer.bookings.store');
    Route::get('/bookings', [BookingController::class, 'index'])->name('customer.bookings.index');
    Route::post('/bookings/{booking}/pay', [BookingController::class, 'pay']);
});


require __DIR__.'/auth.php';
