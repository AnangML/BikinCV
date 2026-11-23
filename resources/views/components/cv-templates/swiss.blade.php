{{-- Template 10: The Swiss International (Timeline / Margin-Date Layout & ATS-Friendly) --}}
<div class="cv-template-body text-neutral-900 leading-relaxed">
    
    {{-- ================================================================= --}}
    {{-- HEADER: SWISS TYPOGRAPHIC GRID & ASYMMETRIC CONTRAST              --}}
    {{-- ================================================================= --}}
    <header class="pb-3 mb-4">
        <div class="flex items-start justify-between gap-5">
            {{-- Name & Target Job Title --}}
            <div class="flex-1 min-w-0">
                <h1 class="text-3xl sm:text-4xl font-black uppercase tracking-tight text-neutral-900 leading-none"
                    :style="'color: ' + accentColor"
                    x-text="cv.personal.fullName || 'NAMA LENGKAP'"></h1>
                
                <p class="text-xs font-bold uppercase tracking-[0.22em] text-neutral-500 mt-2"
                   x-text="cv.personal.jobTitle || 'TARGET POSISI / BIDANG KEAHLIAN'"></p>
            </div>

            {{-- Optional Geometric Photo (Swiss Minimalist Frame) --}}
            <template x-if="cv.personal.photo">
                <div class="shrink-0">
                    <img :src="cv.personal.photo" alt="Foto Profil"
                         class="w-24 h-28 object-cover border-2 shadow-xs"
                         :style="'border-color: ' + accentColor">
                </div>
            </template>
        </div>

        {{-- Bold Swiss Accent Divider Bar --}}
        <div class="h-1 w-full my-3" :style="'background-color: ' + accentColor"></div>

        {{-- Contact & Link Grid (Structured Metadata) --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-x-4 gap-y-1.5 text-[11px] text-neutral-600 font-medium pt-0.5">
            <template x-if="cv.personal.email">
                <div class="flex items-center gap-1.5 truncate">
                    <span class="font-bold text-neutral-900 text-[10px] tracking-wider uppercase">EMAIL:</span>
                    <span class="truncate" x-text="cv.personal.email"></span>
                </div>
            </template>

            <template x-if="cv.personal.phone">
                <div class="flex items-center gap-1.5">
                    <span class="font-bold text-neutral-900 text-[10px] tracking-wider uppercase">TEL:</span>
                    <span x-text="cv.personal.phone"></span>
                </div>
            </template>

            <template x-if="cv.personal.location">
                <div class="flex items-center gap-1.5 truncate">
                    <span class="font-bold text-neutral-900 text-[10px] tracking-wider uppercase">LOKASI:</span>
                    <span class="truncate" x-text="cv.personal.location"></span>
                </div>
            </template>

            <template x-if="cv.personal.linkedin">
                <div class="flex items-center gap-1.5 truncate">
                    <span class="font-bold text-neutral-900 text-[10px] tracking-wider uppercase">LINKEDIN:</span>
                    <span class="truncate" x-text="cv.personal.linkedin"></span>
                </div>
            </template>

            <template x-if="cv.personal.github">
                <div class="flex items-center gap-1.5 truncate">
                    <span class="font-bold text-neutral-900 text-[10px] tracking-wider uppercase">GITHUB:</span>
                    <span class="truncate" x-text="cv.personal.github"></span>
                </div>
            </template>

            <template x-if="cv.personal.website">
                <div class="flex items-center gap-1.5 truncate">
                    <span class="font-bold text-neutral-900 text-[10px] tracking-wider uppercase">WEB:</span>
                    <span class="truncate" x-text="cv.personal.website"></span>
                </div>
            </template>
        </div>
    </header>

    {{-- ================================================================= --}}
    {{-- SEKSI 01: RINGKASAN PROFIL (PROFILE SUMMARY)                      --}}
    {{-- ================================================================= --}}
    <template x-if="cv.personal.summary">
        <section class="mb-4.5 break-inside-avoid">
            <div class="flex items-baseline justify-between border-b-2 pb-1 mb-2.5"
                 :style="'border-color: ' + accentColor">
                <h2 class="text-xs font-black uppercase tracking-[0.18em]"
                    :style="'color: ' + accentColor"
                    x-text="'01 / ' + t('summary')"></h2>
                <span class="text-[10px] font-mono text-neutral-400 uppercase tracking-widest">ABOUT</span>
            </div>

            <div class="flex gap-4 items-start">
                <div class="w-[26%] shrink-0 text-right pr-2 font-bold text-[10px] uppercase tracking-wider text-neutral-400"
                     x-text="t('statement')"></div>
                <div class="flex-1 min-w-0 border-l-2 border-neutral-200 pl-3.5">
                    <p class="text-xs text-neutral-800 leading-relaxed text-justify" x-text="cv.personal.summary"></p>
                </div>
            </div>
        </section>
    </template>

    {{-- ================================================================= --}}
    {{-- SEKSI 02: PENGALAMAN KERJA (TIMELINE MARGIN-DATE)                 --}}
    {{-- ================================================================= --}}
    <template x-if="cv.experiences && cv.experiences.length > 0">
        <section class="mb-4.5">
            <div class="flex items-baseline justify-between border-b-2 pb-1 mb-3"
                 :style="'border-color: ' + accentColor">
                <h2 class="text-xs font-black uppercase tracking-[0.18em]"
                    :style="'color: ' + accentColor"
                    x-text="'02 / ' + t('experience')"></h2>
                <span class="text-[10px] font-mono text-neutral-400 uppercase tracking-widest">EXPERIENCE</span>
            </div>

            <div class="space-y-4">
                <template x-for="(exp, expIdx) in cv.experiences" :key="exp.id || expIdx">
                    <template x-if="exp.position || exp.company">
                        <div class="break-inside-avoid flex items-start gap-4">
                            {{-- Left Margin Gutter: Period & Company --}}
                            <div class="w-[26%] shrink-0 text-right pr-2 space-y-0.5">
                                <template x-if="exp.startDate || exp.endDate || exp.isCurrent">
                                    <div class="text-[11px] font-black text-neutral-900 tracking-tight whitespace-nowrap"
                                         x-text="formatDateRange(exp.startDate, exp.endDate, exp.isCurrent)"></div>
                                </template>
                                <div class="text-xs font-bold text-neutral-700 leading-tight" x-text="exp.company"></div>
                                <template x-if="exp.location">
                                    <div class="text-[10px] font-medium text-neutral-400" x-text="exp.location"></div>
                                </template>
                            </div>

                            {{-- Right Column: Position & Achievement Bullets --}}
                            <div class="flex-1 min-w-0 border-l-2 border-neutral-200 pl-3.5">
                                <h3 class="text-xs font-extrabold text-neutral-900 uppercase tracking-wide"
                                    x-text="exp.position"></h3>

                                <ul class="list-disc ml-4 mt-1.5 space-y-1 text-xs text-neutral-700 leading-normal marker:text-neutral-400">
                                    <template x-for="(bullet, bIdx) in exp.bullets" :key="bIdx">
                                        <template x-if="bullet && bullet.trim().length > 0">
                                            <li class="pl-0.5" x-text="bullet"></li>
                                        </template>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- ================================================================= --}}
    {{-- SEKSI 03: RIWAYAT PENDIDIKAN (TIMELINE MARGIN-DATE)               --}}
    {{-- ================================================================= --}}
    <template x-if="cv.educations && cv.educations.length > 0">
        <section class="mb-4.5">
            <div class="flex items-baseline justify-between border-b-2 pb-1 mb-3"
                 :style="'border-color: ' + accentColor">
                <h2 class="text-xs font-black uppercase tracking-[0.18em]"
                    :style="'color: ' + accentColor"
                    x-text="'03 / ' + t('education')"></h2>
                <span class="text-[10px] font-mono text-neutral-400 uppercase tracking-widest">EDUCATION</span>
            </div>

            <div class="space-y-3.5">
                <template x-for="(edu, eduIdx) in cv.educations" :key="edu.id || eduIdx">
                    <template x-if="edu.institution || edu.degree">
                        <div class="break-inside-avoid flex items-start gap-4">
                            {{-- Left Margin Gutter: Year & Location --}}
                            <div class="w-[26%] shrink-0 text-right pr-2 space-y-0.5">
                                <template x-if="edu.startDate || edu.endDate">
                                    <div class="text-[11px] font-black text-neutral-900 tracking-tight whitespace-nowrap"
                                         x-text="formatDateRange(edu.startDate, edu.endDate)"></div>
                                </template>
                                <template x-if="edu.location">
                                    <div class="text-[10px] font-medium text-neutral-400" x-text="edu.location"></div>
                                </template>
                            </div>

                            {{-- Right Column: Degree & Institution --}}
                            <div class="flex-1 min-w-0 border-l-2 border-neutral-200 pl-3.5">
                                <h3 class="text-xs font-extrabold text-neutral-900 uppercase tracking-wide"
                                    x-text="edu.institution"></h3>
                                <div class="text-xs text-neutral-700 mt-0.5">
                                    <span class="font-medium" x-text="edu.degree"></span>
                                    <template x-if="edu.gpa">
                                        <span class="font-bold text-neutral-900" x-text="' — ' + t('gpa') + ': ' + edu.gpa"></span>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- ================================================================= --}}
    {{-- SEKSI 04: KEAHLIAN & TEKNOLOGI (STRUCTURED GRID)                  --}}
    {{-- ================================================================= --}}
    <template x-if="(cv.skills.languages && cv.skills.languages.length > 0) || 
                    (cv.skills.frameworks && cv.skills.frameworks.length > 0) || 
                    (cv.skills.databases && cv.skills.databases.length > 0) || 
                    (cv.skills.tools && cv.skills.tools.length > 0)">
        <section class="mb-4.5 break-inside-avoid">
            <div class="flex items-baseline justify-between border-b-2 pb-1 mb-2.5"
                 :style="'border-color: ' + accentColor">
                <h2 class="text-xs font-black uppercase tracking-[0.18em]"
                    :style="'color: ' + accentColor"
                    x-text="'04 / ' + t('skills')"></h2>
                <span class="text-[10px] font-mono text-neutral-400 uppercase tracking-widest">SKILLS</span>
            </div>

            <div class="flex gap-4 items-start">
                <div class="w-[26%] shrink-0 text-right pr-2 font-bold text-[10px] uppercase tracking-wider text-neutral-400"
                     x-text="t('skills_competency')"></div>

                <div class="flex-1 min-w-0 border-l-2 border-neutral-200 pl-3.5 space-y-2 text-xs">
                    <template x-if="cv.skills.languages && cv.skills.languages.length > 0">
                        <div class="flex items-baseline gap-2">
                            <span class="w-24 shrink-0 font-bold text-neutral-900 uppercase text-[10px] tracking-wider" x-text="t('languages') + ':'"></span>
                            <span class="text-neutral-700 leading-normal" x-text="cv.skills.languages.join(' • ')"></span>
                        </div>
                    </template>

                    <template x-if="cv.skills.frameworks && cv.skills.frameworks.length > 0">
                        <div class="flex items-baseline gap-2">
                            <span class="w-24 shrink-0 font-bold text-neutral-900 uppercase text-[10px] tracking-wider">Frameworks:</span>
                            <span class="text-neutral-700 leading-normal" x-text="cv.skills.frameworks.join(' • ')"></span>
                        </div>
                    </template>

                    <template x-if="cv.skills.databases && cv.skills.databases.length > 0">
                        <div class="flex items-baseline gap-2">
                            <span class="w-24 shrink-0 font-bold text-neutral-900 uppercase text-[10px] tracking-wider">Databases:</span>
                            <span class="text-neutral-700 leading-normal" x-text="cv.skills.databases.join(' • ')"></span>
                        </div>
                    </template>

                    <template x-if="cv.skills.tools && cv.skills.tools.length > 0">
                        <div class="flex items-baseline gap-2">
                            <span class="w-24 shrink-0 font-bold text-neutral-900 uppercase text-[10px] tracking-wider" x-text="t('tools') + ':'"></span>
                            <span class="text-neutral-700 leading-normal" x-text="cv.skills.tools.join(' • ')"></span>
                        </div>
                    </template>
                </div>
            </div>
        </section>
    </template>

    {{-- ================================================================= --}}
    {{-- SEKSI 05: PROYEK UTAMA (PROJECTS)                                 --}}
    {{-- ================================================================= --}}
    <template x-if="cv.projects && cv.projects.length > 0">
        <section class="mb-4.5">
            <div class="flex items-baseline justify-between border-b-2 pb-1 mb-3"
                 :style="'border-color: ' + accentColor">
                <h2 class="text-xs font-black uppercase tracking-[0.18em]"
                    :style="'color: ' + accentColor"
                    x-text="'05 / ' + t('projects')"></h2>
                <span class="text-[10px] font-mono text-neutral-400 uppercase tracking-widest">PROJECTS</span>
            </div>

            <div class="space-y-3.5">
                <template x-for="(proj, projIdx) in cv.projects" :key="proj.id || projIdx">
                    <template x-if="proj.name">
                        <div class="break-inside-avoid flex items-start gap-4">
                            {{-- Left Margin Gutter: Role & Link --}}
                            <div class="w-[26%] shrink-0 text-right pr-2 space-y-0.5">
                                <div class="text-[11px] font-black text-neutral-900 uppercase tracking-tight" x-text="proj.role || 'PROYEK'"></div>
                                <template x-if="proj.link">
                                    <div class="text-[10px] font-mono text-neutral-500 break-all" x-text="proj.link"></div>
                                </template>
                            </div>

                            {{-- Right Column: Project Name & Description --}}
                            <div class="flex-1 min-w-0 border-l-2 border-neutral-200 pl-3.5">
                                <h3 class="text-xs font-extrabold text-neutral-900 uppercase tracking-wide"
                                    x-text="proj.name"></h3>
                                <p class="text-xs text-neutral-700 leading-relaxed mt-1" x-text="proj.description"></p>
                            </div>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- ================================================================= --}}
    {{-- SEKSI 06: SERTIFIKASI & LISENSI                                  --}}
    {{-- ================================================================= --}}
    <template x-if="cv.certifications && cv.certifications.length > 0">
        <section class="mb-4.5">
            <div class="flex items-baseline justify-between border-b-2 pb-1 mb-3"
                 :style="'border-color: ' + accentColor">
                <h2 class="text-xs font-black uppercase tracking-[0.18em]"
                    :style="'color: ' + accentColor"
                    x-text="'06 / ' + t('certifications')"></h2>
                <span class="text-[10px] font-mono text-neutral-400 uppercase tracking-widest">CERTIFICATIONS</span>
            </div>

            <div class="space-y-3">
                <template x-for="(cert, certIdx) in cv.certifications" :key="cert.id || certIdx">
                    <template x-if="cert.name">
                        <div class="break-inside-avoid flex items-start gap-4">
                            {{-- Left Margin Gutter: Validity / Issuer --}}
                            <div class="w-[26%] shrink-0 text-right pr-2 space-y-0.5">
                                <div class="text-[11px] font-black text-neutral-900 tracking-tight whitespace-nowrap"
                                     x-text="formatDateRange(cert.issueDate || cert.year, cert.expiryDate)"></div>
                                <div class="text-[10px] font-medium text-neutral-500" x-text="cert.issuer"></div>
                            </div>

                            {{-- Right Column: Certification Name & Score --}}
                            <div class="flex-1 min-w-0 border-l-2 border-neutral-200 pl-3.5">
                                <h3 class="text-xs font-extrabold text-neutral-900 uppercase tracking-wide"
                                    x-text="cert.name"></h3>
                                <template x-if="cert.score">
                                    <div class="text-[11px] text-neutral-600 font-medium mt-0.5">
                                        <span x-text="t('score') + ': '"></span><span class="font-bold text-neutral-800" x-text="cert.score"></span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- ================================================================= --}}
    {{-- SEKSI 07: PELATIHAN & SEMINAR                                    --}}
    {{-- ================================================================= --}}
    <template x-if="cv.trainings && cv.trainings.length > 0">
        <section class="mb-4.5">
            <div class="flex items-baseline justify-between border-b-2 pb-1 mb-3"
                 :style="'border-color: ' + accentColor">
                <h2 class="text-xs font-black uppercase tracking-[0.18em]"
                    :style="'color: ' + accentColor"
                    x-text="'07 / ' + t('trainings')"></h2>
                <span class="text-[10px] font-mono text-neutral-400 uppercase tracking-widest">TRAINING</span>
            </div>

            <div class="space-y-3.5">
                <template x-for="(train, tIdx) in cv.trainings" :key="train.id || tIdx">
                    <template x-if="train.title || train.institution">
                        <div class="break-inside-avoid flex items-start gap-4">
                            {{-- Left Margin Gutter: Period & Location --}}
                            <div class="w-[26%] shrink-0 text-right pr-2 space-y-0.5">
                                <template x-if="train.startDate || train.endDate">
                                    <div class="text-[11px] font-black text-neutral-900 tracking-tight whitespace-nowrap"
                                         x-text="formatDateRange(train.startDate, train.endDate)"></div>
                                </template>
                                <template x-if="train.location">
                                    <div class="text-[10px] font-medium text-neutral-400" x-text="train.location"></div>
                                </template>
                            </div>

                            {{-- Right Column: Training Details --}}
                            <div class="flex-1 min-w-0 border-l-2 border-neutral-200 pl-3.5">
                                <h3 class="text-xs font-extrabold text-neutral-900 uppercase tracking-wide"
                                    x-text="train.title"></h3>
                                <div class="text-xs text-neutral-700 font-medium mt-0.5" x-text="train.institution"></div>
                                <template x-if="train.field || train.subField">
                                    <div class="text-[10px] font-semibold text-neutral-500 uppercase tracking-wider mt-0.5">
                                        <span x-text="train.field"></span>
                                        <span x-show="train.field && train.subField"> — </span>
                                        <span x-text="train.subField"></span>
                                    </div>
                                </template>
                                <template x-if="train.description">
                                    <p class="text-xs text-neutral-700 leading-relaxed mt-1" x-text="train.description"></p>
                                </template>
                            </div>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Bahasa yang Dikuasai (Opsional) --}}
    <template x-if="cv.languages && cv.languages.length > 0">
        <section class="break-inside-avoid mb-6">
            <div class="flex items-baseline justify-between border-b-2 pb-1 mb-3"
                 :style="'border-color: ' + accentColor">
                <h2 class="text-xs font-bold uppercase tracking-wider"
                    :style="'color: ' + accentColor"
                    x-text="t('languages_spoken')"></h2>
            </div>

            <ul class="list-disc list-outside ml-4 space-y-1 text-xs text-neutral-800">
                <template x-for="(lang, lIdx) in cv.languages" :key="lang.id || lIdx">
                    <template x-if="lang.name">
                        <li class="pl-1">
                            <span class="font-bold text-neutral-900" x-text="lang.name"></span>
                            <template x-if="lang.level">
                                <span>: <span class="text-neutral-700" x-text="lang.level"></span></span>
                            </template>
                            <template x-if="lang.info">
                                <span class="text-neutral-500 font-medium" x-text="' (' + lang.info + ')'"></span>
                            </template>
                        </li>
                    </template>
                </template>
            </ul>
        </section>
    </template>
</div>
