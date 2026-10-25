<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

final class ShowCvEditorController extends Controller
{
    /**
     * Menampilkan halaman editor pembuatan CV interaktif (Guest First).
     */
    public function __invoke(): View
    {
        return view('cv-editor');
    }
}
