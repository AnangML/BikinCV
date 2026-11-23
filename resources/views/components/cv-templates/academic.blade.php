{{-- Template 5: Academic & Ivy League (ATS-Compliant / Curriculum Vitae Standard) --}}
<div class="cv-template-body text-slate-900 leading-relaxed text-[11pt]">
    {{-- Header: Classic Academic Style (Center-Aligned) --}}
    <header class="text-center pb-3 mb-6 border-b" :style="'border-color: ' + accentColor">
        <h1 class="text-2xl sm:text-3xl font-bold tracking-normal uppercase"
            :style="'color: ' + accentColor"
            x-text="cv.personal.fullName || 'NAMA LENGKAP'"></h1>
        
        <p class="text-sm italic text-slate-700 mt-1"
           x-text="cv.personal.jobTitle || 'Academic Researcher / Candidate'"></p>

        {{-- Contact Details (Academic Style) --}}
        <div class="flex flex-wrap items-center justify-center gap-x-2 text-xs text-slate-700 mt-2">
            <template x-if="cv.personal.location">
                <span><span x-text="cv.personal.location"></span> |</span>
            </template>
            <template x-if="cv.personal.phone">
                <span><span x-text="cv.personal.phone"></span> |</span>
            </template>
            <template x-if="cv.personal.email">
                <span><span x-text="cv.personal.email"></span> |</span>
            </template>
            <template x-if="cv.personal.linkedin">
                <span x-text="cv.personal.linkedin"></span>
            </template>
        </div>
    </header>

    {{-- Section 1: Education (Top Priority in Academic CV) --}}
    <template x-if="cv.educations && cv.educations.length > 0">
        <section class="mb-5 break-inside-avoid">
            <h2 class="text-xs font-serif font-bold uppercase tracking-wider pb-1 mb-3 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor"
                x-text="t('education')">
                EDUCATION
            </h2>

            <div class="space-y-3">
                <template x-for="(edu, eduIdx) in cv.educations" :key="edu.id || eduIdx">
                    <template x-if="edu.institution || edu.degree">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between font-serif gap-2">
                                <span class="font-bold text-slate-900" x-text="edu.institution"></span>
                                <template x-if="edu.startDate || edu.endDate">
                                    <span class="text-xs font-semibold text-slate-700 shrink-0 whitespace-nowrap"
                                          x-text="formatDateRange(edu.startDate, edu.endDate)"></span>
                                </template>
                            </div>
                            <div class="flex flex-wrap items-baseline justify-between gap-x-3 text-xs italic text-slate-800">
                                <span x-text="edu.degree"></span>
                                <template x-if="edu.location">
                                    <span class="not-italic text-slate-600" x-text="edu.location"></span>
                                </template>
                            </div>
                            <template x-if="edu.gpa">
                                <div class="text-xs text-slate-700 mt-0.5">
                                    <span><span x-text="t('gpa') + ': '">GPA: </span><strong x-text="edu.gpa"></strong></span>
                                </div>
                            </template>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- Section 2: Research & Professional Summary --}}
    <template x-if="cv.personal.summary">
        <section class="mb-5 break-inside-avoid">
            <h2 class="text-xs font-serif font-bold uppercase tracking-wider pb-1 mb-2 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor"
                x-text="t('summary')">
                RESEARCH PROFILE & SUMMARY
            </h2>
            <p class="text-justify text-slate-800 text-xs leading-relaxed font-serif" x-text="cv.personal.summary"></p>
        </section>
    </template>

    {{-- Section 3: Professional & Academic Experience --}}
    <template x-if="cv.experiences && cv.experiences.length > 0">
        <section class="mb-5">
            <h2 class="text-xs font-serif font-bold uppercase tracking-wider pb-1 mb-3 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor"
                x-text="t('experience')">
                RESEARCH & PROFESSIONAL EXPERIENCE
            </h2>

            <div class="space-y-4">
                <template x-for="(exp, expIdx) in cv.experiences" :key="exp.id || expIdx">
                    <template x-if="exp.position || exp.company">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between font-serif">
                                <span class="font-bold text-slate-900" x-text="exp.position"></span>
                                <template x-if="exp.startDate || exp.endDate || exp.isCurrent">
                                    <span class="text-xs font-semibold text-slate-700"
                                          x-text="formatDateRange(exp.startDate, exp.endDate, exp.isCurrent)"></span>
                                </template>
                            </div>

                            <div class="flex items-baseline justify-between text-xs italic text-slate-800 mb-1">
                                <span x-text="exp.company"></span>
                                <span x-text="exp.location"></span>
                            </div>

                            <ul class="list-disc list-outside ml-4 space-y-1 text-xs text-slate-800 font-serif">
                                <template x-for="(bullet, bIdx) in exp.bullets" :key="bIdx">
                                    <template x-if="bullet && bullet.trim().length > 0">
                                        <li class="pl-1 leading-normal text-justify" x-text="bullet"></li>
                                    </template>
                                </template>
                            </ul>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- Section 4: Publications / Key Projects --}}
    <template x-if="cv.projects && cv.projects.length > 0">
        <section class="mb-5 break-inside-avoid">
            <h2 class="text-xs font-serif font-bold uppercase tracking-wider pb-1 mb-3 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor"
                x-text="t('projects')">
                PUBLICATIONS & SCHOLARLY PROJECTS
            </h2>

            <div class="space-y-3">
                <template x-for="(proj, projIdx) in cv.projects" :key="proj.id || projIdx">
                    <template x-if="proj.name">
                        <div class="break-inside-avoid text-xs font-serif">
                            <div class="flex items-baseline justify-between">
                                <span class="font-bold text-slate-900" x-text="proj.name"></span>
                                <template x-if="proj.link">
                                    <span class="text-slate-600 font-mono text-[11px]" x-text="proj.link"></span>
                                </template>
                            </div>
                            <template x-if="proj.role">
                                <div class="italic text-slate-700 mb-0.5" x-text="proj.role"></div>
                            </template>
                            <p class="text-slate-800 leading-normal" x-text="proj.description"></p>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- Section 5: Certifications & Honors --}}
    <template x-if="cv.certifications && cv.certifications.length > 0">
        <section class="mb-5 break-inside-avoid">
            <h2 class="text-xs font-serif font-bold uppercase tracking-wider pb-1 mb-2 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor"
                x-text="t('certifications')">
                HONORS, AWARDS & CERTIFICATIONS
            </h2>

            <ul class="list-disc list-outside ml-4 space-y-1 text-xs text-slate-800 font-serif">
                <template x-for="(cert, certIdx) in cv.certifications" :key="cert.id || certIdx">
                    <template x-if="cert.name">
                        <li class="pl-1 leading-normal">
                            <strong x-text="cert.name"></strong>
                            <template x-if="cert.issuer">
                                <span>, <span x-text="cert.issuer"></span></span>
                            </template>
                            <template x-if="cert.score">
                                <span x-text="' (' + t('score') + ': ' + cert.score + ')'"></span>
                            </template>
                            <template x-if="cert.issueDate || cert.year || cert.expiryDate">
                                <span class="text-slate-600"
                                      x-text="' [' + formatDateRange(cert.issueDate || cert.year, cert.expiryDate) + ']'"></span>
                            </template>
                        </li>
                    </template>
                </template>
            </ul>
        </section>
    </template>

    {{-- Section 6: Languages & Skills --}}
    <template x-if="(cv.skills.languages && cv.skills.languages.length > 0) || (cv.skills.tools && cv.skills.tools.length > 0)">
        <section class="mb-5 break-inside-avoid">
            <h2 class="text-xs font-serif font-bold uppercase tracking-wider pb-1 mb-2 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor"
                x-text="t('skills')">
                SKILLS & COMPETENCIES
            </h2>

            <div class="text-xs text-slate-800 space-y-1 font-serif">
                <template x-if="cv.skills.languages && cv.skills.languages.length > 0">
                    <div>
                        <strong x-text="t('languages') + ': '">Technical & Academic Languages: </strong>
                        <span x-text="cv.skills.languages.join(', ')"></span>
                    </div>
                </template>
                <template x-if="cv.skills.frameworks && cv.skills.frameworks.length > 0">
                    <div>
                        <strong>Frameworks & Tools: </strong>
                        <span x-text="[...cv.skills.frameworks, ...(cv.skills.tools || [])].join(', ')"></span>
                    </div>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Trainings & Seminars --}}
    <template x-if="cv.trainings && cv.trainings.length > 0">
        <section class="mb-5 break-inside-avoid">
            <h2 class="text-xs font-serif font-bold uppercase tracking-wider pb-1 mb-2 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor"
                x-text="t('trainings')">
                TRAINING & SEMINARS
            </h2>

            <div class="space-y-2.5 font-serif">
                <template x-for="(train, tIdx) in cv.trainings" :key="train.id || tIdx">
                    <template x-if="train.title || train.institution">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between gap-2">
                                <span class="font-bold text-slate-900" x-text="train.title"></span>
                                <template x-if="train.startDate || train.endDate">
                                    <span class="text-xs font-semibold text-slate-700 shrink-0 whitespace-nowrap"
                                          x-text="formatDateRange(train.startDate, train.endDate)"></span>
                                </template>
                            </div>
                            <div class="flex flex-wrap items-baseline justify-between gap-x-3 text-xs italic text-slate-800">
                                <span x-text="train.institution"></span>
                                <template x-if="train.location">
                                    <span class="not-italic text-slate-600" x-text="train.location"></span>
                                </template>
                            </div>
                            <template x-if="train.field || train.subField">
                                <div class="text-[11px] text-slate-600 not-italic mt-0.5">
                                    <span x-text="train.field"></span><span x-show="train.field && train.subField"> / </span><span x-text="train.subField"></span>
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

    {{-- Section: Bahasa yang Dikuasai (Opsional) --}}
    <template x-if="cv.languages && cv.languages.length > 0">
        <section class="mb-5 break-inside-avoid">
            <h2 class="text-xs font-serif font-bold uppercase tracking-wider pb-1 mb-2 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor"
                x-text="t('languages_spoken')">
                LANGUAGES
            </h2>

            <ul class="list-disc list-outside ml-4 space-y-1 text-xs text-neutral-800 font-serif">
                <template x-for="(lang, lIdx) in cv.languages" :key="lang.id || lIdx">
                    <template x-if="lang.name">
                        <li class="pl-1">
                            <span class="font-bold text-neutral-900" x-text="lang.name"></span>
                            <template x-if="lang.level">
                                <span>: <span class="italic text-neutral-700" x-text="lang.level"></span></span>
                            </template>
                            <template x-if="lang.info">
                                <span class="text-neutral-600" x-text="' (' + lang.info + ')'"></span>
                            </template>
                        </li>
                    </template>
                </template>
            </ul>
        </section>
    </template>
</div>
