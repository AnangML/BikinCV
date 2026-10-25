<?php

declare(strict_types=1);

namespace App\Actions\Cv;

use App\Models\Cv;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class SaveCvAction
{
    /**
     * Menyimpan data CV baru atau memperbarui data CV yang sudah ada.
     *
     * @param  array<string, mixed>  $data
     */
    public function execute(array $data, ?int $userId = null): Cv
    {
        return DB::transaction(function () use ($data, $userId): Cv {
            $cvId = $data['cv_id'] ?? null;

            if ($cvId) {
                $cvQuery = Cv::query()->where('id', $cvId);
                if ($userId) {
                    $cvQuery->where('user_id', $userId);
                }
                $cv = $cvQuery->firstOrFail();

                $cv->update([
                    'title' => $data['title'],
                    'template_id' => $data['template_id'],
                    'selected_font' => $data['selected_font'],
                    'doc_font_size' => $data['doc_font_size'],
                    'accent_color' => $data['accent_color'],
                    'content' => $data['content'],
                    'ats_score' => $data['ats_score'] ?? 0,
                    'user_id' => $userId ?? $cv->user_id,
                ]);

                return $cv;
            }

            // Buat CV baru dengan slug unik
            $slugBase = Str::slug($data['title']);
            $uniqueSlug = ($slugBase !== '' ? $slugBase : 'cv').'-'.strtolower(Str::random(6));

            return Cv::create([
                'user_id' => $userId,
                'title' => $data['title'],
                'slug' => $uniqueSlug,
                'template_id' => $data['template_id'],
                'selected_font' => $data['selected_font'],
                'doc_font_size' => $data['doc_font_size'],
                'accent_color' => $data['accent_color'],
                'content' => $data['content'],
                'ats_score' => $data['ats_score'] ?? 0,
                'is_public' => false,
            ]);
        });
    }
}
