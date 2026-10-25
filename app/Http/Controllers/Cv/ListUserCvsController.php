<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Controller;
use App\Models\Cv;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class ListUserCvsController extends Controller
{
    /**
     * Menampilkan dashboard daftar CV milik pengguna terautentikasi.
     */
    public function __invoke(Request $request): View
    {
        /** @var User $user */
        $user = $request->user();

        // Mengambil kolom spesifik saja untuk performa ringan
        $cvs = Cv::query()
            ->where('user_id', $user->id)
            ->select(['id', 'user_id', 'title', 'slug', 'template_id', 'ats_score', 'updated_at'])
            ->orderByDesc('updated_at')
            ->paginate(12);

        return view('dashboard', [
            'cvs' => $cvs,
        ]);
    }
}
