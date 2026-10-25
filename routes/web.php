<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\ShowLoginController;
use App\Http\Controllers\Auth\ShowRegisterController;
use App\Http\Controllers\Cv\DeleteCvController;
use App\Http\Controllers\Cv\DuplicateCvController;
use App\Http\Controllers\Cv\ListUserCvsController;
use App\Http\Controllers\Cv\SaveCvController;
use App\Http\Controllers\Cv\ShowCvEditorController;
use Illuminate\Support\Facades\Route;

// Guest-First CV Editor & Save Endpoint
Route::get('/', ShowCvEditorController::class)->name('cv.editor');
Route::post('/cv/save', SaveCvController::class)->name('cv.save');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', ShowLoginController::class)->name('login');
    Route::post('/login', AuthenticateController::class)->name('login.post');
    Route::get('/register', ShowRegisterController::class)->name('register');
    Route::post('/register', RegisterUserController::class)->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', LogoutController::class)->name('logout');
    Route::get('/dashboard', ListUserCvsController::class)->name('dashboard');
    Route::post('/cv/{cv}/duplicate', DuplicateCvController::class)->name('cv.duplicate');
    Route::delete('/cv/{cv}', DeleteCvController::class)->name('cv.delete');
});
