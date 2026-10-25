{{-- Template 1: The Classic Executive (ATS-Compliant) --}}
<div class="cv-template-body text-slate-900 leading-relaxed">
    {{-- Header: Center-Aligned --}}
    <header class="text-center pb-4 mb-5 border-b-2" :style="'border-color: ' + accentColor">
        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight uppercase"
            :style="'color: ' + accentColor"
            x-text="cv.personal.fullName || 'NAMA LENGKAP'"></h1>
        
        <p class="text-sm font-semibold tracking-wide text-slate-700 mt-1 uppercase"
           x-text="cv.personal.jobTitle || 'Target Jabatan / Bidang Keahlian'"></p>

        {{-- Contact Details (Center aligned with bullets) --}}
        <div class="flex flex-wrap items-center justify-center gap-x-2 text-xs text-slate-600 mt-2 font-medium">
            <template x-if="cv.personal.phone">
                <span class="flex items-center gap-1">
                    <span x-text="cv.personal.phone"></span>
                    <span class="text-slate-400">•</span>
                </span>
            </template>
            <template x-if="cv.personal.email">
                <span class="flex items-center gap-1">
                    <span x-text="cv.personal.email"></span>
                    <span class="text-slate-400">•</span>
                </span>
            </template>
            <template x-if="cv.personal.location">
                <span class="flex items-center gap-1">
                    <span x-text="cv.personal.location"></span>
                    <span class="text-slate-400" x-show="cv.personal.linkedin || cv.personal.github || cv.personal.website">•</span>
                </span>
            </template>
            <template x-if="cv.personal.linkedin">
                <span class="flex items-center gap-1">
                    <span x-text="cv.personal.linkedin"></span>
                    <span class="text-slate-400" x-show="cv.personal.github || cv.personal.website">•</span>
                </span>
            </template>
            <template x-if="cv.personal.github">
                <span class="flex items-center gap-1">
                    <span x-text="cv.personal.github"></span>
                    <span class="text-slate-400" x-show="cv.personal.website">•</span>
                </span>
            </template>
            <template x-if="cv.personal.website">
                <span x-text="cv.personal.website"></span>
            </template>
        </div>
    </header>

    {{-- Section: Professional Summary --}}
    <template x-if="cv.personal.summary">
        <section class="mb-5 break-inside-avoid">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-2 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                PROFESSIONAL SUMMARY
            </h2>
            <p class="text-justify text-slate-800 leading-normal" x-text="cv.personal.summary"></p>
        </section>
    </template>

    {{-- Section: Work Experience --}}
    <template x-if="cv.experiences && cv.experiences.length > 0">
        <section class="mb-5">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-3 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                WORK EXPERIENCE
            </h2>

            <div class="space-y-4">
                <template x-for="(exp, expIdx) in cv.experiences" :key="exp.id || expIdx">
                    <template x-if="exp.position || exp.company">
                        <div class="break-inside-avoid">
                            {{-- Row 1: Position & Dates --}}
                            <div class="flex items-baseline justify-between">
                                <span class="font-bold text-slate-900" x-text="exp.position || 'Jabatan / Posisi'"></span>
                                <template x-if="exp.startDate || exp.endDate || exp.isCurrent">
                                    <span class="text-xs font-semibold text-slate-600 whitespace-nowrap">
                                        <span x-text="exp.startDate"></span><span x-show="exp.startDate && (exp.isCurrent || exp.endDate)"> – </span><span x-text="exp.isCurrent ? 'Present' : exp.endDate"></span>
                                    </span>
                                </template>
                            </div>

                            {{-- Row 2: Company & Location --}}
                            <div class="flex items-baseline justify-between text-xs italic text-slate-700 mb-1.5">
                                <span x-text="exp.company || 'Nama Perusahaan'"></span>
                                <span x-text="exp.location"></span>
                            </div>

                            {{-- Bullets --}}
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
        <section class="mb-5 break-inside-avoid">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-3 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                EDUCATION
            </h2>

            <div class="space-y-3">
                <template x-for="(edu, eduIdx) in cv.educations" :key="edu.id || eduIdx">
                    <template x-if="edu.institution || edu.degree">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between">
                                <span class="font-bold text-slate-900" x-text="edu.institution || 'Nama Universitas / Sekolah'"></span>
                                <template x-if="edu.startDate || edu.endDate">
                                    <span class="text-xs font-semibold text-slate-600 whitespace-nowrap">
                                        <span x-text="edu.startDate"></span><span x-show="edu.startDate && edu.endDate"> – </span><span x-text="edu.endDate"></span>
                                    </span>
                                </template>
                            </div>
                            <div class="flex items-baseline justify-between text-xs text-slate-700">
                                <span class="italic" x-text="edu.degree || 'Gelar / Jurusan'"></span>
                                <span x-text="edu.location"></span>
                            </div>
                            <template x-if="edu.gpa">
                                <div class="text-xs text-slate-600 mt-0.5">
                                    <span>IPK / GPA: </span><span class="font-semibold text-slate-800" x-text="edu.gpa"></span>
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
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-2 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                SKILLS & COMPETENCIES
            </h2>

            <div class="space-y-1.5 text-xs">
                <template x-if="cv.skills.languages && cv.skills.languages.length > 0">
                    <div>
                        <span class="font-bold text-slate-900">Languages: </span>
                        <span class="text-slate-800" x-text="cv.skills.languages.join(', ')"></span>
                    </div>
                </template>
                <template x-if="cv.skills.frameworks && cv.skills.frameworks.length > 0">
                    <div>
                        <span class="font-bold text-slate-900">Frameworks & Libraries: </span>
                        <span class="text-slate-800" x-text="cv.skills.frameworks.join(', ')"></span>
                    </div>
                </template>
                <template x-if="cv.skills.databases && cv.skills.databases.length > 0">
                    <div>
                        <span class="font-bold text-slate-900">Databases & Storage: </span>
                        <span class="text-slate-800" x-text="cv.skills.databases.join(', ')"></span>
                    </div>
                </template>
                <template x-if="cv.skills.tools && cv.skills.tools.length > 0">
                    <div>
                        <span class="font-bold text-slate-900">Tools & Technologies: </span>
                        <span class="text-slate-800" x-text="cv.skills.tools.join(', ')"></span>
                    </div>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Key Projects (Opsional) --}}
    <template x-if="cv.projects && cv.projects.length > 0">
        <section class="mb-5 break-inside-avoid">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-3 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                KEY PROJECTS
            </h2>

            <div class="space-y-3">
                <template x-for="(proj, projIdx) in cv.projects" :key="proj.id || projIdx">
                    <template x-if="proj.name">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between">
                                <span class="font-bold text-slate-900" x-text="proj.name"></span>
                                <template x-if="proj.link">
                                    <span class="text-xs text-slate-600 font-mono" x-text="proj.link"></span>
                                </template>
                            </div>
                            <template x-if="proj.role">
                                <div class="text-xs italic text-slate-600 mb-1" x-text="proj.role"></div>
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
        <section class="break-inside-avoid">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-2 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                CERTIFICATIONS
            </h2>

            <ul class="list-disc list-outside ml-4 space-y-1 text-xs text-slate-800">
                <template x-for="(cert, certIdx) in cv.certifications" :key="cert.id || certIdx">
                    <template x-if="cert.name">
                        <li class="pl-1">
                            <span class="font-bold" x-text="cert.name"></span>
                            <template x-if="cert.issuer">
                                <span> – <span x-text="cert.issuer"></span></span>
                            </template>
                            <template x-if="cert.year">
                                <span class="text-slate-600 font-medium"> (<span x-text="cert.year"></span>)</span>
                            </template>
                        </li>
                    </template>
                </template>
            </ul>
        </section>
    </template>
</div>
