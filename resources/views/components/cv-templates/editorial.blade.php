{{-- Template 12: The Editorial / Modern Creative (Contemporary Magazine Aesthetic & 100% ATS-Friendly) --}}
<div class="cv-template-body text-neutral-900 leading-relaxed">
    
    {{-- ================================================================= --}}
    {{-- HEADER: CONTEMPORARY EDITORIAL MASTHEAD & ASYMMETRIC DETAILS      --}}
    {{-- ================================================================= --}}
    <header class="pb-3 mb-4.5">
        {{-- Top Folio / Category Marker --}}
        <div class="flex items-center justify-between text-[9px] uppercase tracking-[0.25em] text-neutral-400 font-semibold mb-2 pb-1 border-b border-neutral-200">
            <span>CURRICULUM VITAE</span>
            <span x-text="cv.personal.jobTitle ? 'PROFESSIONAL DOSSIER' : 'RESUME'"></span>
        </div>

        <div class="flex items-start justify-between gap-5">
            {{-- Name & Editorial Subtitle --}}
            <div class="flex-1 min-w-0">
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight leading-none text-neutral-900"
                    :style="'color: ' + accentColor"
                    x-text="cv.personal.fullName || 'NAMA LENGKAP'"></h1>
                
                <div class="flex items-center gap-2 mt-2">
                    <span class="w-5 h-0.5" :style="'background-color: ' + accentColor"></span>
                    <p class="text-xs font-bold tracking-[0.16em] uppercase text-neutral-600"
                       x-text="cv.personal.jobTitle || 'TARGET POSISI / BIDANG KEAHLIAN'"></p>
                </div>
            </div>

            {{-- Optional Editorial Portrait Photo --}}
            <template x-if="cv.personal.photo">
                <div class="shrink-0">
                    <img :src="cv.personal.photo" alt="Foto Profil"
                         class="w-22 h-26 sm:w-24 sm:h-28 object-cover rounded-lg border-2 shadow-xs transition-transform"
                         :style="'border-color: ' + accentColor">
                </div>
            </template>
        </div>

        {{-- Editorial Double-Hairline Contact Strip --}}
        <div class="border-y border-neutral-300/80 py-2 mt-3.5 flex flex-wrap items-center justify-between gap-x-3 gap-y-1 text-[11px] text-neutral-600 font-medium">
            <template x-if="cv.personal.email">
                <div class="flex items-center gap-1.5">
                    <span class="text-neutral-400 font-bold text-[9px] uppercase tracking-wider">EMAIL:</span>
                    <span class="text-neutral-900" x-text="cv.personal.email"></span>
                </div>
            </template>

            <template x-if="cv.personal.phone">
                <div class="flex items-center gap-1.5">
                    <span class="text-neutral-400 font-bold text-[9px] uppercase tracking-wider">TEL:</span>
                    <span class="text-neutral-900" x-text="cv.personal.phone"></span>
                </div>
            </template>

            <template x-if="cv.personal.location">
                <div class="flex items-center gap-1.5">
                    <span class="text-neutral-400 font-bold text-[9px] uppercase tracking-wider" x-text="t('location') + ':'">LOKASI:</span>
                    <span class="text-neutral-900" x-text="cv.personal.location"></span>
                </div>
            </template>

            <template x-if="cv.personal.linkedin">
                <div class="flex items-center gap-1.5">
                    <span class="text-neutral-400 font-bold text-[9px] uppercase tracking-wider">LINKEDIN:</span>
                    <span class="text-neutral-900" x-text="cv.personal.linkedin"></span>
                </div>
            </template>

            <template x-if="cv.personal.github">
                <div class="flex items-center gap-1.5">
                    <span class="text-neutral-400 font-bold text-[9px] uppercase tracking-wider">GITHUB:</span>
                    <span class="text-neutral-900" x-text="cv.personal.github"></span>
                </div>
            </template>

            <template x-if="cv.personal.website">
                <div class="flex items-center gap-1.5">
                    <span class="text-neutral-400 font-bold text-[9px] uppercase tracking-wider">WEB:</span>
                    <span class="text-neutral-900" x-text="cv.personal.website"></span>
                </div>
            </template>
        </div>
    </header>

    {{-- ================================================================= --}}
    {{-- SEKSI 1: RINGKASAN PROFIL (EDITORIAL STATEMENT)                   --}}
    {{-- ================================================================= --}}
    <template x-if="cv.personal.summary">
        <section class="mb-4.5 break-inside-avoid">
            <div class="flex items-baseline justify-between pb-1 mb-2 border-b border-neutral-300">
                <h2 class="text-xs font-black uppercase tracking-[0.2em]"
                    :style="'color: ' + accentColor"
                    x-text="'01 / ' + t('summary')">
                    01 / RINGKASAN PROFIL
                </h2>
                <span class="text-[9px] uppercase tracking-[0.25em] text-neutral-400 italic">Statement</span>
            </div>
            <p class="text-xs text-neutral-800 leading-relaxed text-justify" x-text="cv.personal.summary"></p>
        </section>
    </template>

    {{-- ================================================================= --}}
    {{-- SEKSI 2: PENGALAMAN KERJA (EXPERIENCE DOSSIER)                    --}}
    {{-- ================================================================= --}}
    <template x-if="cv.experiences && cv.experiences.length > 0">
        <section class="mb-4.5">
            <div class="flex items-baseline justify-between pb-1 mb-2.5 border-b border-neutral-300">
                <h2 class="text-xs font-black uppercase tracking-[0.2em]"
                    :style="'color: ' + accentColor"
                    x-text="'02 / ' + t('experience')">
                    02 / PENGALAMAN KERJA
                </h2>
                <span class="text-[9px] uppercase tracking-[0.25em] text-neutral-400 italic">Experience</span>
            </div>

            <div class="space-y-4">
                <template x-for="(exp, expIdx) in cv.experiences" :key="exp.id || expIdx">
                    <template x-if="exp.position || exp.company">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between gap-2">
                                <div>
                                    <span class="font-bold text-neutral-900 text-xs tracking-tight" x-text="exp.position"></span>
                                    <span class="text-neutral-400 mx-1.5">•</span>
                                    <span class="italic text-neutral-700 text-xs font-medium" x-text="exp.company"></span>
                                </div>
                                <template x-if="exp.startDate || exp.endDate || exp.isCurrent">
                                    <div class="text-[11px] font-semibold text-neutral-600 shrink-0 whitespace-nowrap"
                                         x-text="formatDateRange(exp.startDate, exp.endDate, exp.isCurrent)"></div>
                                </template>
                            </div>

                            <div class="text-[11px] text-neutral-400 mb-1" x-show="exp.location" x-text="exp.location"></div>

                            <ul class="list-disc ml-4 space-y-1 text-xs text-neutral-700 leading-normal marker:text-neutral-400">
                                <template x-for="(bullet, bIdx) in exp.bullets" :key="bIdx">
                                    <template x-if="bullet && bullet.trim().length > 0">
                                        <li class="pl-0.5" x-text="bullet"></li>
                                    </template>
                                </template>
                            </ul>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- ================================================================= --}}
    {{-- SEKSI 3: RIWAYAT PENDIDIKAN (ACADEMIC BACKGROUND)                 --}}
    {{-- ================================================================= --}}
    <template x-if="cv.educations && cv.educations.length > 0">
        <section class="mb-4.5">
            <div class="flex items-baseline justify-between pb-1 mb-2.5 border-b border-neutral-300">
                <h2 class="text-xs font-black uppercase tracking-[0.2em]"
                    :style="'color: ' + accentColor"
                    x-text="'03 / ' + t('education')">
                    03 / RIWAYAT PENDIDIKAN
                </h2>
                <span class="text-[9px] uppercase tracking-[0.25em] text-neutral-400 italic">Education</span>
            </div>

            <div class="space-y-3">
                <template x-for="(edu, eduIdx) in cv.educations" :key="edu.id || eduIdx">
                    <template x-if="edu.institution || edu.degree">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between gap-2">
                                <span class="font-bold text-neutral-900 text-xs tracking-tight" x-text="edu.institution"></span>
                                <template x-if="edu.startDate || edu.endDate">
                                    <div class="text-[11px] font-semibold text-neutral-600 shrink-0 whitespace-nowrap"
                                         x-text="formatDateRange(edu.startDate, edu.endDate)"></div>
                                </template>
                            </div>
                            <div class="flex flex-wrap items-baseline justify-between gap-x-3 text-xs text-neutral-700 mt-0.5">
                                <span class="italic font-medium" x-text="edu.degree"></span>
                                <template x-if="edu.location">
                                    <span class="text-[11px] text-neutral-400 not-italic" x-text="edu.location"></span>
                                </template>
                            </div>
                            <template x-if="edu.gpa">
                                <div class="text-[11px] text-neutral-600 mt-0.5">
                                    <span x-text="t('gpa') + ': '">IPK: </span><span class="font-bold text-neutral-800" x-text="edu.gpa"></span>
                                </div>
                            </template>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- ================================================================= --}}
    {{-- SEKSI 4: KEAHLIAN & SPESIALISASI (CURATED EXPERTISE)              --}}
    {{-- ================================================================= --}}
    <template x-if="(cv.skills.languages && cv.skills.languages.length > 0) || 
                    (cv.skills.frameworks && cv.skills.frameworks.length > 0) || 
                    (cv.skills.databases && cv.skills.databases.length > 0) || 
                    (cv.skills.tools && cv.skills.tools.length > 0)">
        <section class="mb-4.5 break-inside-avoid">
            <div class="flex items-baseline justify-between pb-1 mb-2.5 border-b border-neutral-300">
                <h2 class="text-xs font-black uppercase tracking-[0.2em]"
                    :style="'color: ' + accentColor"
                    x-text="'04 / ' + t('skills')">
                    04 / KEAHLIAN & SPESIALISASI
                </h2>
                <span class="text-[9px] uppercase tracking-[0.25em] text-neutral-400 italic">Skills</span>
            </div>

            <div class="space-y-2 text-xs">
                <template x-if="cv.skills.languages && cv.skills.languages.length > 0">
                    <div class="flex items-baseline gap-2">
                        <span class="font-bold text-neutral-900 w-30 shrink-0 uppercase text-[10px] tracking-wider" x-text="t('languages') + ':'">Bahasa:</span>
                        <span class="text-neutral-700 leading-normal" x-text="cv.skills.languages.join(' • ')"></span>
                    </div>
                </template>

                <template x-if="cv.skills.frameworks && cv.skills.frameworks.length > 0">
                    <div class="flex items-baseline gap-2">
                        <span class="font-bold text-neutral-900 w-30 shrink-0 uppercase text-[10px] tracking-wider">Frameworks:</span>
                        <span class="text-neutral-700 leading-normal" x-text="cv.skills.frameworks.join(' • ')"></span>
                    </div>
                </template>

                <template x-if="cv.skills.databases && cv.skills.databases.length > 0">
                    <div class="flex items-baseline gap-2">
                        <span class="font-bold text-neutral-900 w-30 shrink-0 uppercase text-[10px] tracking-wider">Databases:</span>
                        <span class="text-neutral-700 leading-normal" x-text="cv.skills.databases.join(' • ')"></span>
                    </div>
                </template>

                <template x-if="cv.skills.tools && cv.skills.tools.length > 0">
                    <div class="flex items-baseline gap-2">
                        <span class="font-bold text-neutral-900 w-30 shrink-0 uppercase text-[10px] tracking-wider">Tools / Cloud:</span>
                        <span class="text-neutral-700 leading-normal" x-text="cv.skills.tools.join(' • ')"></span>
                    </div>
                </template>
            </div>
        </section>
    </template>

    {{-- ================================================================= --}}
    {{-- SEKSI 5: PROYEK UTAMA (SELECTED WORKS)                            --}}
    {{-- ================================================================= --}}
    <template x-if="cv.projects && cv.projects.length > 0">
        <section class="mb-4.5">
            <div class="flex items-baseline justify-between pb-1 mb-2.5 border-b border-neutral-300">
                <h2 class="text-xs font-black uppercase tracking-[0.2em]"
                    :style="'color: ' + accentColor"
                    x-text="'05 / ' + t('projects')">
                    05 / PROYEK UTAMA
                </h2>
                <span class="text-[9px] uppercase tracking-[0.25em] text-neutral-400 italic">Portfolio</span>
            </div>

            <div class="space-y-3">
                <template x-for="(proj, projIdx) in cv.projects" :key="proj.id || projIdx">
                    <template x-if="proj.name">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between gap-2">
                                <span class="font-bold text-neutral-900 text-xs tracking-tight" x-text="proj.name"></span>
                                <template x-if="proj.link">
                                    <span class="text-[10px] text-neutral-500 font-mono" x-text="proj.link"></span>
                                </template>
                            </div>
                            <template x-if="proj.role">
                                <div class="text-[11px] italic text-neutral-600 font-medium mb-0.5" x-text="proj.role"></div>
                            </template>
                            <p class="text-xs text-neutral-700 leading-normal" x-text="proj.description"></p>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- ================================================================= --}}
    {{-- SEKSI 6: SERTIFIKASI & LISENSI                                    --}}
    {{-- ================================================================= --}}
    <template x-if="cv.certifications && cv.certifications.length > 0">
        <section class="mb-4.5">
            <div class="flex items-baseline justify-between pb-1 mb-2.5 border-b border-neutral-300">
                <h2 class="text-xs font-black uppercase tracking-[0.2em]"
                    :style="'color: ' + accentColor"
                    x-text="'06 / ' + t('certifications')">
                    06 / SERTIFIKASI & LISENSI
                </h2>
                <span class="text-[9px] uppercase tracking-[0.25em] text-neutral-400 italic">Credentials</span>
            </div>

            <div class="space-y-2.5">
                <template x-for="(cert, certIdx) in cv.certifications" :key="cert.id || certIdx">
                    <template x-if="cert.name">
                        <div class="break-inside-avoid flex items-baseline justify-between gap-2 text-xs">
                            <div>
                                <span class="font-bold text-neutral-900 tracking-tight" x-text="cert.name"></span>
                                <div class="text-neutral-600 text-[11px]">
                                    <span class="italic" x-text="cert.issuer"></span>
                                    <template x-if="cert.score">
                                        <span class="not-italic font-semibold text-neutral-800" x-text="' — ' + t('score') + ': ' + cert.score"></span>
                                    </template>
                                </div>
                            </div>
                            <div class="text-[11px] font-semibold text-neutral-600 shrink-0 whitespace-nowrap"
                                 x-text="formatDateRange(cert.issueDate || cert.year, cert.expiryDate)"></div>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- ================================================================= --}}
    {{-- SEKSI 7: PELATIHAN & SEMINAR                                      --}}
    {{-- ================================================================= --}}
    <template x-if="cv.trainings && cv.trainings.length > 0">
        <section class="mb-4.5">
            <div class="flex items-baseline justify-between pb-1 mb-2.5 border-b border-neutral-300">
                <h2 class="text-xs font-black uppercase tracking-[0.2em]"
                    :style="'color: ' + accentColor"
                    x-text="'07 / ' + t('trainings')">
                    07 / PELATIHAN & SEMINAR
                </h2>
                <span class="text-[9px] uppercase tracking-[0.25em] text-neutral-400 italic">Development</span>
            </div>

            <div class="space-y-3">
                <template x-for="(train, tIdx) in cv.trainings" :key="train.id || tIdx">
                    <template x-if="train.title || train.institution">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between gap-2">
                                <span class="font-bold text-neutral-900 text-xs tracking-tight" x-text="train.title"></span>
                                <template x-if="train.startDate || train.endDate">
                                    <div class="text-[11px] font-semibold text-neutral-600 shrink-0 whitespace-nowrap"
                                         x-text="formatDateRange(train.startDate, train.endDate)"></div>
                                </template>
                            </div>
                            <div class="flex flex-wrap items-baseline justify-between gap-x-3 text-xs text-neutral-700 mt-0.5">
                                <span class="italic font-medium text-neutral-800" x-text="train.institution"></span>
                                <template x-if="train.location">
                                    <span class="text-[11px] text-neutral-400 not-italic" x-text="train.location"></span>
                                </template>
                            </div>
                            <template x-if="train.field || train.subField">
                                <div class="text-[11px] text-neutral-500 mt-0.5">
                                    <span class="font-medium text-neutral-700" x-text="t('field') + ': '">Kejuruan: </span>
                                    <span x-text="train.field"></span>
                                    <span x-show="train.field && train.subField"> — </span>
                                    <span x-text="train.subField"></span>
                                </div>
                            </template>
                            <template x-if="train.description">
                                <p class="text-xs text-neutral-700 leading-normal mt-1" x-text="train.description"></p>
                            </template>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>
</div>
