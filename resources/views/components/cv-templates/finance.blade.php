{{-- Template 7: Finance & Wall Street Elite (Investment Banking & Consulting ATS Standard) --}}
<div class="cv-template-body text-black leading-relaxed">
    
    {{-- Header: Traditional Wall Street Center Alignment --}}
    <header class="text-center pb-3 mb-4 border-b border-black">
        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight uppercase"
            :style="'color: ' + accentColor"
            x-text="cv.personal.fullName || 'NAMA LENGKAP'"></h1>
        
        <p class="text-xs font-semibold tracking-widest text-neutral-800 mt-0.5 uppercase"
           x-text="cv.personal.jobTitle || 'TARGET POSISI / BIDANG KEAHLIAN'"></p>

        {{-- Contact Details with pipes/bullets --}}
        <div class="flex flex-wrap items-center justify-center gap-x-2 text-[11px] text-neutral-800 mt-1.5 font-normal">
            <template x-if="cv.personal.location">
                <span class="flex items-center gap-1.5">
                    <span x-text="cv.personal.location"></span>
                    <span class="text-neutral-400">•</span>
                </span>
            </template>
            <template x-if="cv.personal.phone">
                <span class="flex items-center gap-1.5">
                    <span x-text="cv.personal.phone"></span>
                    <span class="text-neutral-400">•</span>
                </span>
            </template>
            <template x-if="cv.personal.email">
                <span class="flex items-center gap-1.5">
                    <span x-text="cv.personal.email"></span>
                    <span class="text-neutral-400" x-show="cv.personal.linkedin || cv.personal.website">•</span>
                </span>
            </template>
            <template x-if="cv.personal.linkedin">
                <span class="flex items-center gap-1.5">
                    <span x-text="cv.personal.linkedin"></span>
                    <span class="text-neutral-400" x-show="cv.personal.website">•</span>
                </span>
            </template>
            <template x-if="cv.personal.website">
                <span x-text="cv.personal.website"></span>
            </template>
        </div>
    </header>

    {{-- Section: Education (Wall Street format places Education first) --}}
    <template x-if="cv.educations && cv.educations.length > 0">
        <section class="mb-4">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-0.5 mb-2 border-b border-black"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor"
                x-text="t('education')">
                EDUCATION
            </h2>

            <div class="space-y-2">
                <template x-for="(edu, eduIdx) in cv.educations" :key="edu.id || eduIdx">
                    <template x-if="edu.institution || edu.degree">
                        <div class="break-inside-avoid text-xs">
                            <div class="flex items-baseline justify-between font-bold gap-2">
                                <span class="uppercase tracking-tight" x-text="edu.institution"></span>
                                <template x-if="edu.startDate || edu.endDate">
                                    <span class="font-normal text-[11px] text-neutral-800 shrink-0 whitespace-nowrap"
                                          x-text="formatDateRange(edu.startDate, edu.endDate)"></span>
                                </template>
                            </div>
                            <div class="flex flex-wrap items-baseline justify-between gap-x-2 italic text-neutral-900">
                                <span x-text="edu.degree"></span>
                                <template x-if="edu.location">
                                    <span class="font-normal not-italic text-[11px] text-neutral-600" x-text="edu.location"></span>
                                </template>
                            </div>
                            <template x-if="edu.gpa && edu.gpa.trim().length > 0">
                                <div class="font-normal text-[11px] text-neutral-700 mt-0.5">
                                    <span x-text="t('gpa') + ': ' + edu.gpa"></span>
                                </div>
                            </template>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Professional Experience --}}
    <template x-if="cv.experiences && cv.experiences.length > 0">
        <section class="mb-4">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-0.5 mb-2 border-b border-black"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor"
                x-text="t('experience')">
                PROFESSIONAL EXPERIENCE
            </h2>

            <div class="space-y-3">
                <template x-for="(exp, expIdx) in cv.experiences" :key="exp.id || expIdx">
                    <template x-if="exp.position || exp.company">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between font-bold text-xs">
                                <span class="uppercase" x-text="exp.company"></span>
                                <span class="font-normal text-[11px] text-neutral-800" x-text="exp.location"></span>
                            </div>
                            <div class="flex items-baseline justify-between italic text-xs mb-1">
                                <span x-text="exp.position"></span>
                                <template x-if="exp.startDate || exp.endDate || exp.isCurrent">
                                    <span class="not-italic text-[11px] font-normal text-neutral-800"
                                          x-text="formatDateRange(exp.startDate, exp.endDate, exp.isCurrent)"></span>
                                </template>
                            </div>

                            <ul class="list-disc ml-4 space-y-1 text-xs text-neutral-900">
                                <template x-for="(bullet, bIdx) in exp.bullets" :key="bIdx">
                                    <template x-if="bullet && bullet.trim().length > 0">
                                        <li class="leading-normal pl-0.5" x-text="bullet"></li>
                                    </template>
                                </template>
                            </ul>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Professional Summary --}}
    <template x-if="cv.personal.summary">
        <section class="mb-4 break-inside-avoid">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-0.5 mb-1.5 border-b border-black"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor"
                x-text="t('summary')">
                EXECUTIVE SUMMARY
            </h2>
            <p class="text-xs text-neutral-900 leading-normal text-justify" x-text="cv.personal.summary"></p>
        </section>
    </template>

    {{-- Section: Featured Transactions / Projects --}}
    <template x-if="cv.projects && cv.projects.length > 0">
        <section class="mb-4">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-0.5 mb-2 border-b border-black"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor"
                x-text="t('projects')">
                LEADERSHIP & KEY PROJECTS
            </h2>

            <div class="space-y-2">
                <template x-for="(proj, projIdx) in cv.projects" :key="proj.id || projIdx">
                    <template x-if="proj.name">
                        <div class="break-inside-avoid text-xs">
                            <div class="flex items-baseline justify-between font-bold">
                                <span x-text="proj.name"></span>
                                <span class="font-normal italic text-[11px]" x-show="proj.role" x-text="proj.role"></span>
                            </div>
                            <p class="text-neutral-800 leading-normal" x-text="proj.description"></p>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Skills & Certifications --}}
    <template x-if="(cv.skills && (cv.skills.languages?.length || cv.skills.frameworks?.length || cv.skills.databases?.length || cv.skills.tools?.length)) || (cv.certifications && cv.certifications.length > 0)">
        <section class="break-inside-avoid">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-0.5 mb-1.5 border-b border-black"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor"
                x-text="t('skills')">
                SKILLS, CERTIFICATIONS & INTERESTS
            </h2>

            <div class="space-y-1 text-xs">
                <template x-if="cv.skills?.languages?.length">
                    <div>
                        <strong class="font-bold" x-text="t('languages') + ': '">Languages & Core:</strong>
                        <span class="text-neutral-900" x-text="cv.skills.languages.join(', ')"></span>
                    </div>
                </template>

                <template x-if="cv.skills?.frameworks?.length">
                    <div>
                        <strong class="font-bold">Frameworks & Methodologies:</strong>
                        <span class="text-neutral-900" x-text="cv.skills.frameworks.join(', ')"></span>
                    </div>
                </template>

                <template x-if="cv.skills?.tools?.length || cv.skills?.databases?.length">
                    <div>
                        <strong class="font-bold">Software & Tools:</strong>
                        <span class="text-neutral-900" x-text="[...(cv.skills.databases || []), ...(cv.skills.tools || [])].join(', ')"></span>
                    </div>
                </template>

                <template x-if="cv.certifications && cv.certifications.length > 0">
                    <div>
                        <strong class="font-bold" x-text="t('certifications') + ': '">Certifications & Licenses:</strong>
                        <span class="text-neutral-900">
                            <template x-for="(cert, cIdx) in cv.certifications" :key="cIdx">
                                <template x-if="cert.name">
                                    <span>
                                        <span class="font-semibold" x-text="cert.name"></span>
                                        <span x-show="cert.issuer" x-text="' (' + cert.issuer + ')'"></span>
                                        <span x-show="cert.score" x-text="' — ' + t('score') + ': ' + cert.score"></span>
                                        <span x-show="cert.issueDate || cert.year || cert.expiryDate" x-text="' [' + formatDateRange(cert.issueDate || cert.year, cert.expiryDate) + ']'"></span>
                                        <span x-show="cIdx < cv.certifications.length - 1">; </span>
                                    </span>
                                </template>
                            </template>
                        </span>
                    </div>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Pelatihan & Seminar (Opsional) --}}
    <template x-if="cv.trainings && cv.trainings.length > 0">
        <section class="break-inside-avoid">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-0.5 mb-2 border-b border-black"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor"
                x-text="t('trainings')">
                TRAINING & PROFESSIONAL DEVELOPMENT
            </h2>

            <div class="space-y-2">
                <template x-for="(train, tIdx) in cv.trainings" :key="train.id || tIdx">
                    <template x-if="train.title || train.institution">
                        <div class="break-inside-avoid text-xs">
                            <div class="flex items-baseline justify-between font-bold gap-2">
                                <span class="uppercase tracking-tight" x-text="train.title"></span>
                                <template x-if="train.startDate || train.endDate">
                                    <span class="font-normal text-[11px] text-neutral-800 shrink-0 whitespace-nowrap"
                                          x-text="formatDateRange(train.startDate, train.endDate)"></span>
                                </template>
                            </div>
                            <div class="flex flex-wrap items-baseline justify-between gap-x-2 italic text-neutral-900">
                                <span x-text="train.institution"></span>
                                <template x-if="train.location">
                                    <span class="font-normal not-italic text-[11px] text-neutral-600" x-text="train.location"></span>
                                </template>
                            </div>
                            <template x-if="train.field || train.subField">
                                <div class="font-normal text-[11px] text-neutral-700">
                                    <span x-text="train.field"></span><span x-show="train.field && train.subField"> — </span><span x-text="train.subField"></span>
                                </div>
                            </template>
                            <template x-if="train.description">
                                <p class="text-[11px] text-neutral-800 leading-normal mt-0.5" x-text="train.description"></p>
                            </template>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>
</div>
