<x-layouts.app :title="'Daftar — BikinCV'">
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-neutral-100 text-neutral-800">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm text-center">
            <a href="{{ route('cv.editor') }}" class="inline-block">
                <span class="text-base font-bold tracking-tight text-neutral-900">Bikin<span class="text-neutral-500 font-normal">CV</span></span>
            </a>
            <h2 class="mt-3 text-base font-semibold tracking-tight text-neutral-900">Buat Akun Baru</h2>
            <p class="mt-0.5 text-xs text-neutral-500">Simpan CV tanpa batas dan kelola versi lamaran kerja.</p>
        </div>

        <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-sm px-4">
            <div class="bg-white py-6 px-6 sm:px-8 rounded-lg border border-neutral-200 shadow-xs">
                <form method="POST" action="{{ route('register.post') }}" class="space-y-3.5">
                    @csrf

                    <div>
                        <label for="name" class="block text-[11px] font-medium text-neutral-600 mb-1">Nama Lengkap</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                               placeholder="misal: Budi Pratama"
                               class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-2 px-2.5 text-neutral-900 @error('name') border-rose-500 @enderror">
                        @error('name')
                            <p class="text-rose-600 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-[11px] font-medium text-neutral-600 mb-1">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                               placeholder="nama@email.com"
                               class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-2 px-2.5 text-neutral-900 @error('email') border-rose-500 @enderror">
                        @error('email')
                            <p class="text-rose-600 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-[11px] font-medium text-neutral-600 mb-1">Kata Sandi (Min. 8 karakter)</label>
                        <input id="password" type="password" name="password" required
                               class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-2 px-2.5 text-neutral-900 @error('password') border-rose-500 @enderror">
                        @error('password')
                            <p class="text-rose-600 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-[11px] font-medium text-neutral-600 mb-1">Ulangi Kata Sandi</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                               class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-2 px-2.5 text-neutral-900">
                    </div>

                    <button type="submit"
                            class="w-full py-2 px-4 text-xs font-medium text-white bg-neutral-900 hover:bg-neutral-800 rounded-md transition-colors cursor-pointer">
                        Daftar Akun
                    </button>
                </form>

                <div class="mt-5 text-center text-xs text-neutral-500 pt-4 border-t border-neutral-100">
                    Sudah memiliki akun?
                    <a href="{{ route('login') }}" class="font-medium text-neutral-900 hover:underline ml-1">Masuk di Sini</a>
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
