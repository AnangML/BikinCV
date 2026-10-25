<?php

declare(strict_types=1);

namespace App\Actions\Cv;

use App\Models\Cv;
use Illuminate\Auth\Access\AuthorizationException;

final class DeleteCvAction
{
    /**
     * Menghapus CV dengan pengecekan kepemilikan user.
     *
     * @throws AuthorizationException
     */
    public function execute(Cv $cv, int $userId): void
    {
        if ($cv->user_id !== $userId) {
            throw new AuthorizationException('Anda tidak berhak menghapus CV ini.');
        }

        $cv->delete();
    }
}
