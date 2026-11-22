{{-- Template 9: The Modern Two-Column (Dual Grid with Optional Photo & ATS-Friendly) --}}
<div class="cv-template-body text-slate-900 leading-relaxed">
    <div class="flex gap-6 items-start">
        
        {{-- ================================================================= --}}
        {{-- KOLOM KIRI (Sidebar ~34%): Foto, Kontak, Keahlian & Sertifikasi   --}}
        {{-- ================================================================= --}}
        <aside class="w-[34%] shrink-0 pr-4 border-r border-slate-200 space-y-5 text-xs">
            
            {{-- Foto Profil Profesional (Opsional) --}}
            <template x-if="cv.personal.photo">
                <div class="text-center pb-1">
                    <img :src="cv.personal.photo" alt="Foto Profil"
                         class="w-32 h-32 mx-auto rounded-xl object-cover border-2 shadow-xs transition-transform"
                         :style="'border-color: ' + accentColor">
                </div>
            </template>

            {{-- 1. Kontak Pribadi & Tautan --}}
            <section class="break-inside-avoid">
                <h3 class="text-[11px] font-bold uppercase tracking-wider pb-1 mb-2.5 border-b"
                    :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                    KONTAK
                </h3>
                <div class="space-y-2 text-slate-700">
                    <template x-if="cv.personal.email">
                        <div class="flex items-start gap-1.5 break-all">
                            <span class="font-bold text-slate-900 shrink-0">Email:</span>
                            <span x-text="cv.personal.email"></span>
                        </div>
                    </template>

                    <template x-if="cv.personal.phone">
                        <div class="flex items-start gap-1.5">
                            <span class="font-bold text-slate-900 shrink-0">Telp:</span>
                            <span x-text="cv.personal.phone"></span>
                        </div>
                    </template>

                    <template x-if="cv.personal.location">
                        <div class="flex items-start gap-1.5">
                            <span class="font-bold text-slate-900 shrink-0">Domisili:</span>
                            <span x-text="cv.personal.location"></span>
                        </div>
                    </template>

                    <template x-if="cv.personal.linkedin">
                        <div class="flex items-start gap-1.5 break-all">
                            <span class="font-bold text-slate-900 shrink-0">LinkedIn:</span>
                            <span x-text="cv.personal.linkedin"></span>
                        </div>
                    </template>

                    <template x-if="cv.personal.github">
                        <div class="flex items-start gap-1.5 break-all">
                            <span class="font-bold text-slate-900 shrink-0">GitHub:</span>
                            <span x-text="cv.personal.github"></span>
                        </div>
                    </template>

                    <template x-if="cv.personal.website">
                        <div class="flex items-start gap-1.5 break-all">
                            <span class="font-bold text-slate-900 shrink-0">Web:</span>
                            <span x-text="cv.personal.website"></span>
                        </div>
                    </template>
                </div>
            </section>

            {{-- 2. Keahlian & Teknologi --}}
            <template x-if="(cv.skills.languages && cv.skills.languages.length > 0) || 
                            (cv.skills.frameworks && cv.skills.frameworks.length > 0) || 
                            (cv.skills.databases && cv.skills.databases.length > 0) || 
                            (cv.skills.tools && cv.skills.tools.length > 0)">
                <section class="break-inside-avoid">
                    <h3 class="text-[11px] font-bold uppercase tracking-wider pb-1 mb-2.5 border-b"
                        :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                        KEAHLIAN & SKILL
                    </h3>

                    <div class="space-y-2 text-slate-700">
                        <template x-if="cv.skills.languages && cv.skills.languages.length > 0">
                            <div>
                                <span class="font-bold text-slate-900 block mb-0.5">Bahasa:</span>
                                <span class="text-slate-800 leading-normal" x-text="cv.skills.languages.join(', ')"></span>
                            </div>
                        </template>

                        <template x-if="cv.skills.frameworks && cv.skills.frameworks.length > 0">
                            <div>
                                <span class="font-bold text-slate-900 block mb-0.5">Frameworks:</span>
                                <span class="text-slate-800 leading-normal" x-text="cv.skills.frameworks.join(', ')"></span>
                            </div>
                        </template>

                        <template x-if="cv.skills.databases && cv.skills.databases.length > 0">
                            <div>
                                <span class="font-bold text-slate-900 block mb-0.5">Database:</span>
                                <span class="text-slate-800 leading-normal" x-text="cv.skills.databases.join(', ')"></span>
                            </div>
                        </template>

                        <template x-if="cv.skills.tools && cv.skills.tools.length > 0">
                            <div>
                                <span class="font-bold text-slate-900 block mb-0.5">Tools & Cloud:</span>
                                <span class="text-slate-800 leading-normal" x-text="cv.skills.tools.join(', ')"></span>
                            </div>
                        </template>
                    </div>
                </section>
            </template>

            {{-- 3. Sertifikasi & Lisensi --}}
            <template x-if="cv.certifications && cv.certifications.length > 0">
                <section class="break-inside-avoid">
                    <h3 class="text-[11px] font-bold uppercase tracking-wider pb-1 mb-2.5 border-b"
                        :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                        SERTIFIKASI
                    </h3>

                    <div class="space-y-2.5 text-slate-800">
                        <template x-for="(cert, certIdx) in cv.certifications" :key="cert.id || certIdx">
                            <template x-if="cert.name">
                                <div>
                                    <div class="font-bold leading-tight text-slate-900" x-text="cert.name"></div>
                                    <div class="text-[11px] text-slate-600 mt-0.5">
                                        <span x-text="cert.issuer"></span>
                                        <template x-if="cert.score">
                                            <span class="font-medium text-slate-700"> (Skor: <span x-text="cert.score"></span>)</span>
                                        </template>
                                    </div>
                                    <template x-if="cert.issueDate || cert.year || cert.expiryDate">
                                        <div class="text-[10px] text-slate-500 font-mono mt-0.5">
                                            <span x-text="cert.issueDate || cert.year"></span>
                                            <span x-show="(cert.issueDate || cert.year) && cert.expiryDate"> – </span>
                                            <span x-text="cert.expiryDate"></span>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </template>
                    </div>
                </section>
            </template>
        </aside>

        {{-- ================================================================= --}}
        {{-- KOLOM KANAN (Konten Utama ~66%): Header, Profil, Karir, Edu, dll  --}}
        {{-- ================================================================= --}}
        <main class="w-[66%] pl-2 flex-1 min-w-0">
            
            {{-- Header Nama & Jabatan --}}
            <header class="pb-3 mb-4 border-b-2" :style="'border-color: ' + accentColor">
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight"
                    :style="'color: ' + accentColor"
                    x-text="cv.personal.fullName || 'Nama Lengkap'"></h1>
                
                <p class="text-sm font-semibold tracking-wide text-slate-700 mt-0.5"
                   x-text="cv.personal.jobTitle || 'Target Jabatan / Bidang Keahlian'"></p>
            </header>

            {{-- Seksi: Ringkasan Profil --}}
            <template x-if="cv.personal.summary">
                <section class="mb-4.5 break-inside-avoid">
                    <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-2 border-b flex items-center justify-between"
                        :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                        <span>RINGKASAN PROFIL</span>
                    </h2>
                    <p class="text-xs text-slate-800 leading-relaxed text-justify" x-text="cv.personal.summary"></p>
                </section>
            </template>

            {{-- Seksi: Pengalaman Kerja --}}
            <template x-if="cv.experiences && cv.experiences.length > 0">
                <section class="mb-4.5">
                    <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-2.5 border-b flex items-center justify-between"
                        :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                        <span>PENGALAMAN KERJA</span>
                    </h2>

                    <div class="space-y-3.5">
                        <template x-for="(exp, expIdx) in cv.experiences" :key="exp.id || expIdx">
                            <template x-if="exp.position || exp.company">
                                <div class="break-inside-avoid">
                                    <div class="flex items-baseline justify-between gap-2">
                                        <span class="font-bold text-slate-900 text-xs" x-text="exp.position || 'Jabatan'"></span>
                                        <template x-if="exp.startDate || exp.endDate || exp.isCurrent">
                                            <span class="text-[11px] font-semibold text-slate-500 whitespace-nowrap shrink-0">
                                                <span x-text="exp.startDate"></span><span x-show="exp.startDate && (exp.isCurrent || exp.endDate)"> – </span><span x-text="exp.isCurrent ? 'Present' : exp.endDate"></span>
                                            </span>
                                        </template>
                                    </div>

                                    <div class="flex items-baseline justify-between text-[11px] font-medium text-slate-600 mb-1">
                                        <span class="font-semibold text-slate-800" x-text="exp.company || 'Nama Perusahaan'"></span>
                                        <span x-text="exp.location"></span>
                                    </div>

                                    <ul class="list-disc list-outside ml-4 space-y-1 text-xs text-slate-800">
                                        <template x-for="(bullet, bIdx) in exp.bullets" :key="bIdx">
                                            <template x-if="bullet && bullet.trim().length > 0">
                                                <li class="pl-0.5 leading-normal" x-text="bullet"></li>
                                            </template>
                                        </template>
                                    </ul>
                                </div>
                            </template>
                        </template>
                    </div>
                </section>
            </template>

            {{-- Seksi: Riwayat Pendidikan --}}
            <template x-if="cv.educations && cv.educations.length > 0">
                <section class="mb-4.5">
                    <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-2.5 border-b flex items-center justify-between"
                        :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                        <span>RIWAYAT PENDIDIKAN</span>
                    </h2>

                    <div class="space-y-3">
                        <template x-for="(edu, eduIdx) in cv.educations" :key="edu.id || eduIdx">
                            <template x-if="edu.institution || edu.degree">
                                <div class="break-inside-avoid">
                                    <div class="flex items-baseline justify-between gap-2">
                                        <span class="font-bold text-slate-900 text-xs" x-text="edu.institution"></span>
                                        <template x-if="edu.startDate || edu.endDate">
                                            <span class="text-[11px] font-semibold text-slate-500 whitespace-nowrap shrink-0">
                                                <span x-text="edu.startDate"></span><span x-show="edu.startDate && edu.endDate"> – </span><span x-text="edu.endDate"></span>
                                            </span>
                                        </template>
                                    </div>
                                    <div class="flex flex-wrap items-baseline justify-between gap-x-3 text-xs text-slate-700">
                                        <span x-text="edu.degree"></span>
                                        <template x-if="edu.location">
                                            <span class="text-[11px] text-slate-500" x-text="edu.location"></span>
                                        </template>
                                    </div>
                                    <template x-if="edu.gpa">
                                        <div class="text-[11px] text-slate-600 mt-0.5">
                                            <span>IPK: </span><span class="font-semibold text-slate-800" x-text="edu.gpa"></span>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </template>
                    </div>
                </section>
            </template>

            {{-- Seksi: Proyek Portofolio --}}
            <template x-if="cv.projects && cv.projects.length > 0">
                <section class="mb-4.5">
                    <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-2.5 border-b"
                        :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                        PROYEK UTAMA
                    </h2>

                    <div class="space-y-2.5">
                        <template x-for="(proj, projIdx) in cv.projects" :key="proj.id || projIdx">
                            <template x-if="proj.name">
                                <div class="break-inside-avoid">
                                    <div class="flex items-baseline justify-between gap-2">
                                        <span class="font-bold text-slate-900 text-xs" x-text="proj.name"></span>
                                        <template x-if="proj.link">
                                            <span class="text-[10px] text-slate-500 font-mono" x-text="proj.link"></span>
                                        </template>
                                    </div>
                                    <template x-if="proj.role">
                                        <div class="text-[11px] font-medium text-slate-600 mb-0.5" x-text="proj.role"></div>
                                    </template>
                                    <p class="text-xs text-slate-800 leading-normal" x-text="proj.description"></p>
                                </div>
                            </template>
                        </template>
                    </div>
                </section>
            </template>

            {{-- Seksi: Pelatihan & Seminar --}}
            <template x-if="cv.trainings && cv.trainings.length > 0">
                <section class="mb-4.5">
                    <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-2.5 border-b flex items-center justify-between"
                        :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                        <span>PELATIHAN & SEMINAR</span>
                    </h2>

                    <div class="space-y-3">
                        <template x-for="(train, tIdx) in cv.trainings" :key="train.id || tIdx">
                            <template x-if="train.title || train.institution">
                                <div class="break-inside-avoid">
                                    <div class="flex items-baseline justify-between gap-2">
                                        <span class="font-bold text-slate-900 text-xs" x-text="train.title"></span>
                                        <template x-if="train.startDate || train.endDate">
                                            <span class="text-[11px] font-semibold text-slate-500 whitespace-nowrap shrink-0">
                                                <span x-text="train.startDate"></span><span x-show="train.startDate && train.endDate"> – </span><span x-text="train.endDate"></span>
                                            </span>
                                        </template>
                                    </div>
                                    <div class="flex flex-wrap items-baseline justify-between gap-x-3 text-xs text-slate-700">
                                        <span class="font-medium text-slate-800" x-text="train.institution"></span>
                                        <template x-if="train.location">
                                            <span class="text-[11px] text-slate-500" x-text="train.location"></span>
                                        </template>
                                    </div>
                                    <template x-if="train.field || train.subField">
                                        <div class="text-[11px] text-slate-500 mt-0.5">
                                            <span class="font-medium text-slate-700">Kejuruan: </span>
                                            <span x-text="train.field"></span>
                                            <span x-show="train.field && train.subField"> — </span>
                                            <span x-text="train.subField"></span>
                                        </div>
                                    </template>
                                    <template x-if="train.description">
                                        <p class="text-xs text-slate-800 leading-normal mt-1" x-text="train.description"></p>
                                    </template>
                                </div>
                            </template>
                        </template>
                    </div>
                </section>
            </template>
        </main>
    </div>
</div>
