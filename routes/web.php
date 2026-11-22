<?php

declare(strict_types=1);

use App\Http\Controllers\Cv\ShowCvEditorController;
use Illuminate\Support\Facades\Route;

// Privacy-First CV Editor (100% Client-Side, No Database Storage for User CVs)
Route::get('/', ShowCvEditorController::class)->name('cv.editor');

// Redirect rute warisan langsung ke editor utama
Route::redirect('/login', '/');
Route::redirect('/register', '/');
Route::redirect('/dashboard', '/');
Route::redirect('/cv/save', '/');
