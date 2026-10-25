<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cv;

use App\Actions\Cv\DuplicateCvAction;
use App\Http\Controllers\Controller;
use App\Models\Cv;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class DuplicateCvController extends Controller
{
    /**
     * Menduplikasi CV menjadi versi baru.
     */
    public function __invoke(Cv $cv, Request $request, DuplicateCvAction $action): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();

        if ($cv->user_id !== $user->id) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $newCv = $action->execute($cv, $user->id);

        return redirect()->route('cv.editor', ['id' => $newCv->id])
            ->with('status', 'CV berhasil diduplikasi!');
    }
}
