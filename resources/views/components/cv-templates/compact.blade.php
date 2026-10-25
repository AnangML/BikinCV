{{-- Template 4: Compact One-Pager (ATS-Compliant / Freshgrad Space-Saver) --}}
<div class="p-6 sm:p-8 text-slate-900 leading-snug font-sans text-xs">
    {{-- Header: Ultra Space-Efficient --}}
    <header class="pb-2.5 mb-3 border-b-2" :style="'border-color: ' + accentColor">
        <div class="flex flex-col sm:flex-row sm:items-baseline justify-between">
            <h1 class="text-xl sm:text-2xl font-bold tracking-tight uppercase"
                :style="'color: ' + accentColor"
                x-text="cv.personal.fullName || 'NAMA LENGKAP'"></h1>
            
            <p class="text-xs font-semibold text-slate-700"
               x-text="cv.personal.jobTitle || 'Target Posisi'"></p>
        </div>

        {{-- Single-line Contact Bar --}}
        <div class="flex flex-wrap items-center gap-x-2 text-[11px] text-slate-600 mt-1">
            <template x-if="cv.personal.email">
                <span><span x-text="cv.personal.email"></span> •</span>
            </template>
            <template x-if="cv.personal.phone">
                <span><span x-text="cv.personal.phone"></span> •</span>
            </template>
            <template x-if="cv.personal.location">
                <span><span x-text="cv.personal.location"></span> •</span>
            </template>
            <template x-if="cv.personal.linkedin">
                <span><span x-text="cv.personal.linkedin"></span> •</span>
            </template>
            <template x-if="cv.personal.github">
                <span x-text="cv.personal.github"></span>
            </template>
        </div>
    </header>

    {{-- Section: Summary (Short & Dense) --}}
    <template x-if="cv.personal.summary">
        <section class="mb-3 break-inside-avoid">
            <h2 class="text-[11px] font-bold uppercase tracking-wider pb-0.5 mb-1 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                SUMMARY
            </h2>
            <p class="text-slate-800 leading-normal text-justify" x-text="cv.personal.summary"></p>
        </section>
    </template>

    {{-- Section: Education (Higher for Freshgrads) --}}
    <template x-if="cv.educations && cv.educations.length > 0">
        <section class="mb-3 break-inside-avoid">
            <h2 class="text-[11px] font-bold uppercase tracking-wider pb-0.5 mb-1.5 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                EDUCATION
            </h2>

            <div class="space-y-1.5">
                <template x-for="(edu, eduIdx) in cv.educations" :key="edu.id || eduIdx">
                    <div>
                        <div class="flex items-baseline justify-between font-bold text-slate-900">
                            <span x-text="edu.institution"></span>
                            <span class="text-[11px] font-semibold text-slate-600">
                                <span x-text="edu.startDate"></span> – <span x-text="edu.endDate"></span>
                            </span>
                        </div>
                        <div class="flex items-baseline justify-between text-slate-700">
                            <span x-text="edu.degree"></span>
                            <template x-if="edu.gpa">
                                <span>IPK: <strong x-text="edu.gpa"></strong></span>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Work Experience --}}
    <template x-if="cv.experiences && cv.experiences.length > 0">
        <section class="mb-3">
            <h2 class="text-[11px] font-bold uppercase tracking-wider pb-0.5 mb-1.5 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                EXPERIENCE
            </h2>

            <div class="space-y-2.5">
                <template x-for="(exp, expIdx) in cv.experiences" :key="exp.id || expIdx">
                    <div class="break-inside-avoid">
                        <div class="flex items-baseline justify-between">
                            <span class="font-bold text-slate-900" x-text="exp.position"></span>
                            <span class="text-[11px] font-semibold text-slate-600">
                                <span x-text="exp.startDate"></span> – <span x-text="exp.isCurrent ? 'Present' : exp.endDate"></span>
                            </span>
                        </div>

                        <div class="flex items-baseline justify-between text-slate-700 italic mb-0.5">
                            <span x-text="exp.company"></span>
                            <span x-text="exp.location"></span>
                        </div>

                        <ul class="list-disc list-outside ml-3.5 space-y-0.5 text-slate-800">
                            <template x-for="(bullet, bIdx) in exp.bullets" :key="bIdx">
                                <template x-if="bullet && bullet.trim().length > 0">
                                    <li class="pl-0.5 leading-snug" x-text="bullet"></li>
                                </template>
                            </template>
                        </ul>
                    </div>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Core Skills --}}
    <template x-if="(cv.skills.languages && cv.skills.languages.length > 0) || 
                    (cv.skills.frameworks && cv.skills.frameworks.length > 0) || 
                    (cv.skills.databases && cv.skills.databases.length > 0) || 
                    (cv.skills.tools && cv.skills.tools.length > 0)">
        <section class="mb-3 break-inside-avoid">
            <h2 class="text-[11px] font-bold uppercase tracking-wider pb-0.5 mb-1 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                SKILLS
            </h2>

            <div class="space-y-0.5 text-[11px]">
                <template x-if="cv.skills.languages && cv.skills.languages.length > 0">
                    <div>
                        <strong>Languages: </strong><span x-text="cv.skills.languages.join(', ')"></span>
                    </div>
                </template>
                <template x-if="cv.skills.frameworks && cv.skills.frameworks.length > 0">
                    <div>
                        <strong>Frameworks: </strong><span x-text="cv.skills.frameworks.join(', ')"></span>
                    </div>
                </template>
                <template x-if="cv.skills.databases && cv.skills.databases.length > 0">
                    <div>
                        <strong>Databases: </strong><span x-text="cv.skills.databases.join(', ')"></span>
                    </div>
                </template>
                <template x-if="cv.skills.tools && cv.skills.tools.length > 0">
                    <div>
                        <strong>Tools: </strong><span x-text="cv.skills.tools.join(', ')"></span>
                    </div>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Projects & Certifications Combined (Compact) --}}
    <template x-if="(cv.projects && cv.projects.length > 0) || (cv.certifications && cv.certifications.length > 0)">
        <section class="break-inside-avoid">
            <h2 class="text-[11px] font-bold uppercase tracking-wider pb-0.5 mb-1.5 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                PROJECTS & CERTIFICATIONS
            </h2>

            <div class="space-y-1.5">
                <template x-for="(proj, projIdx) in cv.projects" :key="proj.id || projIdx">
                    <div>
                        <div class="flex items-baseline justify-between font-bold text-slate-900">
                            <span x-text="proj.name"></span>
                            <span class="text-[11px] font-normal text-slate-500 font-mono" x-text="proj.link"></span>
                        </div>
                        <p class="text-[11px] text-slate-800 leading-snug" x-text="proj.description"></p>
                    </div>
                </template>

                <template x-if="cv.certifications && cv.certifications.length > 0">
                    <div class="pt-1 text-[11px]">
                        <strong>Certifications: </strong>
                        <template x-for="(cert, cIdx) in cv.certifications" :key="cert.id || cIdx">
                            <span>
                                <span x-text="cert.name"></span><span x-show="cert.year"> (<span x-text="cert.year"></span>)</span><span x-show="cIdx < cv.certifications.length - 1">, </span>
                            </span>
                        </template>
                    </div>
                </template>
            </div>
        </section>
    </template>
</div>
