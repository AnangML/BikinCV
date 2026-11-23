{{-- Template 2: Modern Minimalist (ATS-Compliant) --}}
<div class="cv-template-body text-slate-900 leading-relaxed">
    {{-- Header: Left-Aligned with Modern Layout --}}
    <header class="pb-4 mb-5 border-b-2" :style="'border-color: ' + accentColor">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight"
                    :style="'color: ' + accentColor"
                    x-text="cv.personal.fullName || 'Nama Lengkap'"></h1>
                
                <p class="text-sm font-semibold tracking-wide text-slate-600 mt-0.5"
                   x-text="cv.personal.jobTitle || 'Target Jabatan / Bidang Keahlian'"></p>
            </div>

            {{-- Right: Contact List (Clean Stacked) --}}
            <div class="text-xs text-slate-600 space-y-0.5 text-left sm:text-right font-medium">
                <template x-if="cv.personal.email">
                    <div x-text="cv.personal.email"></div>
                </template>
                <div class="flex flex-wrap items-center gap-x-2 sm:justify-end">
                    <span x-text="cv.personal.phone"></span>
                    <span class="text-slate-300" x-show="cv.personal.phone && cv.personal.location">•</span>
                    <span x-text="cv.personal.location"></span>
                </div>
                <div class="flex flex-wrap items-center gap-x-2 sm:justify-end text-slate-700">
                    <template x-if="cv.personal.linkedin">
                        <span x-text="cv.personal.linkedin"></span>
                    </template>
                    <span class="text-slate-300" x-show="cv.personal.linkedin && cv.personal.github">•</span>
                    <template x-if="cv.personal.github">
                        <span x-text="cv.personal.github"></span>
                    </template>
                </div>
            </div>
        </div>
    </header>

    {{-- Section: Professional Summary --}}
    <template x-if="cv.personal.summary">
        <section class="mb-5 break-inside-avoid">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-2 border-b flex items-center justify-between"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                <span x-text="t('summary')">TENTANG SAYA / PROFIL</span>
            </h2>
            <p class="text-slate-800 leading-normal text-justify" x-text="cv.personal.summary"></p>
        </section>
    </template>

    {{-- Section: Work Experience --}}
    <template x-if="cv.experiences && cv.experiences.length > 0">
        <section class="mb-5">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-3 border-b flex items-center justify-between"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                <span x-text="t('experience')">PENGALAMAN KERJA</span>
            </h2>

            <div class="space-y-4">
                <template x-for="(exp, expIdx) in cv.experiences" :key="exp.id || expIdx">
                    <template x-if="exp.position || exp.company">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between">
                                <span class="font-bold text-slate-900" x-text="exp.position || 'Jabatan'"></span>
                                <template x-if="exp.startDate || exp.endDate || exp.isCurrent">
                                    <span class="text-xs font-semibold text-slate-500 whitespace-nowrap"
                                          x-text="formatDateRange(exp.startDate, exp.endDate, exp.isCurrent)"></span>
                                </template>
                            </div>

                            <div class="flex items-baseline justify-between text-xs font-medium text-slate-600 mb-1.5">
                                <span class="font-semibold text-slate-800" x-text="exp.company || 'Nama Perusahaan'"></span>
                                <span x-text="exp.location"></span>
                            </div>

                            <ul class="list-disc list-outside ml-4 space-y-1 text-slate-800">
                                <template x-for="(bullet, bIdx) in exp.bullets" :key="bIdx">
                                    <template x-if="bullet && bullet.trim().length > 0">
                                        <li class="pl-1 leading-normal" x-text="bullet"></li>
                                    </template>
                                </template>
                            </ul>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Education --}}
    <template x-if="cv.educations && cv.educations.length > 0">
        <section class="mb-5">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-3 border-b flex items-center justify-between"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                <span x-text="t('education')">PENDIDIKAN</span>
            </h2>

            <div class="space-y-3">
                <template x-for="(edu, eduIdx) in cv.educations" :key="edu.id || eduIdx">
                    <template x-if="edu.institution || edu.degree">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between gap-2">
                                <span class="font-bold text-slate-900" x-text="edu.institution"></span>
                                <template x-if="edu.startDate || edu.endDate">
                                    <span class="text-xs font-semibold text-slate-500 whitespace-nowrap shrink-0"
                                          x-text="formatDateRange(edu.startDate, edu.endDate)"></span>
                                </template>
                            </div>
                            <div class="flex flex-wrap items-baseline justify-between gap-x-3 text-xs text-slate-600">
                                <span x-text="edu.degree"></span>
                                <template x-if="edu.location">
                                    <span x-text="edu.location"></span>
                                </template>
                            </div>
                            <template x-if="edu.gpa">
                                <div class="text-xs text-slate-600 mt-0.5">
                                    <span x-text="t('gpa') + ': '">IPK: </span><span class="font-semibold text-slate-800" x-text="edu.gpa"></span>
                                </div>
                            </template>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Core Skills --}}
    <template x-if="(cv.skills.languages && cv.skills.languages.length > 0) || 
                    (cv.skills.frameworks && cv.skills.frameworks.length > 0) || 
                    (cv.skills.databases && cv.skills.databases.length > 0) || 
                    (cv.skills.tools && cv.skills.tools.length > 0)">
        <section class="mb-5 break-inside-avoid">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-2 border-b flex items-center justify-between"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                <span x-text="t('skills')">KEAHLIAN & TEKNOLOGI</span>
            </h2>

            <div class="space-y-1.5 text-xs">
                <template x-if="cv.skills.languages && cv.skills.languages.length > 0">
                    <div>
                        <span class="font-bold text-slate-900" x-text="t('languages') + ': '">Bahasa Pemrograman: </span>
                        <span class="text-slate-800" x-text="cv.skills.languages.join(', ')"></span>
                    </div>
                </template>
                <template x-if="cv.skills.frameworks && cv.skills.frameworks.length > 0">
                    <div>
                        <span class="font-bold text-slate-900">Frameworks: </span>
                        <span class="text-slate-800" x-text="cv.skills.frameworks.join(', ')"></span>
                    </div>
                </template>
                <template x-if="cv.skills.databases && cv.skills.databases.length > 0">
                    <div>
                        <span class="font-bold text-slate-900">Databases: </span>
                        <span class="text-slate-800" x-text="cv.skills.databases.join(', ')"></span>
                    </div>
                </template>
                <template x-if="cv.skills.tools && cv.skills.tools.length > 0">
                    <div>
                        <span class="font-bold text-slate-900">Tools / Platform: </span>
                        <span class="text-slate-800" x-text="cv.skills.tools.join(', ')"></span>
                    </div>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Key Projects (Opsional) --}}
    <template x-if="cv.projects && cv.projects.length > 0">
        <section class="mb-5">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-3 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor"
                x-text="t('projects')">
                PROYEK UTAMA
            </h2>

            <div class="space-y-3">
                <template x-for="(proj, projIdx) in cv.projects" :key="proj.id || projIdx">
                    <template x-if="proj.name">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between">
                                <span class="font-bold text-slate-900" x-text="proj.name"></span>
                                <template x-if="proj.link">
                                    <span class="text-xs text-slate-500 font-mono" x-text="proj.link"></span>
                                </template>
                            </div>
                            <template x-if="proj.role">
                                <div class="text-xs font-medium text-slate-600 mb-0.5" x-text="proj.role"></div>
                            </template>
                            <p class="text-xs text-slate-800 leading-normal" x-text="proj.description"></p>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Certifications (Opsional) --}}
    <template x-if="cv.certifications && cv.certifications.length > 0">
        <section class="mb-5 break-inside-avoid">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-2 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor"
                x-text="t('certifications')">
                SERTIFIKASI & LISENSI
            </h2>

            <ul class="list-disc list-outside ml-4 space-y-1 text-xs text-slate-800">
                <template x-for="(cert, certIdx) in cv.certifications" :key="cert.id || certIdx">
                    <template x-if="cert.name">
                        <li class="pl-1">
                            <span class="font-bold" x-text="cert.name"></span>
                            <template x-if="cert.issuer">
                                <span> – <span x-text="cert.issuer"></span></span>
                            </template>
                            <template x-if="cert.score">
                                <span class="text-slate-700 font-medium" x-text="' (' + t('score') + ': ' + cert.score + ')'"></span>
                            </template>
                            <template x-if="cert.issueDate || cert.year || cert.expiryDate">
                                <span class="text-slate-500 font-medium"
                                      x-text="' | ' + formatDateRange(cert.issueDate || cert.year, cert.expiryDate)"></span>
                            </template>
                        </li>
                    </template>
                </template>
            </ul>
        </section>
    </template>

    {{-- Section: Pelatihan & Seminar (Opsional) --}}
    <template x-if="cv.trainings && cv.trainings.length > 0">
        <section class="mb-5">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-2 border-b flex items-center justify-between"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                <span x-text="t('trainings')">PELATIHAN & SEMINAR</span>
            </h2>

            <div class="space-y-3">
                <template x-for="(train, tIdx) in cv.trainings" :key="train.id || tIdx">
                    <template x-if="train.title || train.institution">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between gap-2">
                                <span class="font-bold text-slate-900" x-text="train.title"></span>
                                <template x-if="train.startDate || train.endDate">
                                    <span class="text-xs font-semibold text-slate-500 whitespace-nowrap shrink-0"
                                          x-text="formatDateRange(train.startDate, train.endDate)"></span>
                                </template>
                            </div>
                            <div class="flex flex-wrap items-baseline justify-between gap-x-3 text-xs text-slate-600">
                                <span class="font-medium text-slate-800" x-text="train.institution"></span>
                                <template x-if="train.location">
                                    <span x-text="train.location"></span>
                                </template>
                            </div>
                            <template x-if="train.field || train.subField">
                                <div class="text-[11px] text-slate-500 mt-0.5">
                                    <span class="font-medium text-slate-700" x-text="t('field') + ': '">Kejuruan: </span>
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
</div>
