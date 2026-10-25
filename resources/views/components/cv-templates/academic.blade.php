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
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                EDUCATION
            </h2>

            <div class="space-y-3">
                <template x-for="(edu, eduIdx) in cv.educations" :key="edu.id || eduIdx">
                    <template x-if="edu.institution || edu.degree">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between font-serif">
                                <span class="font-bold text-slate-900" x-text="edu.institution"></span>
                                <template x-if="edu.startDate || edu.endDate">
                                    <span class="text-xs font-semibold text-slate-700">
                                        <span x-text="edu.startDate"></span><span x-show="edu.startDate && edu.endDate"> – </span><span x-text="edu.endDate"></span>
                                    </span>
                                </template>
                            </div>
                            <div class="flex items-baseline justify-between text-xs italic text-slate-800">
                                <span x-text="edu.degree"></span>
                                <span x-text="edu.location"></span>
                            </div>
                            <template x-if="edu.gpa">
                                <div class="text-xs text-slate-700 mt-0.5">
                                    <span>GPA: <strong x-text="edu.gpa"></strong></span>
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
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                RESEARCH PROFILE & SUMMARY
            </h2>
            <p class="text-justify text-slate-800 text-xs leading-relaxed font-serif" x-text="cv.personal.summary"></p>
        </section>
    </template>

    {{-- Section 3: Professional & Academic Experience --}}
    <template x-if="cv.experiences && cv.experiences.length > 0">
        <section class="mb-5">
            <h2 class="text-xs font-serif font-bold uppercase tracking-wider pb-1 mb-3 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                RESEARCH & PROFESSIONAL EXPERIENCE
            </h2>

            <div class="space-y-4">
                <template x-for="(exp, expIdx) in cv.experiences" :key="exp.id || expIdx">
                    <template x-if="exp.position || exp.company">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between font-serif">
                                <span class="font-bold text-slate-900" x-text="exp.position"></span>
                                <template x-if="exp.startDate || exp.endDate || exp.isCurrent">
                                    <span class="text-xs font-semibold text-slate-700">
                                        <span x-text="exp.startDate"></span><span x-show="exp.startDate && (exp.isCurrent || exp.endDate)"> – </span><span x-text="exp.isCurrent ? 'Present' : exp.endDate"></span>
                                    </span>
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
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
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
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                HONORS, AWARDS & CERTIFICATIONS
            </h2>

            <ul class="list-disc list-outside ml-4 space-y-1 text-xs text-slate-800 font-serif">
                <template x-for="(cert, certIdx) in cv.certifications" :key="cert.id || certIdx">
                    <template x-if="cert.name">
                        <li class="pl-1">
                            <strong x-text="cert.name"></strong>
                            <template x-if="cert.issuer">
                                <span>, <span x-text="cert.issuer"></span></span>
                            </template>
                            <template x-if="cert.year">
                                <span> (<span x-text="cert.year"></span>)</span>
                            </template>
                        </li>
                    </template>
                </template>
            </ul>
        </section>
    </template>

    {{-- Section 6: Languages & Skills --}}
    <template x-if="(cv.skills.languages && cv.skills.languages.length > 0) || (cv.skills.tools && cv.skills.tools.length > 0)">
        <section class="break-inside-avoid">
            <h2 class="text-xs font-serif font-bold uppercase tracking-wider pb-1 mb-2 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                SKILLS & COMPETENCIES
            </h2>

            <div class="text-xs text-slate-800 space-y-1 font-serif">
                <template x-if="cv.skills.languages && cv.skills.languages.length > 0">
                    <div>
                        <strong>Technical & Academic Languages: </strong>
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
</div>
