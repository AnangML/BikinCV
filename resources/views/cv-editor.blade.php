<x-layouts.app>
    <div x-data="cvEditor({
        cv: @json($initialCv ? $initialCv->content : null),
        title: @json($initialCv ? $initialCv->title : null),
        cvId: @json($initialCv ? $initialCv->id : null),
        template: @json($initialCv ? $initialCv->template_id : null),
        font: @json($initialCv ? $initialCv->selected_font : null),
        fontSize: @json($initialCv ? $initialCv->doc_font_size : null),
        accentColor: @json($initialCv ? $initialCv->accent_color : null)
    })" class="min-h-screen flex flex-col bg-neutral-100 text-neutral-800">
        
        {{-- ================================================================= --}}
        {{-- TOP NAVIGATION BAR (Clean, Minimalist SaaS Toolbar) --}}
        {{-- ================================================================= --}}
        <header class="no-print sticky top-0 z-40 bg-white border-b border-neutral-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 h-14 flex items-center justify-between gap-3">
                
                {{-- Left: Brand & Autosave Status --}}
                <div class="flex items-center gap-3 shrink-0">
                    <a href="{{ route('cv.editor') }}" class="flex items-center gap-1.5 group">
                        <span class="text-sm font-bold tracking-tight text-neutral-900">Bikin<span class="text-neutral-500 font-normal">CV</span></span>
                    </a>

                    {{-- Autosave Indicator --}}
                    <div class="hidden md:flex items-center gap-1.5 ml-2 pl-3 border-l border-neutral-200 text-[11px] text-neutral-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span x-text="saveStatusText"></span>
                    </div>
                </div>

                {{-- Center: Document Controls (Template, Font, Size, Color) --}}
                <div class="hidden lg:flex items-center gap-2">
                    {{-- Template Selector --}}
                    <select x-model="selectedTemplate" 
                            class="bg-neutral-50 hover:bg-neutral-100 border border-neutral-200 rounded-md text-xs font-medium text-neutral-700 py-1.5 px-2.5 focus:border-neutral-900 focus:ring-0 cursor-pointer">
                        <option value="classic">The Classic Executive</option>
                        <option value="modern">Modern Minimalist</option>
                        <option value="tech">Tech & Engineering</option>
                        <option value="compact">Compact One-Pager</option>
                        <option value="academic">Academic & Ivy League</option>
                    </select>

                    {{-- Font Selector --}}
                    <select x-model="selectedFont" 
                            class="bg-neutral-50 hover:bg-neutral-100 border border-neutral-200 rounded-md text-xs font-medium text-neutral-700 py-1.5 px-2.5 focus:border-neutral-900 focus:ring-0 cursor-pointer">
                        <optgroup label="Sans-Serif">
                            <option value="inter">Inter</option>
                            <option value="roboto">Roboto</option>
                            <option value="jakarta">Plus Jakarta Sans</option>
                            <option value="arial">Arial</option>
                        </optgroup>
                        <optgroup label="Serif">
                            <option value="merriweather">Merriweather</option>
                            <option value="georgia">Georgia</option>
                            <option value="garamond">Garamond</option>
                        </optgroup>
                    </select>

                    {{-- Font Size Selector --}}
                    <select x-model="docFontSize" 
                            class="bg-neutral-50 hover:bg-neutral-100 border border-neutral-200 rounded-md text-xs font-medium text-neutral-700 py-1.5 px-2 focus:border-neutral-900 focus:ring-0 cursor-pointer">
                        <option value="doc-size-sm">10pt</option>
                        <option value="doc-size-base">11pt</option>
                        <option value="doc-size-lg">12pt</option>
                    </select>

                    {{-- Accent Color Selector (Minimalist dots) --}}
                    <div class="flex items-center gap-1.5 pl-1.5 border-l border-neutral-200">
                        <button type="button" @click="accentColor = '#111827'" 
                                :class="accentColor === '#111827' ? 'ring-1 ring-neutral-900 ring-offset-1' : ''"
                                class="w-3.5 h-3.5 rounded-full bg-neutral-900 cursor-pointer" title="Hitam"></button>
                        <button type="button" @click="accentColor = '#1e3a8a'" 
                                :class="accentColor === '#1e3a8a' ? 'ring-1 ring-neutral-900 ring-offset-1' : ''"
                                class="w-3.5 h-3.5 rounded-full bg-blue-900 cursor-pointer" title="Navy"></button>
                        <button type="button" @click="accentColor = '#334155'" 
                                :class="accentColor === '#334155' ? 'ring-1 ring-neutral-900 ring-offset-1' : ''"
                                class="w-3.5 h-3.5 rounded-full bg-slate-700 cursor-pointer" title="Charcoal"></button>
                        <button type="button" @click="accentColor = '#14532d'" 
                                :class="accentColor === '#14532d' ? 'ring-1 ring-neutral-900 ring-offset-1' : ''"
                                class="w-3.5 h-3.5 rounded-full bg-emerald-900 cursor-pointer" title="Forest"></button>
                    </div>
                </div>

                {{-- Right: Actions (Demo, ATS, Cloud, Print) --}}
                <div class="flex items-center gap-2">
                    {{-- Load Demo Data Button --}}
                    <button type="button" @click="loadDemoData()"
                            class="hidden xl:inline-flex px-2.5 py-1.5 text-xs font-medium text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100 rounded-md transition-colors cursor-pointer"
                            title="Isi form otomatis dengan data contoh">
                        Isi Demo
                    </button>

                    {{-- ATS Score Button (Minimalist Pill) --}}
                    <button type="button" @click="showAtsAuditModal = true"
                            class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-md border border-neutral-200 hover:border-neutral-300 bg-white text-xs font-medium text-neutral-700 hover:bg-neutral-50 transition-colors cursor-pointer"
                            title="Buka laporan audit skor ATS">
                        <span class="w-1.5 h-1.5 rounded-full" :class="atsScore >= 80 ? 'bg-emerald-500' : (atsScore >= 50 ? 'bg-amber-500' : 'bg-rose-500')"></span>
                        <span>ATS: <strong class="text-neutral-900" x-text="atsScore + '%'"></strong></span>
                    </button>

                    {{-- Save to Cloud Button --}}
                    <button type="button" @click="saveToCloud({{ auth()->check() ? 'true' : 'false' }})" :disabled="isSavingCloud"
                            class="hidden sm:inline-flex px-3 py-1.5 text-xs font-medium text-neutral-700 hover:text-neutral-900 bg-white hover:bg-neutral-50 border border-neutral-200 rounded-md transition-colors cursor-pointer"
                            title="Simpan CV ke akun cloud">
                        <span x-text="isSavingCloud ? 'Menyimpan...' : (currentCvId ? 'Update Cloud' : 'Simpan Cloud')"></span>
                    </button>

                    {{-- Primary CTA: Unduh PDF --}}
                    <button type="button" @click="printCv()"
                            class="px-3.5 py-1.5 text-xs font-medium text-white bg-neutral-900 hover:bg-neutral-800 rounded-md transition-colors cursor-pointer">
                        Unduh PDF
                    </button>

                    {{-- User Account Links --}}
                    <div class="border-l border-neutral-200 pl-2 ml-1">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-xs font-medium text-neutral-600 hover:text-neutral-900 px-2 py-1.5 rounded-md hover:bg-neutral-100 transition-colors">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-xs font-medium text-neutral-600 hover:text-neutral-900 px-2 py-1.5 rounded-md hover:bg-neutral-100 transition-colors">
                                Masuk
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        {{-- ================================================================= --}}
        {{-- MAIN SPLIT SCREEN (Form di Kiri, A4 Preview di Kanan) --}}
        {{-- ================================================================= --}}
        <main class="flex-1 flex overflow-hidden">
            
            {{-- ----------------------------------------------------------------- --}}
            {{-- PANEL KIRI: Form Editor Minimalis --}}
            {{-- ----------------------------------------------------------------- --}}
            <aside class="w-full lg:w-[48%] xl:w-[42%] bg-white border-r border-neutral-200 overflow-y-auto custom-scrollbar flex flex-col"
                   :class="mobileTab === 'form' ? 'block' : 'hidden lg:flex'">
                
                {{-- Form Header & Quick Tools (Title, Import, Export, Reset) --}}
                <div class="px-5 py-3 border-b border-neutral-100 bg-white flex items-center justify-between gap-3">
                    <input type="text" x-model="cvTitle" placeholder="Judul dokumen..."
                           class="text-xs font-medium text-neutral-900 border-none bg-transparent hover:bg-neutral-50 focus:bg-white rounded px-2 py-1 focus:ring-1 focus:ring-neutral-400 flex-1 min-w-[150px]">

                    <div class="flex items-center gap-3 text-xs text-neutral-500 font-medium">
                        {{-- Import JSON --}}
                        <label class="hover:text-neutral-900 cursor-pointer transition-colors" title="Impor file .json">
                            <span>Impor</span>
                            <input type="file" accept=".json" @change="importJson($event)" class="hidden">
                        </label>

                        <span class="text-neutral-200">•</span>

                        {{-- Export JSON --}}
                        <button type="button" @click="exportJson()" class="hover:text-neutral-900 cursor-pointer transition-colors" title="Unduh backup .json">
                            Ekspor
                        </button>

                        <span class="text-neutral-200">•</span>

                        <button type="button" @click="resetForm()" class="text-neutral-400 hover:text-rose-600 cursor-pointer transition-colors">
                            Reset
                        </button>
                    </div>
                </div>

                {{-- Accordion Sections (Clean Minimalist Hierarchy) --}}
                <div class="divide-y divide-neutral-100 flex-1">
                    
                    {{-- 1. SECTION: DATA DIRI & KONTAK --}}
                    <div>
                        <button type="button" @click="activeSection = (activeSection === 'personal' ? '' : 'personal')"
                                class="w-full px-5 py-3.5 bg-white hover:bg-neutral-50 flex items-center justify-between text-left transition-colors cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <span class="text-[11px] font-mono text-neutral-400">01</span>
                                <span class="text-xs font-semibold text-neutral-900">Informasi Pribadi</span>
                            </div>
                            <span class="text-xs text-neutral-400 font-mono" x-text="activeSection === 'personal' ? '−' : '+'"></span>
                        </button>

                        <div x-show="activeSection === 'personal'" x-collapse>
                            <div class="p-5 pt-2 space-y-3 bg-neutral-50/50">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-[11px] font-medium text-neutral-600 mb-1">Nama Lengkap</label>
                                        <input type="text" x-model="cv.personal.fullName" placeholder="misal: Budi Pratama, S.Kom"
                                               class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white text-neutral-900 placeholder:text-neutral-400">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-medium text-neutral-600 mb-1">Target Posisi / Jabatan</label>
                                        <input type="text" x-model="cv.personal.jobTitle" placeholder="misal: Full Stack Developer"
                                               class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white text-neutral-900 placeholder:text-neutral-400">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div>
                                        <label class="block text-[11px] font-medium text-neutral-600 mb-1">Email</label>
                                        <input type="email" x-model="cv.personal.email" placeholder="nama@email.com"
                                               class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white text-neutral-900 placeholder:text-neutral-400">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-medium text-neutral-600 mb-1">Nomor Telepon</label>
                                        <input type="text" x-model="cv.personal.phone" placeholder="+62 812-xxxx-xxxx"
                                               class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white text-neutral-900 placeholder:text-neutral-400">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-medium text-neutral-600 mb-1">Domisili</label>
                                        <input type="text" x-model="cv.personal.location" placeholder="Jakarta, Indonesia"
                                               class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white text-neutral-900 placeholder:text-neutral-400">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div>
                                        <label class="block text-[11px] font-medium text-neutral-600 mb-1">LinkedIn</label>
                                        <input type="text" x-model="cv.personal.linkedin" placeholder="linkedin.com/in/username"
                                               class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white text-neutral-900 placeholder:text-neutral-400">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-medium text-neutral-600 mb-1">GitHub / Portofolio</label>
                                        <input type="text" x-model="cv.personal.github" placeholder="github.com/username"
                                               class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white text-neutral-900 placeholder:text-neutral-400">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-medium text-neutral-600 mb-1">Website Pribadi</label>
                                        <input type="text" x-model="cv.personal.website" placeholder="namadomain.com"
                                               class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white text-neutral-900 placeholder:text-neutral-400">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2. SECTION: RINGKASAN PROFIL (SUMMARY) --}}
                    <div>
                        <button type="button" @click="activeSection = (activeSection === 'summary' ? '' : 'summary')"
                                class="w-full px-5 py-3.5 bg-white hover:bg-neutral-50 flex items-center justify-between text-left transition-colors cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <span class="text-[11px] font-mono text-neutral-400">02</span>
                                <span class="text-xs font-semibold text-neutral-900">Ringkasan Profil</span>
                            </div>
                            <span class="text-xs text-neutral-400 font-mono" x-text="activeSection === 'summary' ? '−' : '+'"></span>
                        </button>

                        <div x-show="activeSection === 'summary'" x-collapse>
                            <div class="p-5 pt-2 space-y-2 bg-neutral-50/50">
                                <textarea x-model="cv.personal.summary" rows="4"
                                          placeholder="Tuliskan pengalaman bertahun-tahun, bidang spesialisasi, dan pencapaian terbesarmu..."
                                          class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 p-2.5 bg-white text-neutral-900 placeholder:text-neutral-400"></textarea>
                                
                                <div class="flex items-center justify-between text-[11px] text-neutral-400">
                                    <span>Gunakan format: <em>Tahun pengalaman + keahlian utama + pencapaian metrik</em>.</span>
                                    <span x-text="(cv.personal.summary ? cv.personal.summary.length : 0) + ' karakter'"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 3. SECTION: PENGALAMAN KERJA (EXPERIENCES) --}}
                    <div>
                        <button type="button" @click="activeSection = (activeSection === 'experience' ? '' : 'experience')"
                                class="w-full px-5 py-3.5 bg-white hover:bg-neutral-50 flex items-center justify-between text-left transition-colors cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <span class="text-[11px] font-mono text-neutral-400">03</span>
                                <span class="text-xs font-semibold text-neutral-900">Pengalaman Kerja</span>
                                <span class="text-[11px] text-neutral-400 font-normal" x-text="'(' + cv.experiences.length + ')'"></span>
                            </div>
                            <span class="text-xs text-neutral-400 font-mono" x-text="activeSection === 'experience' ? '−' : '+'"></span>
                        </button>

                        <div x-show="activeSection === 'experience'" x-collapse>
                            <div class="p-5 pt-2 space-y-3.5 bg-neutral-50/50">
                                <div class="flex items-center justify-between">
                                    <button type="button" @click="showActionVerbsModal = true"
                                            class="text-xs text-neutral-500 hover:text-neutral-900 font-medium underline cursor-pointer">
                                        Kamus Kata Kerja Aktif (Action Verbs) →
                                    </button>
                                </div>

                                <template x-for="(exp, expIdx) in cv.experiences" :key="exp.id || expIdx">
                                    <div class="p-3.5 bg-white border border-neutral-200 rounded-lg space-y-3">
                                        <div class="flex items-center justify-between pb-2 border-b border-neutral-100">
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs font-medium text-neutral-700" x-text="'Pengalaman #' + (expIdx + 1)"></span>
                                                
                                                {{-- Reorder Buttons --}}
                                                <div class="flex items-center gap-1 text-[11px] text-neutral-400">
                                                    <button type="button" @click="moveExperience(expIdx, -1)" :disabled="expIdx === 0"
                                                            class="hover:text-neutral-900 disabled:opacity-20 cursor-pointer" title="Naik">↑</button>
                                                    <button type="button" @click="moveExperience(expIdx, 1)" :disabled="expIdx === cv.experiences.length - 1"
                                                            class="hover:text-neutral-900 disabled:opacity-20 cursor-pointer" title="Turun">↓</button>
                                                </div>
                                            </div>

                                            <button type="button" @click="removeExperience(expIdx)"
                                                    class="text-[11px] text-neutral-400 hover:text-rose-600 transition-colors cursor-pointer">Hapus</button>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                            <div>
                                                <label class="block text-[11px] font-medium text-neutral-600 mb-1">Posisi / Jabatan</label>
                                                <input type="text" x-model="exp.position" placeholder="Frontend Developer"
                                                       class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white">
                                            </div>
                                            <div>
                                                <label class="block text-[11px] font-medium text-neutral-600 mb-1">Perusahaan</label>
                                                <input type="text" x-model="exp.company" placeholder="PT Maju Bersama"
                                                       class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white">
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                                            <div>
                                                <label class="block text-[11px] font-medium text-neutral-600 mb-1">Mulai</label>
                                                <input type="text" x-model="exp.startDate" placeholder="Jan 2022"
                                                       class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white">
                                            </div>
                                            <div>
                                                <label class="block text-[11px] font-medium text-neutral-600 mb-1">Selesai</label>
                                                <input type="text" x-model="exp.endDate" :disabled="exp.isCurrent" placeholder="Des 2023"
                                                       class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white disabled:bg-neutral-100 disabled:text-neutral-400">
                                            </div>
                                            <div>
                                                <label class="block text-[11px] font-medium text-neutral-600 mb-1">Lokasi</label>
                                                <input type="text" x-model="exp.location" placeholder="Jakarta (Remote)"
                                                       class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white">
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" :id="'current_' + expIdx" x-model="exp.isCurrent" class="rounded border-neutral-300 text-neutral-900 focus:ring-0">
                                            <label :for="'current_' + expIdx" class="text-xs text-neutral-600 cursor-pointer">Masih bekerja di posisi ini</label>
                                        </div>

                                        {{-- Bullet Points --}}
                                        <div class="space-y-1.5 pt-1">
                                            <label class="block text-[11px] font-medium text-neutral-600">Poin Pencapaian & Tanggung Jawab</label>
                                            <template x-for="(bullet, bIdx) in exp.bullets" :key="bIdx">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-neutral-300 text-xs">•</span>
                                                    <input type="text" x-model="exp.bullets[bIdx]" placeholder="Meningkatkan performa sistem sebesar 30%..."
                                                           class="flex-1 text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white">
                                                    <button type="button" @click="removeBullet(expIdx, bIdx)" class="text-neutral-400 hover:text-rose-600 text-xs px-1 cursor-pointer">✕</button>
                                                </div>
                                            </template>
                                            <button type="button" @click="addBullet(expIdx)"
                                                    class="text-xs text-neutral-600 hover:text-neutral-900 font-medium cursor-pointer pt-0.5">
                                                + Tambah Poin
                                            </button>
                                        </div>
                                    </div>
                                </template>

                                <button type="button" @click="addExperience()"
                                        class="w-full py-2 bg-white hover:bg-neutral-50 border border-neutral-200 rounded-md text-xs font-medium text-neutral-700 transition-colors cursor-pointer">
                                    + Tambah Pengalaman Kerja
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- 4. SECTION: PENDIDIKAN (EDUCATIONS) --}}
                    <div>
                        <button type="button" @click="activeSection = (activeSection === 'education' ? '' : 'education')"
                                class="w-full px-5 py-3.5 bg-white hover:bg-neutral-50 flex items-center justify-between text-left transition-colors cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <span class="text-[11px] font-mono text-neutral-400">04</span>
                                <span class="text-xs font-semibold text-neutral-900">Riwayat Pendidikan</span>
                                <span class="text-[11px] text-neutral-400 font-normal" x-text="'(' + cv.educations.length + ')'"></span>
                            </div>
                            <span class="text-xs text-neutral-400 font-mono" x-text="activeSection === 'education' ? '−' : '+'"></span>
                        </button>

                        <div x-show="activeSection === 'education'" x-collapse>
                            <div class="p-5 pt-2 space-y-3.5 bg-neutral-50/50">
                                <template x-for="(edu, eduIdx) in cv.educations" :key="edu.id || eduIdx">
                                    <div class="p-3.5 bg-white border border-neutral-200 rounded-lg space-y-3">
                                        <div class="flex items-center justify-between pb-2 border-b border-neutral-100">
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs font-medium text-neutral-700" x-text="'Pendidikan #' + (eduIdx + 1)"></span>
                                                <div class="flex items-center gap-1 text-[11px] text-neutral-400">
                                                    <button type="button" @click="moveEducation(eduIdx, -1)" :disabled="eduIdx === 0"
                                                            class="hover:text-neutral-900 disabled:opacity-20 cursor-pointer" title="Naik">↑</button>
                                                    <button type="button" @click="moveEducation(eduIdx, 1)" :disabled="eduIdx === cv.educations.length - 1"
                                                            class="hover:text-neutral-900 disabled:opacity-20 cursor-pointer" title="Turun">↓</button>
                                                </div>
                                            </div>

                                            <button type="button" @click="removeEducation(eduIdx)" class="text-[11px] text-neutral-400 hover:text-rose-600 transition-colors cursor-pointer">Hapus</button>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                            <div>
                                                <label class="block text-[11px] font-medium text-neutral-600 mb-1">Universitas / Sekolah</label>
                                                <input type="text" x-model="edu.institution" placeholder="Universitas Indonesia"
                                                       class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white">
                                            </div>
                                            <div>
                                                <label class="block text-[11px] font-medium text-neutral-600 mb-1">Gelar / Jurusan</label>
                                                <input type="text" x-model="edu.degree" placeholder="S1 Teknik Informatika"
                                                       class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white">
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                                            <div>
                                                <label class="block text-[11px] font-medium text-neutral-600 mb-1">Tahun Mulai</label>
                                                <input type="text" x-model="edu.startDate" placeholder="2018"
                                                       class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white">
                                            </div>
                                            <div>
                                                <label class="block text-[11px] font-medium text-neutral-600 mb-1">Tahun Lulus</label>
                                                <input type="text" x-model="edu.endDate" placeholder="2022"
                                                       class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white">
                                            </div>
                                            <div>
                                                <label class="block text-[11px] font-medium text-neutral-600 mb-1">IPK / GPA</label>
                                                <input type="text" x-model="edu.gpa" placeholder="3.80 / 4.00"
                                                       class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white">
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <button type="button" @click="addEducation()"
                                        class="w-full py-2 bg-white hover:bg-neutral-50 border border-neutral-200 rounded-md text-xs font-medium text-neutral-700 transition-colors cursor-pointer">
                                    + Tambah Pendidikan
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- 5. SECTION: SKILLS / KEAHLIAN --}}
                    <div>
                        <button type="button" @click="activeSection = (activeSection === 'skills' ? '' : 'skills')"
                                class="w-full px-5 py-3.5 bg-white hover:bg-neutral-50 flex items-center justify-between text-left transition-colors cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <span class="text-[11px] font-mono text-neutral-400">05</span>
                                <span class="text-xs font-semibold text-neutral-900">Keahlian & Keterampilan</span>
                            </div>
                            <span class="text-xs text-neutral-400 font-mono" x-text="activeSection === 'skills' ? '−' : '+'"></span>
                        </button>

                        <div x-show="activeSection === 'skills'" x-collapse>
                            <div class="p-5 pt-2 space-y-3.5 bg-neutral-50/50">
                                
                                {{-- Languages --}}
                                <div>
                                    <label class="block text-[11px] font-medium text-neutral-600 mb-1">Bahasa Pemrograman / Inti</label>
                                    <div class="flex flex-wrap items-center gap-1.5 p-2 bg-white border border-neutral-200 rounded-md min-h-[38px]">
                                        <template x-for="(skill, sIdx) in cv.skills.languages" :key="sIdx">
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-neutral-100 text-xs font-medium text-neutral-800">
                                                <span x-text="skill"></span>
                                                <button type="button" @click="removeSkillTag('languages', sIdx)" class="text-neutral-400 hover:text-neutral-900 cursor-pointer">✕</button>
                                            </span>
                                        </template>
                                        <input type="text" @keydown.enter.prevent="addSkillTag('languages', $event)" placeholder="Ketik lalu Enter..."
                                               class="flex-1 min-w-[110px] bg-transparent border-none text-xs focus:ring-0 p-0 text-neutral-800 placeholder:text-neutral-400">
                                    </div>
                                </div>

                                {{-- Frameworks --}}
                                <div>
                                    <label class="block text-[11px] font-medium text-neutral-600 mb-1">Frameworks & Libraries</label>
                                    <div class="flex flex-wrap items-center gap-1.5 p-2 bg-white border border-neutral-200 rounded-md min-h-[38px]">
                                        <template x-for="(skill, sIdx) in cv.skills.frameworks" :key="sIdx">
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-neutral-100 text-xs font-medium text-neutral-800">
                                                <span x-text="skill"></span>
                                                <button type="button" @click="removeSkillTag('frameworks', sIdx)" class="text-neutral-400 hover:text-neutral-900 cursor-pointer">✕</button>
                                            </span>
                                        </template>
                                        <input type="text" @keydown.enter.prevent="addSkillTag('frameworks', $event)" placeholder="Ketik lalu Enter..."
                                               class="flex-1 min-w-[110px] bg-transparent border-none text-xs focus:ring-0 p-0 text-neutral-800 placeholder:text-neutral-400">
                                    </div>
                                </div>

                                {{-- Databases & Tools --}}
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-[11px] font-medium text-neutral-600 mb-1">Database</label>
                                        <div class="flex flex-wrap items-center gap-1.5 p-2 bg-white border border-neutral-200 rounded-md min-h-[38px]">
                                            <template x-for="(skill, sIdx) in cv.skills.databases" :key="sIdx">
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-neutral-100 text-xs font-medium text-neutral-800">
                                                    <span x-text="skill"></span>
                                                    <button type="button" @click="removeSkillTag('databases', sIdx)" class="text-neutral-400 hover:text-neutral-900 cursor-pointer">✕</button>
                                                </span>
                                            </template>
                                            <input type="text" @keydown.enter.prevent="addSkillTag('databases', $event)" placeholder="Ketik + Enter..."
                                                   class="flex-1 min-w-[90px] bg-transparent border-none text-xs focus:ring-0 p-0 text-neutral-800 placeholder:text-neutral-400">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-medium text-neutral-600 mb-1">Tools & Cloud</label>
                                        <div class="flex flex-wrap items-center gap-1.5 p-2 bg-white border border-neutral-200 rounded-md min-h-[38px]">
                                            <template x-for="(skill, sIdx) in cv.skills.tools" :key="sIdx">
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-neutral-100 text-xs font-medium text-neutral-800">
                                                    <span x-text="skill"></span>
                                                    <button type="button" @click="removeSkillTag('tools', sIdx)" class="text-neutral-400 hover:text-neutral-900 cursor-pointer">✕</button>
                                                </span>
                                            </template>
                                            <input type="text" @keydown.enter.prevent="addSkillTag('tools', $event)" placeholder="Ketik + Enter..."
                                                   class="flex-1 min-w-[90px] bg-transparent border-none text-xs focus:ring-0 p-0 text-neutral-800 placeholder:text-neutral-400">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 6. SECTION: PROYEK UNGGULAN --}}
                    <div>
                        <button type="button" @click="activeSection = (activeSection === 'projects' ? '' : 'projects')"
                                class="w-full px-5 py-3.5 bg-white hover:bg-neutral-50 flex items-center justify-between text-left transition-colors cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <span class="text-[11px] font-mono text-neutral-400">06</span>
                                <span class="text-xs font-semibold text-neutral-900">Proyek Portofolio</span>
                                <span class="text-[11px] text-neutral-400 font-normal" x-text="'(' + cv.projects.length + ')'"></span>
                            </div>
                            <span class="text-xs text-neutral-400 font-mono" x-text="activeSection === 'projects' ? '−' : '+'"></span>
                        </button>

                        <div x-show="activeSection === 'projects'" x-collapse>
                            <div class="p-5 pt-2 space-y-3.5 bg-neutral-50/50">
                                <template x-for="(proj, projIdx) in cv.projects" :key="proj.id || projIdx">
                                    <div class="p-3.5 bg-white border border-neutral-200 rounded-lg space-y-2.5">
                                        <div class="flex items-center justify-between pb-2 border-b border-neutral-100">
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs font-medium text-neutral-700" x-text="'Proyek #' + (projIdx + 1)"></span>
                                                <div class="flex items-center gap-1 text-[11px] text-neutral-400">
                                                    <button type="button" @click="moveProject(projIdx, -1)" :disabled="projIdx === 0"
                                                            class="hover:text-neutral-900 disabled:opacity-20 cursor-pointer" title="Naik">↑</button>
                                                    <button type="button" @click="moveProject(projIdx, 1)" :disabled="projIdx === cv.projects.length - 1"
                                                            class="hover:text-neutral-900 disabled:opacity-20 cursor-pointer" title="Turun">↓</button>
                                                </div>
                                            </div>

                                            <button type="button" @click="removeProject(projIdx)" class="text-[11px] text-neutral-400 hover:text-rose-600 transition-colors cursor-pointer">Hapus</button>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                            <div>
                                                <label class="block text-[11px] font-medium text-neutral-600 mb-1">Nama Proyek</label>
                                                <input type="text" x-model="proj.name" placeholder="misal: Mobile E-Commerce" 
                                                       class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white">
                                            </div>
                                            <div>
                                                <label class="block text-[11px] font-medium text-neutral-600 mb-1">Peran</label>
                                                <input type="text" x-model="proj.role" placeholder="misal: Lead Backend Developer" 
                                                       class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white">
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-[11px] font-medium text-neutral-600 mb-1">Link Repositori / Demo</label>
                                            <input type="text" x-model="proj.link" placeholder="github.com/username/project" 
                                                   class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white">
                                        </div>

                                        <div>
                                            <label class="block text-[11px] font-medium text-neutral-600 mb-1">Deskripsi Singkat</label>
                                            <textarea x-model="proj.description" rows="2" placeholder="Masalah yang diselesaikan dan teknologi yang dipakai..." 
                                                      class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 p-2 bg-white"></textarea>
                                        </div>
                                    </div>
                                </template>

                                <button type="button" @click="addProject()"
                                        class="w-full py-2 bg-white hover:bg-neutral-50 border border-neutral-200 rounded-md text-xs font-medium text-neutral-700 transition-colors cursor-pointer">
                                    + Tambah Proyek
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- 7. SECTION: SERTIFIKASI --}}
                    <div>
                        <button type="button" @click="activeSection = (activeSection === 'certifications' ? '' : 'certifications')"
                                class="w-full px-5 py-3.5 bg-white hover:bg-neutral-50 flex items-center justify-between text-left transition-colors cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <span class="text-[11px] font-mono text-neutral-400">07</span>
                                <span class="text-xs font-semibold text-neutral-900">Sertifikasi & Lisensi</span>
                                <span class="text-[11px] text-neutral-400 font-normal" x-text="'(' + cv.certifications.length + ')'"></span>
                            </div>
                            <span class="text-xs text-neutral-400 font-mono" x-text="activeSection === 'certifications' ? '−' : '+'"></span>
                        </button>

                        <div x-show="activeSection === 'certifications'" x-collapse>
                            <div class="p-5 pt-2 space-y-3.5 bg-neutral-50/50">
                                <template x-for="(cert, cIdx) in cv.certifications" :key="cert.id || cIdx">
                                    <div class="p-3.5 bg-white border border-neutral-200 rounded-lg space-y-2">
                                        <div class="flex items-center justify-between pb-1.5 border-b border-neutral-100">
                                            <span class="text-xs font-medium text-neutral-700" x-text="'Sertifikat #' + (cIdx + 1)"></span>
                                            <button type="button" @click="removeCertification(cIdx)" class="text-[11px] text-neutral-400 hover:text-rose-600 transition-colors cursor-pointer">Hapus</button>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                                            <input type="text" x-model="cert.name" placeholder="Nama Sertifikat" class="text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white col-span-2">
                                            <input type="text" x-model="cert.year" placeholder="Tahun (e.g. 2024)" class="text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white">
                                        </div>
                                        <input type="text" x-model="cert.issuer" placeholder="Penerbit (e.g. AWS, Google)" class="w-full text-xs rounded-md border border-neutral-200 focus:border-neutral-900 focus:ring-0 py-1.5 px-2.5 bg-white">
                                    </div>
                                </template>
                                
                                <button type="button" @click="addCertification()"
                                        class="w-full py-2 bg-white hover:bg-neutral-50 border border-neutral-200 rounded-md text-xs font-medium text-neutral-700 transition-colors cursor-pointer">
                                    + Tambah Sertifikat
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </aside>

            {{-- ----------------------------------------------------------------- --}}
            {{-- PANEL KANAN: Canvas Dokumen A4 Realistis (Live Preview) --}}
            {{-- ----------------------------------------------------------------- --}}
            <section class="preview-canvas flex-1 bg-neutral-100 p-4 sm:p-8 lg:p-10 overflow-y-auto custom-scrollbar flex flex-col items-center justify-start relative"
                     :class="mobileTab === 'preview' ? 'flex' : 'hidden lg:flex'">
                
                {{-- Clean Minimalist Zoom Toolbar --}}
                <div class="preview-toolbar no-print sticky top-0 mb-4 z-20 bg-white/95 backdrop-blur-sm border border-neutral-200 rounded-full px-3 py-1 shadow-xs flex items-center gap-3 text-xs text-neutral-600">
                    <span class="font-medium text-neutral-500 text-[11px]">A4</span>
                    <div class="flex items-center gap-1 border-l pl-2.5 border-neutral-200 font-mono text-[11px]">
                        <button type="button" @click="zoomLevel = Math.max(60, zoomLevel - 10)" class="w-5 h-5 rounded hover:bg-neutral-100 flex items-center justify-center text-neutral-700 cursor-pointer">−</button>
                        <span class="w-10 text-center font-semibold" x-text="zoomLevel + '%'"></span>
                        <button type="button" @click="zoomLevel = Math.min(130, zoomLevel + 10)" class="w-5 h-5 rounded hover:bg-neutral-100 flex items-center justify-center text-neutral-700 cursor-pointer">+</button>
                        <button type="button" @click="zoomLevel = 100" class="ml-1 text-[10px] text-neutral-400 hover:text-neutral-900 cursor-pointer font-sans">Reset</button>
                    </div>
                </div>

                {{-- Page Overflow Warning Banner (Minimalist) --}}
                <div x-show="isPageOverflowing" x-cloak
                     class="no-print max-w-2xl w-full mb-3 px-3.5 py-2 rounded-lg bg-amber-50/90 border border-amber-200 text-amber-900 text-xs flex items-center justify-between gap-2">
                    <span><strong>Perhatian:</strong> Konten CV berpotensi melewati 1 lembar A4. Gunakan ukuran font <strong>10pt</strong> atau template <strong>Compact</strong> agar tetap 1 halaman.</span>
                    <button type="button" @click="docFontSize = 'doc-size-sm'" class="text-[11px] font-semibold text-amber-950 underline whitespace-nowrap cursor-pointer">
                        Ubah ke 10pt
                    </button>
                </div>

                {{-- The Real A4 Sheet Container --}}
                <div id="cv-sheet"
                     class="a4-sheet shadow-lg shadow-neutral-900/5 border border-neutral-200/80 transition-transform origin-top"
                     :class="[ 'font-' + selectedFont, docFontSize ]"
                     :style="'transform: scale(' + (zoomLevel / 100) + ')'">
                    
                    {{-- Template 1: The Classic Executive --}}
                    <div x-show="selectedTemplate === 'classic'">
                        @include('components.cv-templates.classic')
                    </div>

                    {{-- Template 2: Modern Minimalist --}}
                    <div x-show="selectedTemplate === 'modern'" x-cloak>
                        @include('components.cv-templates.modern')
                    </div>

                    {{-- Template 3: Tech & Engineering Specialist --}}
                    <div x-show="selectedTemplate === 'tech'" x-cloak>
                        @include('components.cv-templates.tech')
                    </div>

                    {{-- Template 4: Compact One-Pager --}}
                    <div x-show="selectedTemplate === 'compact'" x-cloak>
                        @include('components.cv-templates.compact')
                    </div>

                    {{-- Template 5: Academic & Ivy League --}}
                    <div x-show="selectedTemplate === 'academic'" x-cloak>
                        @include('components.cv-templates.academic')
                    </div>
                </div>
            </section>
        </main>

        {{-- ================================================================= --}}
        {{-- MODAL: BANK KATA KERJA AKTIF (ACTION VERBS) --}}
        {{-- ================================================================= --}}
        <div x-show="showActionVerbsModal" x-cloak class="relative z-50">
            <div class="fixed inset-0 bg-neutral-950/40 backdrop-blur-xs transition-opacity" @click="showActionVerbsModal = false"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto flex items-center justify-center p-4">
                <div class="w-full max-w-lg bg-white rounded-xl shadow-xl border border-neutral-200 p-6 space-y-4" @click.away="showActionVerbsModal = false">
                    <div class="flex items-center justify-between pb-3 border-b border-neutral-100">
                        <div>
                            <h3 class="text-sm font-semibold text-neutral-900">Kata Kerja Kuat (Action Verbs)</h3>
                            <p class="text-xs text-neutral-500 mt-0.5">Gunakan kata kerja aktif berikut pada poin pencapaian kerja.</p>
                        </div>
                        <button type="button" @click="showActionVerbsModal = false" class="text-neutral-400 hover:text-neutral-700 text-sm cursor-pointer">✕</button>
                    </div>

                    <div class="space-y-3.5 text-xs">
                        <div>
                            <h4 class="font-medium text-neutral-600 uppercase tracking-wide text-[10px] mb-1.5">Teknis & Rekayasa</h4>
                            <div class="flex flex-wrap gap-1.5">
                                <span class="px-2 py-1 rounded bg-neutral-100 text-neutral-800">Merancang (Designed)</span>
                                <span class="px-2 py-1 rounded bg-neutral-100 text-neutral-800">Membangun (Built)</span>
                                <span class="px-2 py-1 rounded bg-neutral-100 text-neutral-800">Mengembangkan (Developed)</span>
                                <span class="px-2 py-1 rounded bg-neutral-100 text-neutral-800">Mengoptimalkan (Optimized)</span>
                                <span class="px-2 py-1 rounded bg-neutral-100 text-neutral-800">Mengintegrasikan (Integrated)</span>
                                <span class="px-2 py-1 rounded bg-neutral-100 text-neutral-800">Mengotomatisasi (Automated)</span>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-medium text-neutral-600 uppercase tracking-wide text-[10px] mb-1.5">Kepemimpinan & Manajemen</h4>
                            <div class="flex flex-wrap gap-1.5">
                                <span class="px-2 py-1 rounded bg-neutral-100 text-neutral-800">Memimpin (Led)</span>
                                <span class="px-2 py-1 rounded bg-neutral-100 text-neutral-800">Mengoordinasikan (Coordinated)</span>
                                <span class="px-2 py-1 rounded bg-neutral-100 text-neutral-800">Mengarahkan (Directed)</span>
                                <span class="px-2 py-1 rounded bg-neutral-100 text-neutral-800">Mendelegasikan (Delegated)</span>
                                <span class="px-2 py-1 rounded bg-neutral-100 text-neutral-800">Membimbing (Mentored)</span>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-medium text-neutral-600 uppercase tracking-wide text-[10px] mb-1.5">Hasil & Pertumbuhan</h4>
                            <div class="flex flex-wrap gap-1.5">
                                <span class="px-2 py-1 rounded bg-neutral-100 text-neutral-800">Meningkatkan (Increased)</span>
                                <span class="px-2 py-1 rounded bg-neutral-100 text-neutral-800">Mengurangi (Reduced)</span>
                                <span class="px-2 py-1 rounded bg-neutral-100 text-neutral-800">Memaksimalkan (Maximized)</span>
                                <span class="px-2 py-1 rounded bg-neutral-100 text-neutral-800">Mencapai (Attained)</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-neutral-100 flex justify-end">
                        <button type="button" @click="showActionVerbsModal = false" class="px-3.5 py-1.5 bg-neutral-900 hover:bg-neutral-800 text-white font-medium text-xs rounded-md cursor-pointer">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================================================================= --}}
        {{-- MODAL: AUDIT KELAYAKAN ATS & CHECKLIST REKOMENDASI --}}
        {{-- ================================================================= --}}
        <div x-show="showAtsAuditModal" x-cloak class="relative z-50">
            <div class="fixed inset-0 bg-neutral-950/40 backdrop-blur-xs transition-opacity" @click="showAtsAuditModal = false"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto flex items-center justify-center p-4">
                <div class="w-full max-w-xl bg-white rounded-xl shadow-xl border border-neutral-200 overflow-hidden flex flex-col max-h-[85vh]" @click.away="showAtsAuditModal = false">
                    
                    {{-- Modal Header --}}
                    <div class="p-5 border-b border-neutral-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center font-bold text-sm bg-neutral-100 text-neutral-900"
                                 x-text="atsScore + '%'"></div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="text-sm font-semibold text-neutral-900">Audit Skor ATS</h3>
                                    <span class="text-[11px] font-medium text-neutral-500" x-text="'(' + atsBadge.label + ')'"></span>
                                </div>
                                <p class="text-xs text-neutral-400 mt-0.5">Pemeriksaan struktur dokumen, kelengkapan kontak, dan kata kerja aktif.</p>
                            </div>
                        </div>
                        <button type="button" @click="showAtsAuditModal = false" class="text-neutral-400 hover:text-neutral-700 text-sm cursor-pointer p-1">✕</button>
                    </div>

                    {{-- Modal Body --}}
                    <div class="p-5 space-y-4 overflow-y-auto custom-scrollbar flex-1 text-xs">
                        <template x-for="(cat, cIdx) in atsAudit.categories" :key="cIdx">
                            <div class="p-3.5 bg-neutral-50 border border-neutral-200/80 rounded-lg space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-neutral-900 text-xs" x-text="cat.name"></span>
                                    <span class="text-neutral-500 text-[11px]" x-text="cat.earned + ' / ' + cat.max + ' poin'"></span>
                                </div>

                                {{-- Category Progress Bar --}}
                                <div class="w-full h-1 bg-neutral-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-neutral-900 rounded-full transition-all duration-300"
                                         :style="'width: ' + cat.pct + '%'"></div>
                                </div>

                                {{-- Items --}}
                                <div class="space-y-1.5 pt-1">
                                    <template x-for="(item, iIdx) in cat.items" :key="iIdx">
                                        <div class="flex items-start justify-between gap-3 p-2 bg-white rounded border border-neutral-200/60">
                                            <div class="flex items-start gap-2">
                                                <span class="text-[11px] mt-0.5" :class="item.passed ? 'text-emerald-600' : 'text-neutral-400'" x-text="item.passed ? '✓' : '—'"></span>
                                                <div>
                                                    <span class="font-medium text-neutral-800 block text-xs" x-text="item.title"></span>
                                                    <span class="text-[11px] text-neutral-400" x-text="item.tip"></span>
                                                </div>
                                            </div>

                                            <template x-if="!item.passed">
                                                <button type="button" @click="jumpToSection(item.section)"
                                                        class="shrink-0 text-[11px] font-medium text-neutral-600 hover:text-neutral-900 underline cursor-pointer">
                                                    Perbaiki
                                                </button>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>

                    {{-- Modal Footer --}}
                    <div class="p-4 bg-neutral-50 border-t border-neutral-100 flex items-center justify-between">
                        <span class="text-[11px] text-neutral-400">Target skor minimal yang disarankan: <strong>80%+</strong>.</span>
                        <button type="button" @click="showAtsAuditModal = false"
                                class="px-3.5 py-1.5 bg-neutral-900 hover:bg-neutral-800 text-white font-medium text-xs rounded-md cursor-pointer">
                            Selesai
                        </button>
                    </div>

                </div>
            </div>
        </div>

        {{-- ================================================================= --}}
        {{-- MOBILE STICKY BOTTOM SWITCH BAR --}}
        {{-- ================================================================= --}}
        <div class="mobile-tab-bar no-print lg:hidden fixed bottom-0 inset-x-0 z-50 bg-white border-t border-neutral-200 px-4 py-2 flex items-center justify-between gap-3">
            <div class="flex items-center p-1 bg-neutral-100 rounded-md flex-1">
                <button type="button" @click="mobileTab = 'form'"
                        :class="mobileTab === 'form' ? 'bg-white text-neutral-900 font-semibold shadow-2xs' : 'text-neutral-500 font-medium'"
                        class="flex-1 py-1.5 text-xs text-center rounded transition-all cursor-pointer">
                    Editor Form
                </button>
                <button type="button" @click="mobileTab = 'preview'"
                        :class="mobileTab === 'preview' ? 'bg-white text-neutral-900 font-semibold shadow-2xs' : 'text-neutral-500 font-medium'"
                        class="flex-1 py-1.5 text-xs text-center rounded transition-all cursor-pointer">
                    Pratinjau A4
                </button>
            </div>

            <button type="button" @click="printCv()"
                    class="px-3 py-2 text-xs font-medium text-white bg-neutral-900 hover:bg-neutral-800 rounded-md cursor-pointer">
                Cetak
            </button>
        </div>

    </div>
</x-layouts.app>
