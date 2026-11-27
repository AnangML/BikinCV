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
     * Menampilkan halaman editor pembuatan CV interaktif (100% Privacy-First & Client-Side).
     */
    public function __invoke(Request $request): View
    {
        $seededCv = null;
        $seedSlug = $request->query('seed');

        if (is_string($seedSlug) && trim($seedSlug) !== '') {
            $query = Cv::query()->where('slug', trim($seedSlug));

            if (! app()->environment(['local', 'testing'])) {
                $query->where('is_public', true);
            }

            $cvRecord = $query->first([
                'title',
                'template_id',
                'selected_font',
                'doc_font_size',
                'accent_color',
                'content',
            ]);

            if ($cvRecord !== null && is_array($cvRecord->content)) {
                $seededCv = [
                    'title' => $cvRecord->title,
                    'selectedTemplate' => $cvRecord->template_id,
                    'selectedFont' => $cvRecord->selected_font,
                    'docFontSize' => $cvRecord->doc_font_size,
                    'accentColor' => $cvRecord->accent_color,
                    'docLanguage' => 'id',
                    'cv' => $cvRecord->content,
                ];
            }
        }

        return view('cv-editor', [
            'seededCv' => $seededCv,
        ]);
    }
}
