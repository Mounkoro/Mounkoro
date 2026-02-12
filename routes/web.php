<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientProfileController;
use App\Http\Controllers\EngineerProfileController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Client Routes
    Route::prefix('client')->middleware('can:is-client')->group(function () {
        Route::get('/dashboard', [ClientProfileController::class, 'dashboard'])->name('client.dashboard');
        Route::get('/engineers', [EngineerProfileController::class, 'index'])->name('client.engineers');
        Route::get('/requests/new', [ServiceRequestController::class, 'create'])->name('client.requests.create');
        Route::post('/requests', [ServiceRequestController::class, 'store'])->name('client.requests.store');
        Route::get('/messages', [MessageController::class, 'clientMessages'])->name('client.messages');
    });

    // Engineer Routes
    Route::prefix('engineer')->middleware('can:is-engineer')->group(function () {
        Route::get('/dashboard', [EngineerProfileController::class, 'dashboard'])->name('engineer.dashboard');
        Route::get('/profile', [EngineerProfileController::class, 'edit'])->name('engineer.profile.edit');
        Route::post('/profile', [EngineerProfileController::class, 'update'])->name('engineer.profile.update');
        Route::get('/appointments', [AppointmentController::class, 'index'])->name('engineer.appointments');
        Route::post('/appointments', [AppointmentController::class, 'store'])->name('engineer.appointments.store');
        Route::get('/invoices/new', [InvoiceController::class, 'create'])->name('engineer.invoices.create');
        Route::post('/invoices', [InvoiceController::class, 'store'])->name('engineer.invoices.store');
        Route::get('/messages', [MessageController::class, 'engineerMessages'])->name('engineer.messages');
    });

    // Common Messaging API
    Route::get('/api/messages/{userId}', [MessageController::class, 'getMessages']);
    Route::post('/api/messages', [MessageController::class, 'sendMessage']);
});
