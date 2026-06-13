<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');



Route::post('/chatbot', [ChatbotController::class, 'reply'])
    ->middleware('throttle:15,1')
    ->name('chatbot.reply');