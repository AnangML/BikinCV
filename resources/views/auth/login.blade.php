<x-layouts.app :title="'Masuk — BikinCV'">
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-neutral-100 text-neutral-800">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm text-center">
            <a href="{{ route('cv.editor') }}" class="inline-block">
                <span class="text-base font-bold tracking-tight text-neutral-900">Bikin<span class="text-neutral-500 font-normal">CV</span></span>
            </a>
            <h2 class="mt-3 text-base font-semibold tracking-tight text-neutral-900">Masuk ke Akun Anda</h2>
            <p class="mt-0.5 text-xs text-neutral-500">Kelola dan simpan CV ATS Anda secara aman di cloud.</p>
        </div>

        <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-sm px-4">
            <div class="bg-white py-6 px-6 sm:px-8 rounded-lg border border-neutral-200 shadow-xs">
                
                @if (session('status'))
                    <div class="mb-4 p-2.5 rounded bg-neutral-50 border border-neutral-200 text-neutral-800 text-xs font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" class="space-y-3.5">
                    @csrf

                    <div>
                        <label for="email" class="block text-[11px] font-medium text-neutral-600 mb-1">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-2 px-2.5 text-neutral-900 @error('email') border-rose-500 @enderror">
                        @error('email')
                            <p class="text-rose-600 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-[11px] font-medium text-neutral-600 mb-1">Kata Sandi</label>
                        <input id="password" type="password" name="password" required
                               class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-2 px-2.5 text-neutral-900">
                    </div>

                    <div class="flex items-center justify-between text-xs pt-0.5">
                        <label class="flex items-center gap-1.5 cursor-pointer text-neutral-600">
                            <input type="checkbox" name="remember" class="rounded border-neutral-300 text-neutral-900 focus:ring-0">
                            <span>Ingat saya</span>
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full py-2 px-4 text-xs font-medium text-white bg-neutral-900 hover:bg-neutral-800 rounded-md transition-colors cursor-pointer">
                        Masuk
                    </button>
                </form>

                <div class="mt-5 text-center text-xs text-neutral-500 pt-4 border-t border-neutral-100">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-medium text-neutral-900 hover:underline ml-1">Daftar Akun Baru</a>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('cv.editor') }}" class="text-xs text-neutral-400 hover:text-neutral-700 font-medium">
                    ← Kembali ke Editor
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
