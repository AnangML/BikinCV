<x-layouts.app :title="'Dashboard CV Saya — BikinCV'">
    <div class="min-h-screen bg-neutral-100 flex flex-col text-neutral-800">
        
        {{-- Top Navigation Bar --}}
        <header class="bg-white border-b border-neutral-200 sticky top-0 z-30">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 h-14 flex items-center justify-between">
                <a href="{{ route('cv.editor') }}" class="flex items-center gap-1.5 group">
                    <span class="text-sm font-bold tracking-tight text-neutral-900">Bikin<span class="text-neutral-500 font-normal">CV</span></span>
                </a>

                <div class="flex items-center gap-3">
                    <a href="{{ route('cv.editor') }}"
                       class="px-3.5 py-1.5 text-xs font-medium text-white bg-neutral-900 hover:bg-neutral-800 rounded-md transition-colors cursor-pointer">
                        Buat CV Baru
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-xs font-medium text-neutral-500 hover:text-neutral-900 px-2 py-1.5 cursor-pointer">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </header>

        {{-- Main Dashboard Content --}}
        <main class="flex-1 max-w-6xl w-full mx-auto px-4 sm:px-6 py-8">
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                <div>
                    <h1 class="text-lg font-semibold text-neutral-900 tracking-tight">Koleksi CV Saya</h1>
                    <p class="text-xs text-neutral-500 mt-0.5">Kelola versi resume untuk berbagai lamaran pekerjaan.</p>
                </div>
                <div class="text-xs text-neutral-500">
                    Masuk sebagai <strong class="text-neutral-900">{{ auth()->user()->name }}</strong>
                </div>
            </div>

            @if (session('status'))
                <div class="mb-5 p-3 rounded-md bg-neutral-50 border border-neutral-200 text-neutral-800 text-xs font-medium">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Grid of CVs --}}
            @if ($cvs->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($cvs as $cv)
                        <div class="bg-white rounded-lg border border-neutral-200 hover:border-neutral-300 transition-colors p-4 flex flex-col justify-between">
                            <div>
                                <div class="flex items-start justify-between gap-2 mb-2">
                                    <h3 class="text-xs font-semibold text-neutral-900 line-clamp-1" title="{{ $cv->title }}">
                                        {{ $cv->title }}
                                    </h3>

                                    {{-- ATS Score Badge --}}
                                    <span class="text-[10px] font-mono font-medium px-1.5 py-0.5 rounded bg-neutral-100 text-neutral-700">
                                        {{ $cv->ats_score }}% ATS
                                    </span>
                                </div>

                                <div class="text-[11px] text-neutral-400 mb-4 flex items-center gap-2">
                                    <span>{{ ucfirst($cv->template_id) }}</span>
                                    <span>•</span>
                                    <span>Update {{ $cv->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <div class="pt-3 border-t border-neutral-100 flex items-center justify-between gap-2 text-xs">
                                <a href="{{ route('cv.editor', ['id' => $cv->id]) }}"
                                   class="font-medium text-neutral-900 hover:underline">
                                    Edit Dokumen →
                                </a>

                                <div class="flex items-center gap-2 text-neutral-400">
                                    <form method="POST" action="{{ route('cv.duplicate', $cv) }}">
                                        @csrf
                                        <button type="submit" class="hover:text-neutral-900 font-medium cursor-pointer" title="Duplikasi">
                                            Duplikasi
                                        </button>
                                    </form>

                                    <span>•</span>

                                    <form method="POST" action="{{ route('cv.delete', $cv) }}" onsubmit="return confirm('Hapus CV ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="hover:text-rose-600 font-medium cursor-pointer">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination Links --}}
                <div class="mt-6">
                    {{ $cvs->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg border border-neutral-200 p-10 text-center space-y-3">
                    <h3 class="text-sm font-semibold text-neutral-900">Belum ada CV yang tersimpan</h3>
                    <p class="text-xs text-neutral-500 max-w-sm mx-auto">Mulai susun CV ATS-friendly pertamamu sekarang langsung dari editor.</p>
                    <div class="pt-2">
                        <a href="{{ route('cv.editor') }}" class="inline-flex px-4 py-2 text-xs font-medium text-white bg-neutral-900 hover:bg-neutral-800 rounded-md transition-colors">
                            Buka Editor CV
                        </a>
                    </div>
                </div>
            @endif

        </main>
    </div>
</x-layouts.app>
