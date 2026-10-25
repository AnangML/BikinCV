<x-layouts.app>
    <div x-data="cvEditor()" class="min-h-screen flex flex-col bg-slate-100">
        
        {{-- ================================================================= --}}
        {{-- TOP NAVIGATION BAR (Modern SaaS Style) --}}
        {{-- ================================================================= --}}
        <header class="no-print sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-xs">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">
                
                {{-- Left: Logo & Autosave Status --}}
                <div class="flex items-center gap-3 shrink-0">
                    <a href="{{ route('cv.editor') }}" class="flex items-center gap-2 group">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="text-lg font-extrabold tracking-tight bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">Bikin<span class="text-indigo-600">CV</span></span>
                            <span class="hidden sm:inline-block ml-1.5 px-2 py-0.5 text-[10px] font-bold tracking-wider uppercase rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200/60">ATS 100%</span>
                        </div>
                    </a>

                    {{-- Autosave Indicator --}}
                    <div class="hidden md:flex items-center gap-1.5 ml-3 pl-3 border-l border-slate-200 text-xs text-slate-500 font-medium">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span x-text="saveStatusText"></span>
                    </div>
                </div>

                {{-- Center: Controls (Template, Font, Size) --}}
                <div class="hidden lg:flex items-center gap-2.5">
                    {{-- Font Selector --}}
                    <div class="flex items-center gap-1.5 text-xs bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-1.5 shadow-2xs">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                        <select x-model="selectedFont" class="bg-transparent border-none text-xs font-semibold text-slate-700 focus:ring-0 cursor-pointer p-0 pr-6">
                            <optgroup label="Modern Sans-Serif">
                                <option value="inter">Inter (Default)</option>
                                <option value="roboto">Roboto</option>
                                <option value="jakarta">Plus Jakarta Sans</option>
                                <option value="arial">Arial Standard</option>
                            </optgroup>
                            <optgroup label="Formal Serif">
                                <option value="merriweather">Merriweather</option>
                                <option value="georgia">Georgia</option>
                                <option value="garamond">Garamond</option>
                            </optgroup>
                        </select>
                    </div>

                    {{-- Font Size Selector --}}
                    <div class="flex items-center gap-1.5 text-xs bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-1.5 shadow-2xs">
                        <span class="text-slate-400 font-bold">Aa</span>
                        <select x-model="docFontSize" class="bg-transparent border-none text-xs font-semibold text-slate-700 focus:ring-0 cursor-pointer p-0 pr-6">
                            <option value="doc-size-sm">Kecil (10pt)</option>
                            <option value="doc-size-base">Normal (11pt)</option>
                            <option value="doc-size-lg">Besar (12pt)</option>
                        </select>
                    </div>

                    {{-- Accent Color Selector --}}
                    <div class="flex items-center gap-1.5 pl-1">
                        <button type="button" @click="accentColor = '#111827'" 
                                :class="accentColor === '#111827' ? 'ring-2 ring-indigo-500 ring-offset-1' : ''"
                                class="w-4 h-4 rounded-full bg-slate-900 transition-all cursor-pointer" title="Hitam Klasik"></button>
                        <button type="button" @click="accentColor = '#1e3a8a'" 
                                :class="accentColor === '#1e3a8a' ? 'ring-2 ring-indigo-500 ring-offset-1' : ''"
                                class="w-4 h-4 rounded-full bg-blue-900 transition-all cursor-pointer" title="Midnight Navy"></button>
                        <button type="button" @click="accentColor = '#334155'" 
                                :class="accentColor === '#334155' ? 'ring-2 ring-indigo-500 ring-offset-1' : ''"
                                class="w-4 h-4 rounded-full bg-slate-700 transition-all cursor-pointer" title="Slate Charcoal"></button>
                        <button type="button" @click="accentColor = '#14532d'" 
                                :class="accentColor === '#14532d' ? 'ring-2 ring-indigo-500 ring-offset-1' : ''"
                                class="w-4 h-4 rounded-full bg-emerald-900 transition-all cursor-pointer" title="Forest Green"></button>
                    </div>
                </div>

                {{-- Right: Actions (Demo, ATS Gauge, Print PDF) --}}
                <div class="flex items-center gap-2 sm:gap-3">
                    {{-- Load Demo Data Button --}}
                    <button type="button" @click="loadDemoData()"
                            class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 border border-slate-300/80 rounded-lg transition-colors cursor-pointer"
                            title="Isi form otomatis dengan contoh CV profesional">
                        <svg class="w-3.5 h-3.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                        <span>Isi Contoh Data</span>
                    </button>

                    {{-- ATS Score Badge --}}
                    <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-lg border bg-white shadow-2xs"
                         :class="atsScore >= 80 ? 'border-emerald-200 bg-emerald-50/50' : (atsScore >= 50 ? 'border-amber-200 bg-amber-50/50' : 'border-rose-200 bg-rose-50/50')">
                        <div class="w-2 h-2 rounded-full" :class="atsBadge.bg"></div>
                        <span class="text-xs font-bold text-slate-800">
                            Skor ATS: <span :class="atsScore >= 80 ? 'text-emerald-700' : (atsScore >= 50 ? 'text-amber-700' : 'text-rose-700')" x-text="atsScore + '%'"></span>
                        </span>
                    </div>

                    {{-- Primary CTA: Download PDF Button --}}
                    <button type="button" @click="printCv()"
                            class="inline-flex items-center gap-2 px-3.5 sm:px-4 py-2 text-xs sm:text-sm font-bold text-white bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 active:scale-98 rounded-lg shadow-md shadow-indigo-600/25 transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        <span>Unduh PDF</span>
                    </button>
                </div>
            </div>
        </header>

        {{-- ================================================================= --}}
        {{-- MAIN SPLIT SCREEN (Form di Kiri, A4 Preview di Kanan) --}}
        {{-- ================================================================= --}}
        <main class="flex-1 flex overflow-hidden">
            
            {{-- ----------------------------------------------------------------- --}}
            {{-- PANEL KIRI: Form Editor Interaktif (Progressive Accordion) --}}
            {{-- ----------------------------------------------------------------- --}}
            <aside class="w-full lg:w-[48%] xl:w-[44%] bg-white border-r border-slate-200 overflow-y-auto custom-scrollbar flex flex-col"
                   :class="mobileTab === 'form' ? 'block' : 'hidden lg:flex'">
                
                {{-- Form Header & Quick Tools (Import/Export JSON, Reset) --}}
                <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/70 flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h2 class="text-sm font-bold text-slate-900">Formulir Informasi CV</h2>
                        <p class="text-[11px] text-slate-500 mt-0.5">Semua data tersinkronisasi instan ke preview lembar A4.</p>
                    </div>

                    <div class="flex items-center gap-2.5">
                        {{-- Import JSON --}}
                        <label class="text-xs text-slate-600 hover:text-indigo-600 font-semibold inline-flex items-center gap-1 cursor-pointer bg-white px-2 py-1 rounded-md border border-slate-200 shadow-2xs hover:bg-slate-50" title="Impor file backup .json">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            <span>Impor</span>
                            <input type="file" accept=".json" @change="importJson($event)" class="hidden">
                        </label>

                        {{-- Export JSON --}}
                        <button type="button" @click="exportJson()" class="text-xs text-slate-600 hover:text-indigo-600 font-semibold inline-flex items-center gap-1 cursor-pointer bg-white px-2 py-1 rounded-md border border-slate-200 shadow-2xs hover:bg-slate-50" title="Unduh backup data .json">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            <span>Ekspor</span>
                        </button>

                        <button type="button" @click="resetForm()" class="text-xs text-rose-600 hover:text-rose-700 font-semibold hover:underline cursor-pointer pl-1">
                            Reset
                        </button>
                    </div>
                </div>

                {{-- Accordion Sections --}}
                <div class="p-4 sm:p-6 space-y-3 flex-1">
                    
                    {{-- 1. SECTION: DATA DIRI & KONTAK --}}
                    <div class="border border-slate-200 rounded-xl overflow-hidden bg-white shadow-2xs">
                        <button type="button" @click="activeSection = (activeSection === 'personal' ? '' : 'personal')"
                                class="w-full px-4 py-3 bg-slate-50 hover:bg-slate-100/80 flex items-center justify-between text-left transition-colors cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs">1</div>
                                <div>
                                    <span class="text-sm font-bold text-slate-800">Data Diri & Kontak</span>
                                    <span class="text-[11px] text-slate-500 block">Nama, email, telepon, domisili, link LinkedIn</span>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="activeSection === 'personal' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="activeSection === 'personal'" x-collapse>
                            <div class="p-4 sm:p-5 space-y-3.5 border-t border-slate-100">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap *</label>
                                        <input type="text" x-model="cv.personal.fullName" placeholder="misal: Budi Pratama, S.Kom"
                                               class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1">Target Posisi / Jabatan *</label>
                                        <input type="text" x-model="cv.personal.jobTitle" placeholder="misal: Full Stack Developer"
                                               class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1">Email Aktif *</label>
                                        <input type="email" x-model="cv.personal.email" placeholder="nama@email.com"
                                               class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor WhatsApp *</label>
                                        <input type="text" x-model="cv.personal.phone" placeholder="+62 812-xxxx-xxxx"
                                               class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1">Domisili *</label>
                                        <input type="text" x-model="cv.personal.location" placeholder="Jakarta, Indonesia"
                                               class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1">URL LinkedIn</label>
                                        <input type="text" x-model="cv.personal.linkedin" placeholder="linkedin.com/in/username"
                                               class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1">GitHub / Portfolio</label>
                                        <input type="text" x-model="cv.personal.github" placeholder="github.com/username"
                                               class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1">Website Pribadi</label>
                                        <input type="text" x-model="cv.personal.website" placeholder="namadomain.com"
                                               class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2. SECTION: RINGKASAN PROFIL (SUMMARY) --}}
                    <div class="border border-slate-200 rounded-xl overflow-hidden bg-white shadow-2xs">
                        <button type="button" @click="activeSection = (activeSection === 'summary' ? '' : 'summary')"
                                class="w-full px-4 py-3 bg-slate-50 hover:bg-slate-100/80 flex items-center justify-between text-left transition-colors cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs">2</div>
                                <div>
                                    <span class="text-sm font-bold text-slate-800">Ringkasan Profil (Summary)</span>
                                    <span class="text-[11px] text-slate-500 block">2–3 kalimat pengantar keahlian utama</span>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="activeSection === 'summary' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="activeSection === 'summary'" x-collapse>
                            <div class="p-4 sm:p-5 space-y-2 border-t border-slate-100">
                                <textarea x-model="cv.personal.summary" rows="4"
                                          placeholder="Tuliskan pengalaman bertahun-tahun, bidang spesialisasi, dan pencapaian terbesarmu..."
                                          class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                
                                <div class="flex items-center justify-between text-[11px] text-slate-500">
                                    <span>💡 Tips ATS: Gunakan formula <em>"Pengalaman X tahun dalam [Bidang], terbukti mencapai [Hasil/Metrik]"</em>.</span>
                                    <span x-text="(cv.personal.summary ? cv.personal.summary.length : 0) + ' karakter'"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 3. SECTION: PENGALAMAN KERJA (EXPERIENCES) --}}
                    <div class="border border-slate-200 rounded-xl overflow-hidden bg-white shadow-2xs">
                        <button type="button" @click="activeSection = (activeSection === 'experience' ? '' : 'experience')"
                                class="w-full px-4 py-3 bg-slate-50 hover:bg-slate-100/80 flex items-center justify-between text-left transition-colors cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs">3</div>
                                <div>
                                    <span class="text-sm font-bold text-slate-800">Pengalaman Kerja</span>
                                    <span class="text-[11px] text-slate-500 block" x-text="cv.experiences.length + ' pengalaman ditambahkan'"></span>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="activeSection === 'experience' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="activeSection === 'experience'" x-collapse>
                            <div class="p-4 sm:p-5 space-y-4 border-t border-slate-100">
                                <div class="flex items-center justify-between">
                                    <button type="button" @click="showActionVerbsModal = true"
                                            class="text-xs text-indigo-600 hover:text-indigo-800 font-bold inline-flex items-center gap-1 cursor-pointer">
                                        <span>💡 Bank Kata Kerja Aktif (Action Verbs)</span>
                                    </button>
                                </div>

                                <template x-for="(exp, expIdx) in cv.experiences" :key="exp.id || expIdx">
                                    <div class="p-3.5 bg-slate-50/80 border border-slate-200/90 rounded-xl space-y-3 relative group">
                                        <div class="flex items-center justify-between pb-2 border-b border-slate-200/60">
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs font-bold text-slate-700" x-text="'Pekerjaan #' + (expIdx + 1)"></span>
                                                
                                                {{-- Reorder Buttons --}}
                                                <div class="flex items-center gap-0.5 ml-1">
                                                    <button type="button" @click="moveExperience(expIdx, -1)" :disabled="expIdx === 0"
                                                            class="p-1 rounded hover:bg-slate-200 disabled:opacity-30 disabled:cursor-not-allowed text-slate-600 transition-colors" title="Pindah ke Atas">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"></path></svg>
                                                    </button>
                                                    <button type="button" @click="moveExperience(expIdx, 1)" :disabled="expIdx === cv.experiences.length - 1"
                                                            class="p-1 rounded hover:bg-slate-200 disabled:opacity-30 disabled:cursor-not-allowed text-slate-600 transition-colors" title="Pindah ke Bawah">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <button type="button" @click="removeExperience(expIdx)"
                                                    class="text-xs text-rose-500 hover:text-rose-700 font-semibold cursor-pointer">Hapus</button>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                            <div>
                                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Posisi / Jabatan</label>
                                                <input type="text" x-model="exp.position" placeholder="Frontend Developer"
                                                       class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>
                                            <div>
                                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Nama Perusahaan</label>
                                                <input type="text" x-model="exp.company" placeholder="PT Maju Bersama"
                                                       class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                                            <div>
                                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Mulai Bekerja</label>
                                                <input type="text" x-model="exp.startDate" placeholder="Jan 2022"
                                                       class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>
                                            <div>
                                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Selesai</label>
                                                <input type="text" x-model="exp.endDate" :disabled="exp.isCurrent" placeholder="Des 2023"
                                                       class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 disabled:bg-slate-100 disabled:text-slate-400">
                                            </div>
                                            <div>
                                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Lokasi</label>
                                                <input type="text" x-model="exp.location" placeholder="Jakarta (Remote)"
                                                       class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" :id="'current_' + expIdx" x-model="exp.isCurrent" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                                            <label :for="'current_' + expIdx" class="text-xs text-slate-600 font-medium cursor-pointer">Saya masih bekerja di posisi ini</label>
                                        </div>

                                        {{-- Bullet Points --}}
                                        <div class="space-y-1.5 pt-1">
                                            <label class="block text-[11px] font-semibold text-slate-700">Tanggung Jawab & Pencapaian (Poin-poin)</label>
                                            <template x-for="(bullet, bIdx) in exp.bullets" :key="bIdx">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-slate-400 text-xs">•</span>
                                                    <input type="text" x-model="exp.bullets[bIdx]" placeholder="Meningkatkan throughput sistem sebesar 30%..."
                                                           class="flex-1 text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                                    <button type="button" @click="removeBullet(expIdx, bIdx)" class="text-slate-400 hover:text-rose-500 text-xs font-bold px-1 cursor-pointer">✕</button>
                                                </div>
                                            </template>
                                            <button type="button" @click="addBullet(expIdx)"
                                                    class="text-xs text-indigo-600 hover:text-indigo-700 font-semibold inline-flex items-center gap-1 mt-1 cursor-pointer">
                                                + Tambah Poin
                                            </button>
                                        </div>
                                    </div>
                                </template>

                                <button type="button" @click="addExperience()"
                                        class="w-full py-2.5 border-2 border-dashed border-indigo-200 hover:border-indigo-400 hover:bg-indigo-50/50 rounded-xl text-xs font-bold text-indigo-700 transition-colors flex items-center justify-center gap-1.5 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <span>Tambah Pengalaman Kerja</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- 4. SECTION: PENDIDIKAN (EDUCATIONS) --}}
                    <div class="border border-slate-200 rounded-xl overflow-hidden bg-white shadow-2xs">
                        <button type="button" @click="activeSection = (activeSection === 'education' ? '' : 'education')"
                                class="w-full px-4 py-3 bg-slate-50 hover:bg-slate-100/80 flex items-center justify-between text-left transition-colors cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs">4</div>
                                <div>
                                    <span class="text-sm font-bold text-slate-800">Riwayat Pendidikan</span>
                                    <span class="text-[11px] text-slate-500 block" x-text="cv.educations.length + ' riwayat pendidikan ditambahkan'"></span>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="activeSection === 'education' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="activeSection === 'education'" x-collapse>
                            <div class="p-4 sm:p-5 space-y-4 border-t border-slate-100">
                                <template x-for="(edu, eduIdx) in cv.educations" :key="edu.id || eduIdx">
                                    <div class="p-3.5 bg-slate-50/80 border border-slate-200/90 rounded-xl space-y-3 relative">
                                        <div class="flex items-center justify-between pb-2 border-b border-slate-200/60">
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs font-bold text-slate-700" x-text="'Pendidikan #' + (eduIdx + 1)"></span>
                                                {{-- Reorder Buttons --}}
                                                <div class="flex items-center gap-0.5 ml-1">
                                                    <button type="button" @click="moveEducation(eduIdx, -1)" :disabled="eduIdx === 0"
                                                            class="p-1 rounded hover:bg-slate-200 disabled:opacity-30 disabled:cursor-not-allowed text-slate-600 transition-colors" title="Pindah ke Atas">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"></path></svg>
                                                    </button>
                                                    <button type="button" @click="moveEducation(eduIdx, 1)" :disabled="eduIdx === cv.educations.length - 1"
                                                            class="p-1 rounded hover:bg-slate-200 disabled:opacity-30 disabled:cursor-not-allowed text-slate-600 transition-colors" title="Pindah ke Bawah">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <button type="button" @click="removeEducation(eduIdx)" class="text-xs text-rose-500 hover:text-rose-700 font-semibold cursor-pointer">Hapus</button>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                            <div>
                                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Nama Universitas / Sekolah</label>
                                                <input type="text" x-model="edu.institution" placeholder="Universitas Indonesia"
                                                       class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>
                                            <div>
                                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Gelar / Jurusan</label>
                                                <input type="text" x-model="edu.degree" placeholder="S1 Teknik Informatika"
                                                       class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                                            <div>
                                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Tahun Mulai</label>
                                                <input type="text" x-model="edu.startDate" placeholder="2018"
                                                       class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>
                                            <div>
                                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Tahun Lulus</label>
                                                <input type="text" x-model="edu.endDate" placeholder="2022"
                                                       class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>
                                            <div>
                                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">IPK / GPA (Opsional)</label>
                                                <input type="text" x-model="edu.gpa" placeholder="3.80 / 4.00"
                                                       class="w-full text-xs rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <button type="button" @click="addEducation()"
                                        class="w-full py-2.5 border-2 border-dashed border-indigo-200 hover:border-indigo-400 hover:bg-indigo-50/50 rounded-xl text-xs font-bold text-indigo-700 transition-colors flex items-center justify-center gap-1.5 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <span>Tambah Pendidikan</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- 5. SECTION: SKILLS / KEAHLIAN --}}
                    <div class="border border-slate-200 rounded-xl overflow-hidden bg-white shadow-2xs">
                        <button type="button" @click="activeSection = (activeSection === 'skills' ? '' : 'skills')"
                                class="w-full px-4 py-3 bg-slate-50 hover:bg-slate-100/80 flex items-center justify-between text-left transition-colors cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs">5</div>
                                <div>
                                    <span class="text-sm font-bold text-slate-800">Keahlian (Skills & Tools)</span>
                                    <span class="text-[11px] text-slate-500 block">Ketik skill lalu tekan Enter</span>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="activeSection === 'skills' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="activeSection === 'skills'" x-collapse>
                            <div class="p-4 sm:p-5 space-y-4 border-t border-slate-100">
                                
                                {{-- Languages --}}
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Bahasa Pemrograman / Inti</label>
                                    <div class="flex flex-wrap items-center gap-1.5 p-2 bg-slate-50 border border-slate-200 rounded-lg min-h-[42px]">
                                        <template x-for="(skill, sIdx) in cv.skills.languages" :key="sIdx">
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-white border border-slate-300 text-xs font-medium text-slate-700 shadow-2xs">
                                                <span x-text="skill"></span>
                                                <button type="button" @click="removeSkillTag('languages', sIdx)" class="text-slate-400 hover:text-rose-500 font-bold cursor-pointer">×</button>
                                            </span>
                                        </template>
                                        <input type="text" @keydown.enter.prevent="addSkillTag('languages', $event)" placeholder="Ketik + tekan Enter..."
                                               class="flex-1 min-w-[120px] bg-transparent border-none text-xs focus:ring-0 p-1">
                                    </div>
                                </div>

                                {{-- Frameworks --}}
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Frameworks & Libraries</label>
                                    <div class="flex flex-wrap items-center gap-1.5 p-2 bg-slate-50 border border-slate-200 rounded-lg min-h-[42px]">
                                        <template x-for="(skill, sIdx) in cv.skills.frameworks" :key="sIdx">
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-white border border-slate-300 text-xs font-medium text-slate-700 shadow-2xs">
                                                <span x-text="skill"></span>
                                                <button type="button" @click="removeSkillTag('frameworks', sIdx)" class="text-slate-400 hover:text-rose-500 font-bold cursor-pointer">×</button>
                                            </span>
                                        </template>
                                        <input type="text" @keydown.enter.prevent="addSkillTag('frameworks', $event)" placeholder="Ketik + tekan Enter..."
                                               class="flex-1 min-w-[120px] bg-transparent border-none text-xs focus:ring-0 p-1">
                                    </div>
                                </div>

                                {{-- Databases & Tools --}}
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1">Databases</label>
                                        <div class="flex flex-wrap items-center gap-1.5 p-2 bg-slate-50 border border-slate-200 rounded-lg min-h-[42px]">
                                            <template x-for="(skill, sIdx) in cv.skills.databases" :key="sIdx">
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-white border border-slate-300 text-xs font-medium text-slate-700 shadow-2xs">
                                                    <span x-text="skill"></span>
                                                    <button type="button" @click="removeSkillTag('databases', sIdx)" class="text-slate-400 hover:text-rose-500 font-bold cursor-pointer">×</button>
                                                </span>
                                            </template>
                                            <input type="text" @keydown.enter.prevent="addSkillTag('databases', $event)" placeholder="Ketik + Enter..."
                                                   class="flex-1 min-w-[100px] bg-transparent border-none text-xs focus:ring-0 p-1">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1">Tools / Cloud</label>
                                        <div class="flex flex-wrap items-center gap-1.5 p-2 bg-slate-50 border border-slate-200 rounded-lg min-h-[42px]">
                                            <template x-for="(skill, sIdx) in cv.skills.tools" :key="sIdx">
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-white border border-slate-300 text-xs font-medium text-slate-700 shadow-2xs">
                                                    <span x-text="skill"></span>
                                                    <button type="button" @click="removeSkillTag('tools', sIdx)" class="text-slate-400 hover:text-rose-500 font-bold cursor-pointer">×</button>
                                                </span>
                                            </template>
                                            <input type="text" @keydown.enter.prevent="addSkillTag('tools', $event)" placeholder="Ketik + Enter..."
                                                   class="flex-1 min-w-[100px] bg-transparent border-none text-xs focus:ring-0 p-1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 6. SECTION: PROYEK UNGGULAN --}}
                    <div class="border border-slate-200 rounded-xl overflow-hidden bg-white shadow-2xs">
                        <button type="button" @click="activeSection = (activeSection === 'projects' ? '' : 'projects')"
                                class="w-full px-4 py-3 bg-slate-50 hover:bg-slate-100/80 flex items-center justify-between text-left transition-colors cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs">6</div>
                                <div>
                                    <span class="text-sm font-bold text-slate-800">Proyek Unggulan (Projects)</span>
                                    <span class="text-[11px] text-slate-500 block" x-text="cv.projects.length + ' proyek ditambahkan'"></span>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="activeSection === 'projects' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="activeSection === 'projects'" x-collapse>
                            <div class="p-4 sm:p-5 space-y-4 border-t border-slate-100">
                                <template x-for="(proj, projIdx) in cv.projects" :key="proj.id || projIdx">
                                    <div class="p-3.5 bg-slate-50/80 border border-slate-200/90 rounded-xl space-y-2.5 relative">
                                        <div class="flex items-center justify-between pb-2 border-b border-slate-200/60">
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs font-bold text-slate-700" x-text="'Proyek #' + (projIdx + 1)"></span>
                                                {{-- Reorder Buttons --}}
                                                <div class="flex items-center gap-0.5 ml-1">
                                                    <button type="button" @click="moveProject(projIdx, -1)" :disabled="projIdx === 0"
                                                            class="p-1 rounded hover:bg-slate-200 disabled:opacity-30 disabled:cursor-not-allowed text-slate-600 transition-colors" title="Pindah ke Atas">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"></path></svg>
                                                    </button>
                                                    <button type="button" @click="moveProject(projIdx, 1)" :disabled="projIdx === cv.projects.length - 1"
                                                            class="p-1 rounded hover:bg-slate-200 disabled:opacity-30 disabled:cursor-not-allowed text-slate-600 transition-colors" title="Pindah ke Bawah">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <button type="button" @click="removeProject(projIdx)" class="text-xs text-rose-500 hover:text-rose-700 font-semibold cursor-pointer">Hapus</button>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                            <div>
                                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Nama Proyek</label>
                                                <input type="text" x-model="proj.name" placeholder="misal: E-Commerce Mobile App" class="w-full text-xs rounded-lg border-slate-300">
                                            </div>
                                            <div>
                                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Peran / Role</label>
                                                <input type="text" x-model="proj.role" placeholder="misal: Lead Backend Developer" class="w-full text-xs rounded-lg border-slate-300">
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-[11px] font-semibold text-slate-600 mb-1">Link Repositori / Demo</label>
                                            <input type="text" x-model="proj.link" placeholder="github.com/username/project" class="w-full text-xs rounded-lg border-slate-300">
                                        </div>

                                        <div>
                                            <label class="block text-[11px] font-semibold text-slate-600 mb-1">Deskripsi Singkat & Dampak</label>
                                            <textarea x-model="proj.description" rows="2" placeholder="Jelaskan masalah yang diselesaikan dan teknologi yang dipakai..." class="w-full text-xs rounded-lg border-slate-300"></textarea>
                                        </div>
                                    </div>
                                </template>

                                <button type="button" @click="addProject()"
                                        class="w-full py-2.5 border-2 border-dashed border-indigo-200 hover:border-indigo-400 hover:bg-indigo-50/50 rounded-xl text-xs font-bold text-indigo-700 transition-colors flex items-center justify-center gap-1.5 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <span>Tambah Proyek</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- 7. SECTION: SERTIFIKASI --}}
                    <div class="border border-slate-200 rounded-xl overflow-hidden bg-white shadow-2xs">
                        <button type="button" @click="activeSection = (activeSection === 'certifications' ? '' : 'certifications')"
                                class="w-full px-4 py-3 bg-slate-50 hover:bg-slate-100/80 flex items-center justify-between text-left transition-colors cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs">7</div>
                                <div>
                                    <span class="text-sm font-bold text-slate-800">Sertifikasi & Lisensi</span>
                                    <span class="text-[11px] text-slate-500 block" x-text="cv.certifications.length + ' sertifikat ditambahkan'"></span>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="activeSection === 'certifications' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="activeSection === 'certifications'" x-collapse>
                            <div class="p-4 sm:p-5 space-y-4 border-t border-slate-100">
                                <template x-for="(cert, cIdx) in cv.certifications" :key="cert.id || cIdx">
                                    <div class="p-3.5 bg-slate-50/80 border border-slate-200/90 rounded-xl space-y-2">
                                        <div class="flex items-center justify-between pb-1.5 border-b border-slate-200/60">
                                            <span class="text-xs font-semibold text-slate-700" x-text="'Sertifikat #' + (cIdx + 1)"></span>
                                            <button type="button" @click="removeCertification(cIdx)" class="text-xs text-rose-500 hover:text-rose-700 font-bold cursor-pointer">Hapus</button>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                                            <input type="text" x-model="cert.name" placeholder="Nama Sertifikat" class="text-xs rounded-lg border-slate-300 col-span-2">
                                            <input type="text" x-model="cert.year" placeholder="Tahun (e.g. 2024)" class="text-xs rounded-lg border-slate-300">
                                        </div>
                                        <input type="text" x-model="cert.issuer" placeholder="Penerbit (e.g. Amazon Web Services)" class="w-full text-xs rounded-lg border-slate-300">
                                    </div>
                                </template>
                                
                                <button type="button" @click="addCertification()"
                                        class="w-full py-2.5 border-2 border-dashed border-indigo-200 hover:border-indigo-400 hover:bg-indigo-50/50 rounded-xl text-xs font-bold text-indigo-700 transition-colors flex items-center justify-center gap-1.5 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <span>Tambah Sertifikat</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </aside>

            {{-- ----------------------------------------------------------------- --}}
            {{-- PANEL KANAN: Canvas Dokumen A4 Realistis (Live Preview) --}}
            {{-- ----------------------------------------------------------------- --}}
            <section class="preview-canvas flex-1 bg-slate-200/70 p-4 sm:p-8 lg:p-12 overflow-y-auto custom-scrollbar flex flex-col items-center justify-start relative"
                     :class="mobileTab === 'preview' ? 'flex' : 'hidden lg:flex'">
                
                {{-- Floating Top-Right Zoom & Fit Toolbar --}}
                <div class="preview-toolbar no-print sticky top-0 mb-4 z-20 bg-white/90 backdrop-blur-md border border-slate-300/80 rounded-xl px-3 py-1.5 shadow-md flex items-center gap-3 text-xs text-slate-700">
                    <span class="font-semibold text-slate-500">Pratinjau A4</span>
                    <div class="flex items-center gap-1 border-l pl-3 border-slate-200">
                        <button type="button" @click="zoomLevel = Math.max(60, zoomLevel - 10)" class="w-6 h-6 rounded hover:bg-slate-100 flex items-center justify-center font-bold text-slate-600 cursor-pointer">-</button>
                        <span class="w-12 text-center font-bold" x-text="zoomLevel + '%'"></span>
                        <button type="button" @click="zoomLevel = Math.min(130, zoomLevel + 10)" class="w-6 h-6 rounded hover:bg-slate-100 flex items-center justify-center font-bold text-slate-600 cursor-pointer">+</button>
                        <button type="button" @click="zoomLevel = 100" class="ml-1 text-[11px] text-indigo-600 hover:underline cursor-pointer">Reset</button>
                    </div>
                </div>

                {{-- The Real A4 Sheet Container --}}
                <div id="cv-sheet"
                     class="a4-sheet shadow-2xl ring-1 ring-slate-900/10 transition-transform origin-top"
                     :class="[ 'font-' + selectedFont, docFontSize ]"
                     :style="'transform: scale(' + (zoomLevel / 100) + ')'">
                    
                    {{-- Render Template 1: The Classic Executive --}}
                    @include('components.cv-templates.classic')
                </div>
            </section>
        </main>

        {{-- ================================================================= --}}
        {{-- MODAL: BANK KATA KERJA AKTIF (ACTION VERBS) --}}
        {{-- ================================================================= --}}
        <div x-show="showActionVerbsModal" x-cloak class="relative z-50">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" @click="showActionVerbsModal = false"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto flex items-center justify-center p-4">
                <div class="w-full max-w-xl bg-white rounded-2xl shadow-2xl border border-slate-200 p-6 space-y-4" @click.away="showActionVerbsModal = false">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div>
                            <h3 class="text-base font-bold text-slate-900">Kamus Kata Kerja Kuat ATS (Action Verbs)</h3>
                            <p class="text-xs text-slate-500">Awali setiap poin pencapaian dengan kata kerja aktif ini untuk memikat HRD & sistem ATS.</p>
                        </div>
                        <button type="button" @click="showActionVerbsModal = false" class="text-slate-400 hover:text-slate-600 font-bold text-sm cursor-pointer">✕</button>
                    </div>

                    <div class="space-y-3.5 text-xs">
                        <div>
                            <h4 class="font-bold text-indigo-700 uppercase tracking-wide text-[11px] mb-1.5">Teknis, Rekayasa & Pengembangan</h4>
                            <div class="flex flex-wrap gap-1.5">
                                <span class="px-2 py-1 rounded bg-slate-100 font-medium text-slate-800">Merancang (Designed)</span>
                                <span class="px-2 py-1 rounded bg-slate-100 font-medium text-slate-800">Membangun (Built / Engineered)</span>
                                <span class="px-2 py-1 rounded bg-slate-100 font-medium text-slate-800">Mengembangkan (Developed)</span>
                                <span class="px-2 py-1 rounded bg-slate-100 font-medium text-slate-800">Mengoptimalkan (Optimized)</span>
                                <span class="px-2 py-1 rounded bg-slate-100 font-medium text-slate-800">Mengintegrasikan (Integrated)</span>
                                <span class="px-2 py-1 rounded bg-slate-100 font-medium text-slate-800">Mengotomatisasi (Automated)</span>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-bold text-indigo-700 uppercase tracking-wide text-[11px] mb-1.5">Kepemimpinan & Manajemen Proyek</h4>
                            <div class="flex flex-wrap gap-1.5">
                                <span class="px-2 py-1 rounded bg-slate-100 font-medium text-slate-800">Memimpin (Spearheaded / Led)</span>
                                <span class="px-2 py-1 rounded bg-slate-100 font-medium text-slate-800">Mengoordinasikan (Coordinated)</span>
                                <span class="px-2 py-1 rounded bg-slate-100 font-medium text-slate-800">Mengarahkan (Directed)</span>
                                <span class="px-2 py-1 rounded bg-slate-100 font-medium text-slate-800">Mendelegasikan (Delegated)</span>
                                <span class="px-2 py-1 rounded bg-slate-100 font-medium text-slate-800">Membimbing (Mentored)</span>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-bold text-indigo-700 uppercase tracking-wide text-[11px] mb-1.5">Hasil, Pertumbuhan & Efisiensi</h4>
                            <div class="flex flex-wrap gap-1.5">
                                <span class="px-2 py-1 rounded bg-slate-100 font-medium text-slate-800">Meningkatkan (Increased / Accelerated)</span>
                                <span class="px-2 py-1 rounded bg-slate-100 font-medium text-slate-800">Mengurangi (Reduced / Decreased)</span>
                                <span class="px-2 py-1 rounded bg-slate-100 font-medium text-slate-800">Memaksimalkan (Maximized)</span>
                                <span class="px-2 py-1 rounded bg-slate-100 font-medium text-slate-800">Mencapai (Attained / Exceeded)</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-slate-100 flex justify-end">
                        <button type="button" @click="showActionVerbsModal = false" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-lg cursor-pointer">
                            Mengerti
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================================================================= --}}
        {{-- MOBILE STICKY BOTTOM SWITCH BAR --}}
        {{-- ================================================================= --}}
        <div class="mobile-tab-bar no-print lg:hidden fixed bottom-0 inset-x-0 z-50 bg-white border-t border-slate-200 px-4 py-2.5 shadow-lg flex items-center justify-between gap-3">
            <div class="flex items-center p-1 bg-slate-100 rounded-xl flex-1">
                <button type="button" @click="mobileTab = 'form'"
                        :class="mobileTab === 'form' ? 'bg-white text-indigo-700 shadow-xs font-bold' : 'text-slate-600 font-medium'"
                        class="flex-1 py-1.5 text-xs text-center rounded-lg transition-all cursor-pointer">
                    📝 Isi Form
                </button>
                <button type="button" @click="mobileTab = 'preview'"
                        :class="mobileTab === 'preview' ? 'bg-white text-indigo-700 shadow-xs font-bold' : 'text-slate-600 font-medium'"
                        class="flex-1 py-1.5 text-xs text-center rounded-lg transition-all cursor-pointer">
                    👁️ Lihat CV A4
                </button>
            </div>

            <button type="button" @click="printCv()"
                    class="px-3.5 py-2 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-md cursor-pointer flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                <span>Cetak</span>
            </button>
        </div>

    </div>
</x-layouts.app>
