<?php

declare(strict_types=1);

use App\Http\Controllers\Cv\ShowCvEditorController;
use Illuminate\Support\Facades\Route;

Route::get('/', ShowCvEditorController::class)->name('cv.editor');
