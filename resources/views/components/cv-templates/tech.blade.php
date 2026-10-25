{{-- Template 3: Tech & Engineering Specialist (ATS-Compliant) --}}
<div class="p-8 sm:p-12 text-slate-900 leading-relaxed font-sans">
    {{-- Header: Compact & Developer-Centric --}}
    <header class="pb-4 mb-4 border-b-2" :style="'border-color: ' + accentColor">
        <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-1">
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight"
                :style="'color: ' + accentColor"
                x-text="cv.personal.fullName || 'Nama Lengkap'"></h1>
            
            <p class="text-sm font-semibold text-slate-700"
               x-text="cv.personal.jobTitle || 'Software Engineer'"></p>
        </div>

        {{-- Developer Links & Coordinates (Monospace Accents) --}}
        <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-slate-600 mt-2 font-mono">
            <template x-if="cv.personal.email">
                <span class="flex items-center gap-1">
                    <span class="text-slate-400">email:</span>
                    <span class="text-slate-800 font-medium" x-text="cv.personal.email"></span>
                </span>
            </template>
            <template x-if="cv.personal.phone">
                <span class="flex items-center gap-1">
                    <span class="text-slate-400">tel:</span>
                    <span class="text-slate-800 font-medium" x-text="cv.personal.phone"></span>
                </span>
            </template>
            <template x-if="cv.personal.location">
                <span class="flex items-center gap-1">
                    <span class="text-slate-400">loc:</span>
                    <span class="text-slate-800 font-medium" x-text="cv.personal.location"></span>
                </span>
            </template>
            <template x-if="cv.personal.github">
                <span class="flex items-center gap-1">
                    <span class="text-slate-400">gh:</span>
                    <span class="text-slate-800 font-medium" x-text="cv.personal.github"></span>
                </span>
            </template>
            <template x-if="cv.personal.linkedin">
                <span class="flex items-center gap-1">
                    <span class="text-slate-400">in:</span>
                    <span class="text-slate-800 font-medium" x-text="cv.personal.linkedin"></span>
                </span>
            </template>
        </div>
    </header>

    {{-- Section: Professional Summary --}}
    <template x-if="cv.personal.summary">
        <section class="mb-4 break-inside-avoid">
            <p class="text-xs text-slate-800 leading-normal text-justify" x-text="cv.personal.summary"></p>
        </section>
    </template>

    {{-- CRITICAL TECH SECTION: TECHNICAL SKILLS FIRST (ATS & Recruiter Favorite) --}}
    <template x-if="(cv.skills.languages && cv.skills.languages.length > 0) || 
                    (cv.skills.frameworks && cv.skills.frameworks.length > 0) || 
                    (cv.skills.databases && cv.skills.databases.length > 0) || 
                    (cv.skills.tools && cv.skills.tools.length > 0)">
        <section class="mb-5 break-inside-avoid bg-slate-50/80 p-3 rounded-lg border border-slate-200/80">
            <h2 class="text-xs font-bold uppercase tracking-wider mb-2"
                :style="'color: ' + accentColor">
                TECHNICAL SKILLS & COMPETENCIES
            </h2>

            <div class="space-y-1 text-xs">
                <template x-if="cv.skills.languages && cv.skills.languages.length > 0">
                    <div class="flex items-baseline">
                        <span class="w-32 font-bold text-slate-700 shrink-0">Languages:</span>
                        <span class="text-slate-900 font-mono font-medium" x-text="cv.skills.languages.join(' • ')"></span>
                    </div>
                </template>
                <template x-if="cv.skills.frameworks && cv.skills.frameworks.length > 0">
                    <div class="flex items-baseline">
                        <span class="w-32 font-bold text-slate-700 shrink-0">Frameworks:</span>
                        <span class="text-slate-900 font-mono font-medium" x-text="cv.skills.frameworks.join(' • ')"></span>
                    </div>
                </template>
                <template x-if="cv.skills.databases && cv.skills.databases.length > 0">
                    <div class="flex items-baseline">
                        <span class="w-32 font-bold text-slate-700 shrink-0">Databases:</span>
                        <span class="text-slate-900 font-mono font-medium" x-text="cv.skills.databases.join(' • ')"></span>
                    </div>
                </template>
                <template x-if="cv.skills.tools && cv.skills.tools.length > 0">
                    <div class="flex items-baseline">
                        <span class="w-32 font-bold text-slate-700 shrink-0">Tools & Cloud:</span>
                        <span class="text-slate-900 font-mono font-medium" x-text="cv.skills.tools.join(' • ')"></span>
                    </div>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Work Experience --}}
    <template x-if="cv.experiences && cv.experiences.length > 0">
        <section class="mb-5">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-3 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                ENGINEERING EXPERIENCE
            </h2>

            <div class="space-y-4">
                <template x-for="(exp, expIdx) in cv.experiences" :key="exp.id || expIdx">
                    <div class="break-inside-avoid">
                        <div class="flex items-baseline justify-between">
                            <span class="font-bold text-slate-900" x-text="exp.position"></span>
                            <span class="text-xs font-mono text-slate-500 whitespace-nowrap">
                                <span x-text="exp.startDate"></span> – <span x-text="exp.isCurrent ? 'Present' : exp.endDate"></span>
                            </span>
                        </div>

                        <div class="flex items-baseline justify-between text-xs text-slate-600 mb-1.5 font-medium">
                            <span class="font-semibold text-slate-800" x-text="exp.company"></span>
                            <span x-text="exp.location"></span>
                        </div>

                        <ul class="list-disc list-outside ml-4 space-y-1 text-xs text-slate-800">
                            <template x-for="(bullet, bIdx) in exp.bullets" :key="bIdx">
                                <template x-if="bullet && bullet.trim().length > 0">
                                    <li class="pl-1 leading-normal" x-text="bullet"></li>
                                </template>
                            </template>
                        </ul>
                    </div>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Key Projects (Prominent for Tech) --}}
    <template x-if="cv.projects && cv.projects.length > 0">
        <section class="mb-5 break-inside-avoid">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-3 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                PROJECTS & OPEN SOURCE
            </h2>

            <div class="space-y-3">
                <template x-for="(proj, projIdx) in cv.projects" :key="proj.id || projIdx">
                    <div class="break-inside-avoid">
                        <div class="flex items-baseline justify-between">
                            <div class="flex items-baseline gap-2">
                                <span class="font-bold text-xs text-slate-900" x-text="proj.name"></span>
                                <template x-if="proj.role">
                                    <span class="text-[11px] text-slate-500 italic">(<span x-text="proj.role"></span>)</span>
                                </template>
                            </div>
                            <template x-if="proj.link">
                                <span class="text-[11px] text-indigo-700 font-mono" x-text="proj.link"></span>
                            </template>
                        </div>
                        <p class="text-xs text-slate-800 leading-normal mt-0.5" x-text="proj.description"></p>
                    </div>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Education --}}
    <template x-if="cv.educations && cv.educations.length > 0">
        <section class="mb-4 break-inside-avoid">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-2 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                EDUCATION
            </h2>

            <div class="space-y-2">
                <template x-for="(edu, eduIdx) in cv.educations" :key="edu.id || eduIdx">
                    <div class="break-inside-avoid text-xs">
                        <div class="flex items-baseline justify-between">
                            <span class="font-bold text-slate-900" x-text="edu.institution"></span>
                            <span class="text-slate-500 font-mono">
                                <span x-text="edu.startDate"></span> – <span x-text="edu.endDate"></span>
                            </span>
                        </div>
                        <div class="flex items-baseline justify-between text-slate-600">
                            <span x-text="edu.degree"></span>
                            <template x-if="edu.gpa">
                                <span>GPA: <strong class="text-slate-800" x-text="edu.gpa"></strong></span>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Certifications --}}
    <template x-if="cv.certifications && cv.certifications.length > 0">
        <section class="break-inside-avoid">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-2 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                CERTIFICATIONS
            </h2>

            <div class="flex flex-wrap gap-x-4 gap-y-1 text-xs text-slate-800">
                <template x-for="(cert, certIdx) in cv.certifications" :key="cert.id || certIdx">
                    <div class="flex items-center gap-1">
                        <span class="text-indigo-600 font-bold">•</span>
                        <span class="font-semibold" x-text="cert.name"></span>
                        <template x-if="cert.issuer">
                            <span class="text-slate-600">(<span x-text="cert.issuer"></span>)</span>
                        </template>
                    </div>
                </template>
            </div>
        </section>
    </template>
</div>
