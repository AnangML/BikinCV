<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cv;

use App\Actions\Cv\SaveCvAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cv\SaveCvRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class SaveCvController extends Controller
{
    /**
     * Menyimpan data CV ke database (Cloud Sync).
     */
    public function __invoke(SaveCvRequest $request, SaveCvAction $action): JsonResponse
    {
        /** @var User|null $user */
        $user = $request->user();
        $cv = $action->execute($request->validated(), $user?->id);

        return response()->json([
            'success' => true,
            'message' => 'CV berhasil disimpan ke cloud database!',
            'cv' => [
                'id' => $cv->id,
                'title' => $cv->title,
                'slug' => $cv->slug,
                'ats_score' => $cv->ats_score,
                'updated_at' => $cv->updated_at?->diffForHumans(),
            ],
        ]);
    }
}
