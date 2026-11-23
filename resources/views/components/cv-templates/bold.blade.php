{{-- Template 11: The Bold Header (Modern Banner with Optional Photo & 100% ATS-Friendly) --}}
<div class="cv-template-body text-neutral-900 leading-relaxed">
    
    {{-- ================================================================= --}}
    {{-- HEADER: MODERN BOLD BANNER WITH PROFILE PHOTO & CONTACT BADGES    --}}
    {{-- ================================================================= --}}
    <header class="p-4 sm:p-5 rounded-xl border border-neutral-200/90 bg-neutral-50/70 mb-5 relative overflow-hidden"
            :style="'border-top: 4px solid ' + accentColor">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4.5">
            
            {{-- Pas Foto Profesional (Opsional) --}}
            <template x-if="cv.personal.photo">
                <div class="shrink-0">
                    <img :src="cv.personal.photo" alt="Foto Profil"
                         class="w-24 h-24 sm:w-28 sm:h-28 rounded-xl object-cover border-2 shadow-xs transition-transform"
                         :style="'border-color: ' + accentColor">
                </div>
            </template>

            {{-- Nama, Target Posisi, & Contact Chips --}}
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-neutral-900 leading-tight"
                    :style="'color: ' + accentColor"
                    x-text="cv.personal.fullName || 'NAMA LENGKAP'"></h1>
                
                <div class="mt-1">
                    <span class="text-xs font-bold uppercase tracking-wider text-neutral-700 px-2 py-0.5 rounded bg-white border border-neutral-200 shadow-2xs inline-block"
                          x-text="cv.personal.jobTitle || 'TARGET POSISI / BIDANG KEAHLIAN'"></span>
                </div>

                {{-- Contact & Link Badges/Chips --}}
                <div class="flex flex-wrap items-center gap-1.5 sm:gap-2 text-[11px] font-medium text-neutral-700 mt-3">
                    <template x-if="cv.personal.email">
                        <span class="inline-flex items-center gap-1 bg-white px-2 py-0.5 rounded border border-neutral-200 text-neutral-800 shadow-2xs">
                            <span class="font-bold text-neutral-400 text-[10px]">✉</span>
                            <span x-text="cv.personal.email"></span>
                        </span>
                    </template>
                    <template x-if="cv.personal.phone">
                        <span class="inline-flex items-center gap-1 bg-white px-2 py-0.5 rounded border border-neutral-200 text-neutral-800 shadow-2xs">
                            <span class="font-bold text-neutral-400 text-[10px]">☎</span>
                            <span x-text="cv.personal.phone"></span>
                        </span>
                    </template>
                    <template x-if="cv.personal.location">
                        <span class="inline-flex items-center gap-1 bg-white px-2 py-0.5 rounded border border-neutral-200 text-neutral-800 shadow-2xs">
                            <span class="font-bold text-neutral-400 text-[10px]">📍</span>
                            <span x-text="cv.personal.location"></span>
                        </span>
                    </template>
                    <template x-if="cv.personal.linkedin">
                        <span class="inline-flex items-center gap-1 bg-white px-2 py-0.5 rounded border border-neutral-200 text-neutral-800 shadow-2xs">
                            <span class="font-bold text-neutral-400 text-[10px]">in</span>
                            <span x-text="cv.personal.linkedin"></span>
                        </span>
                    </template>
                    <template x-if="cv.personal.github">
                        <span class="inline-flex items-center gap-1 bg-white px-2 py-0.5 rounded border border-neutral-200 text-neutral-800 shadow-2xs">
                            <span class="font-bold text-neutral-400 text-[10px]">git</span>
                            <span x-text="cv.personal.github"></span>
                        </span>
                    </template>
                    <template x-if="cv.personal.website">
                        <span class="inline-flex items-center gap-1 bg-white px-2 py-0.5 rounded border border-neutral-200 text-neutral-800 shadow-2xs">
                            <span class="font-bold text-neutral-400 text-[10px]">🌐</span>
                            <span x-text="cv.personal.website"></span>
                        </span>
                    </template>
                </div>
            </div>
        </div>
    </header>

    {{-- ================================================================= --}}
    {{-- SEKSI 1: RINGKASAN PROFIL (PROFESSIONAL SUMMARY)                  --}}
    {{-- ================================================================= --}}
    <template x-if="cv.personal.summary">
        <section class="mb-4.5 break-inside-avoid">
            <div class="flex items-center gap-2 pb-1.5 mb-2 border-b border-neutral-200">
                <span class="w-2.5 h-3.5 rounded-xs shrink-0" :style="'background-color: ' + accentColor"></span>
                <h2 class="text-xs font-black uppercase tracking-wider" :style="'color: ' + accentColor"
                    x-text="t('summary')"></h2>
            </div>
            <p class="text-neutral-800 leading-relaxed text-justify text-xs" x-text="cv.personal.summary"></p>
        </section>
    </template>

    {{-- ================================================================= --}}
    {{-- SEKSI 2: PENGALAMAN KERJA (WORK EXPERIENCE)                       --}}
    {{-- ================================================================= --}}
    <template x-if="cv.experiences && cv.experiences.length > 0">
        <section class="mb-4.5">
            <div class="flex items-center gap-2 pb-1.5 mb-2.5 border-b border-neutral-200">
                <span class="w-2.5 h-3.5 rounded-xs shrink-0" :style="'background-color: ' + accentColor"></span>
                <h2 class="text-xs font-black uppercase tracking-wider" :style="'color: ' + accentColor"
                    x-text="t('experience')"></h2>
            </div>

            <div class="space-y-3.5">
                <template x-for="(exp, expIdx) in cv.experiences" :key="exp.id || expIdx">
                    <template x-if="exp.position || exp.company">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between gap-2">
                                <div>
                                    <span class="font-bold text-neutral-900 text-xs" x-text="exp.position"></span>
                                    <span class="text-neutral-400 mx-1" x-show="exp.position && exp.company">|</span>
                                    <span class="font-semibold text-neutral-700 text-xs" x-text="exp.company"></span>
                                </div>
                                <template x-if="exp.startDate || exp.endDate || exp.isCurrent">
                                    <div class="text-[11px] font-semibold text-neutral-600 bg-neutral-100 px-2 py-0.5 rounded border border-neutral-200/60 shrink-0 whitespace-nowrap"
                                         x-text="formatDateRange(exp.startDate, exp.endDate, exp.isCurrent)"></div>
                                </template>
                            </div>

                            <div class="text-[11px] text-neutral-400 mb-1" x-show="exp.location" x-text="exp.location"></div>

                            <ul class="list-disc ml-4 space-y-1 text-neutral-700 text-xs leading-normal marker:text-neutral-400">
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
    {{-- SEKSI 3: RIWAYAT PENDIDIKAN (EDUCATION)                           --}}
    {{-- ================================================================= --}}
    <template x-if="cv.educations && cv.educations.length > 0">
        <section class="mb-4.5">
            <div class="flex items-center gap-2 pb-1.5 mb-2.5 border-b border-neutral-200">
                <span class="w-2.5 h-3.5 rounded-xs shrink-0" :style="'background-color: ' + accentColor"></span>
                <h2 class="text-xs font-black uppercase tracking-wider" :style="'color: ' + accentColor"
                    x-text="t('education')"></h2>
            </div>

            <div class="space-y-3">
                <template x-for="(edu, eduIdx) in cv.educations" :key="edu.id || eduIdx">
                    <template x-if="edu.institution || edu.degree">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between gap-2">
                                <span class="font-bold text-neutral-900 text-xs" x-text="edu.institution"></span>
                                <template x-if="edu.startDate || edu.endDate">
                                    <div class="text-[11px] font-semibold text-neutral-600 bg-neutral-100 px-2 py-0.5 rounded border border-neutral-200/60 shrink-0 whitespace-nowrap"
                                         x-text="formatDateRange(edu.startDate, edu.endDate)"></div>
                                </template>
                            </div>
                            <div class="flex flex-wrap items-baseline justify-between gap-x-3 text-xs text-neutral-700 mt-0.5">
                                <span x-text="edu.degree"></span>
                                <template x-if="edu.location">
                                    <span class="text-[11px] text-neutral-400" x-text="edu.location"></span>
                                </template>
                            </div>
                            <template x-if="edu.gpa">
                                <div class="text-[11px] text-neutral-600 mt-0.5">
                                    <span x-text="t('gpa') + ': '"></span><span class="font-bold text-neutral-800" x-text="edu.gpa"></span>
                                </div>
                            </template>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- ================================================================= --}}
    {{-- SEKSI 4: KEAHLIAN & TEKNOLOGI (SKILLS)                            --}}
    {{-- ================================================================= --}}
    <template x-if="(cv.skills.languages && cv.skills.languages.length > 0) || 
                    (cv.skills.frameworks && cv.skills.frameworks.length > 0) || 
                    (cv.skills.databases && cv.skills.databases.length > 0) || 
                    (cv.skills.tools && cv.skills.tools.length > 0)">
        <section class="mb-4.5 break-inside-avoid">
            <div class="flex items-center gap-2 pb-1.5 mb-2.5 border-b border-neutral-200">
                <span class="w-2.5 h-3.5 rounded-xs shrink-0" :style="'background-color: ' + accentColor"></span>
                <h2 class="text-xs font-black uppercase tracking-wider" :style="'color: ' + accentColor"
                    x-text="t('skills')"></h2>
            </div>

            <div class="space-y-2 text-xs">
                <template x-if="cv.skills.languages && cv.skills.languages.length > 0">
                    <div class="flex flex-wrap items-baseline gap-1.5">
                        <span class="font-bold text-neutral-900 w-28 shrink-0" x-text="t('languages') + ':'"></span>
                        <div class="flex-1 flex flex-wrap gap-1.5">
                            <template x-for="(lang, lIdx) in cv.skills.languages" :key="lIdx">
                                <span class="bg-neutral-100 border border-neutral-200 text-neutral-800 text-[11px] font-medium px-2 py-0.5 rounded shadow-2xs"
                                      x-text="lang"></span>
                            </template>
                        </div>
                    </div>
                </template>

                <template x-if="cv.skills.frameworks && cv.skills.frameworks.length > 0">
                    <div class="flex flex-wrap items-baseline gap-1.5">
                        <span class="font-bold text-neutral-900 w-28 shrink-0">Frameworks:</span>
                        <div class="flex-1 flex flex-wrap gap-1.5">
                            <template x-for="(fw, fIdx) in cv.skills.frameworks" :key="fIdx">
                                <span class="bg-neutral-100 border border-neutral-200 text-neutral-800 text-[11px] font-medium px-2 py-0.5 rounded shadow-2xs"
                                      x-text="fw"></span>
                            </template>
                        </div>
                    </div>
                </template>

                <template x-if="cv.skills.databases && cv.skills.databases.length > 0">
                    <div class="flex flex-wrap items-baseline gap-1.5">
                        <span class="font-bold text-neutral-900 w-28 shrink-0">Databases:</span>
                        <div class="flex-1 flex flex-wrap gap-1.5">
                            <template x-for="(db, dIdx) in cv.skills.databases" :key="dIdx">
                                <span class="bg-neutral-100 border border-neutral-200 text-neutral-800 text-[11px] font-medium px-2 py-0.5 rounded shadow-2xs"
                                      x-text="db"></span>
                            </template>
                        </div>
                    </div>
                </template>

                <template x-if="cv.skills.tools && cv.skills.tools.length > 0">
                    <div class="flex flex-wrap items-baseline gap-1.5">
                        <span class="font-bold text-neutral-900 w-28 shrink-0" x-text="t('tools') + ':'"></span>
                        <div class="flex-1 flex flex-wrap gap-1.5">
                            <template x-for="(tool, tIdx) in cv.skills.tools" :key="tIdx">
                                <span class="bg-neutral-100 border border-neutral-200 text-neutral-800 text-[11px] font-medium px-2 py-0.5 rounded shadow-2xs"
                                      x-text="tool"></span>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </section>
    </template>

    {{-- ================================================================= --}}
    {{-- SEKSI 5: PROYEK UTAMA (PROJECTS)                                  --}}
    {{-- ================================================================= --}}
    <template x-if="cv.projects && cv.projects.length > 0">
        <section class="mb-4.5">
            <div class="flex items-center gap-2 pb-1.5 mb-2.5 border-b border-neutral-200">
                <span class="w-2.5 h-3.5 rounded-xs shrink-0" :style="'background-color: ' + accentColor"></span>
                <h2 class="text-xs font-black uppercase tracking-wider" :style="'color: ' + accentColor"
                    x-text="t('projects')"></h2>
            </div>

            <div class="space-y-3">
                <template x-for="(proj, projIdx) in cv.projects" :key="proj.id || projIdx">
                    <template x-if="proj.name">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between gap-2">
                                <span class="font-bold text-neutral-900 text-xs" x-text="proj.name"></span>
                                <template x-if="proj.link">
                                    <span class="text-[10px] text-neutral-500 font-mono" x-text="proj.link"></span>
                                </template>
                            </div>
                            <template x-if="proj.role">
                                <div class="text-[11px] font-semibold text-neutral-600 mb-0.5" x-text="proj.role"></div>
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
            <div class="flex items-center gap-2 pb-1.5 mb-2.5 border-b border-neutral-200">
                <span class="w-2.5 h-3.5 rounded-xs shrink-0" :style="'background-color: ' + accentColor"></span>
                <h2 class="text-xs font-black uppercase tracking-wider" :style="'color: ' + accentColor"
                    x-text="t('certifications')"></h2>
            </div>

            <div class="space-y-2.5">
                <template x-for="(cert, certIdx) in cv.certifications" :key="cert.id || certIdx">
                    <template x-if="cert.name">
                        <div class="break-inside-avoid flex items-baseline justify-between gap-2 text-xs">
                            <div>
                                <span class="font-bold text-neutral-900" x-text="cert.name"></span>
                                <div class="text-neutral-600 text-[11px]">
                                    <span x-text="cert.issuer"></span>
                                    <template x-if="cert.score">
                                        <span class="font-semibold text-neutral-800" x-text="' — ' + t('score') + ': ' + cert.score"></span>
                                    </template>
                                </div>
                            </div>
                            <div class="text-[11px] font-semibold text-neutral-600 bg-neutral-100 px-2 py-0.5 rounded border border-neutral-200/60 shrink-0 whitespace-nowrap"
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
        <section class="mb-4.5 break-inside-avoid">
            <div class="flex items-center gap-2 pb-1.5 mb-2.5 border-b border-neutral-200">
                <span class="w-2.5 h-3.5 rounded-xs shrink-0" :style="'background-color: ' + accentColor"></span>
                <h2 class="text-xs font-black uppercase tracking-wider" :style="'color: ' + accentColor"
                    x-text="t('trainings')"></h2>
            </div>

            <div class="space-y-3">
                <template x-for="(train, tIdx) in cv.trainings" :key="train.id || tIdx">
                    <template x-if="train.title || train.institution">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between gap-2">
                                <span class="font-bold text-neutral-900 text-xs" x-text="train.title"></span>
                                <template x-if="train.startDate || train.endDate">
                                    <div class="text-[11px] font-semibold text-neutral-600 bg-neutral-100 px-2 py-0.5 rounded border border-neutral-200/60 shrink-0 whitespace-nowrap"
                                         x-text="formatDateRange(train.startDate, train.endDate)"></div>
                                </template>
                            </div>
                            <div class="flex flex-wrap items-baseline justify-between gap-x-3 text-xs text-neutral-700 mt-0.5">
                                <span class="font-medium text-neutral-800" x-text="train.institution"></span>
                                <template x-if="train.location">
                                    <span class="text-[11px] text-neutral-400" x-text="train.location"></span>
                                </template>
                            </div>
                            <template x-if="train.field || train.subField">
                                <div class="text-[11px] text-neutral-500 mt-0.5">
                                    <span class="font-medium text-neutral-700" x-text="t('field') + ': '"></span>
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

    {{-- ================================================================= --}}
    {{-- SEKSI: BAHASA YANG DIKUASAI (Opsional)                            --}}
    {{-- ================================================================= --}}
    <template x-if="cv.languages && cv.languages.length > 0">
        <section class="mb-4.5 break-inside-avoid">
            <div class="flex items-center gap-2 pb-1.5 mb-2.5 border-b border-neutral-200">
                <span class="w-2.5 h-3.5 rounded-xs shrink-0" :style="'background-color: ' + accentColor"></span>
                <h2 class="text-xs font-black uppercase tracking-wider" :style="'color: ' + accentColor"
                    x-text="t('languages_spoken')"></h2>
            </div>

            <div class="space-y-2 text-xs">
                <template x-for="(lang, lIdx) in cv.languages" :key="lang.id || lIdx">
                    <template x-if="lang.name">
                        <div class="break-inside-avoid flex items-baseline justify-between gap-2">
                            <div>
                                <span class="font-bold text-neutral-900" x-text="lang.name"></span>
                                <span class="text-neutral-600 text-[11px]" x-show="lang.level" x-text="' — ' + lang.level"></span>
                            </div>
                            <div class="text-[11px] font-semibold text-neutral-600 bg-neutral-100 px-2 py-0.5 rounded border border-neutral-200/60 shrink-0 whitespace-nowrap"
                                 x-show="lang.info"
                                 x-text="lang.info"></div>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>
</div>
