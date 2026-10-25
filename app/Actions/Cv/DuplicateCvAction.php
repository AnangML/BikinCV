<?php

declare(strict_types=1);

namespace App\Actions\Cv;

use App\Models\Cv;
use Illuminate\Support\Str;

final class DuplicateCvAction
{
    /**
     * Menduplikasi CV yang sudah ada untuk membuat versi baru.
     */
    public function execute(Cv $cv, int $userId): Cv
    {
        $newTitle = $cv->title.' (Salinan)';
        $slugBase = Str::slug($newTitle);
        $uniqueSlug = ($slugBase !== '' ? $slugBase : 'cv').'-'.strtolower(Str::random(6));

        return Cv::create([
            'user_id' => $userId,
            'title' => $newTitle,
            'slug' => $uniqueSlug,
            'template_id' => $cv->template_id,
            'selected_font' => $cv->selected_font,
            'doc_font_size' => $cv->doc_font_size,
            'accent_color' => $cv->accent_color,
            'content' => $cv->content,
            'ats_score' => $cv->ats_score,
            'is_public' => false,
        ]);
    }
}
