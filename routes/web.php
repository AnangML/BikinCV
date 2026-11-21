<?php

declare(strict_types=1);

use App\Http\Controllers\Cv\SaveCvController;
use App\Http\Controllers\Cv\ShowCvEditorController;
use Illuminate\Support\Facades\Route;

// Guest-First CV Editor & Save Endpoint (Tanpa Login)
Route::get('/', ShowCvEditorController::class)->name('cv.editor');
Route::post('/cv/save', SaveCvController::class)->name('cv.save');

// Redirect rute login / register / dashboard langsung ke editor utama
Route::redirect('/login', '/');
Route::redirect('/register', '/');
Route::redirect('/dashboard', '/');
