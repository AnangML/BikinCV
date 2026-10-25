<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Controller;
use App\Models\Cv;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class ShowCvEditorController extends Controller
{
    /**
     * Menampilkan halaman editor pembuatan CV interaktif (Guest First).
     */
    public function __invoke(Request $request): View
    {
        $cvId = $request->query('id');
        $initialCv = null;

        if ($cvId) {
            $initialCv = Cv::query()
                ->where('id', $cvId)
                ->first();
        }

        return view('cv-editor', [
            'initialCv' => $initialCv,
        ]);
    }
}
