<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cv;

use App\Actions\Cv\DeleteCvAction;
use App\Http\Controllers\Controller;
use App\Models\Cv;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class DeleteCvController extends Controller
{
    /**
     * Menghapus CV dari database.
     */
    public function __invoke(Cv $cv, Request $request, DeleteCvAction $action): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();

        $action->execute($cv, $user->id);

        return redirect()->route('dashboard')
            ->with('status', 'CV berhasil dihapus.');
    }
}
