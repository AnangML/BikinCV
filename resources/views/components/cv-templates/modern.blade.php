{{-- Template 2: Modern Minimalist (ATS-Compliant) --}}
<div class="p-8 sm:p-12 text-slate-900 leading-relaxed">
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
                <span>TENTANG SAYA / PROFIL</span>
            </h2>
            <p class="text-slate-800 leading-normal text-justify" x-text="cv.personal.summary"></p>
        </section>
    </template>

    {{-- Section: Work Experience --}}
    <template x-if="cv.experiences && cv.experiences.length > 0">
        <section class="mb-5">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-3 border-b flex items-center justify-between"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                <span>PENGALAMAN KERJA</span>
            </h2>

            <div class="space-y-4">
                <template x-for="(exp, expIdx) in cv.experiences" :key="exp.id || expIdx">
                    <div class="break-inside-avoid">
                        <div class="flex items-baseline justify-between">
                            <span class="font-bold text-slate-900" x-text="exp.position || 'Jabatan'"></span>
                            <span class="text-xs font-semibold text-slate-500 whitespace-nowrap">
                                <span x-text="exp.startDate"></span> – <span x-text="exp.isCurrent ? 'Present' : exp.endDate"></span>
                            </span>
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
            </div>
        </section>
    </template>

    {{-- Section: Education --}}
    <template x-if="cv.educations && cv.educations.length > 0">
        <section class="mb-5 break-inside-avoid">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-3 border-b flex items-center justify-between"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                <span>PENDIDIKAN</span>
            </h2>

            <div class="space-y-3">
                <template x-for="(edu, eduIdx) in cv.educations" :key="edu.id || eduIdx">
                    <div class="break-inside-avoid">
                        <div class="flex items-baseline justify-between">
                            <span class="font-bold text-slate-900" x-text="edu.institution"></span>
                            <span class="text-xs font-semibold text-slate-500 whitespace-nowrap">
                                <span x-text="edu.startDate"></span> – <span x-text="edu.endDate"></span>
                            </span>
                        </div>
                        <div class="flex items-baseline justify-between text-xs text-slate-600">
                            <span x-text="edu.degree"></span>
                            <span x-text="edu.location"></span>
                        </div>
                        <template x-if="edu.gpa">
                            <div class="text-xs text-slate-600 mt-0.5">
                                <span>IPK: </span><span class="font-semibold text-slate-800" x-text="edu.gpa"></span>
                            </div>
                        </template>
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
        <section class="mb-5 break-inside-avoid">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-2 border-b flex items-center justify-between"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                <span>KEAHLIAN & TEKNOLOGI</span>
            </h2>

            <div class="space-y-1.5 text-xs">
                <template x-if="cv.skills.languages && cv.skills.languages.length > 0">
                    <div>
                        <span class="font-bold text-slate-900">Bahasa Pemrograman: </span>
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
        <section class="mb-5 break-inside-avoid">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-3 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                PROYEK UTAMA
            </h2>

            <div class="space-y-3">
                <template x-for="(proj, projIdx) in cv.projects" :key="proj.id || projIdx">
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
            </div>
        </section>
    </template>

    {{-- Section: Certifications (Opsional) --}}
    <template x-if="cv.certifications && cv.certifications.length > 0">
        <section class="break-inside-avoid">
            <h2 class="text-xs font-bold uppercase tracking-wider pb-1 mb-2 border-b"
                :style="'border-color: ' + accentColor + '; color: ' + accentColor">
                SERTIFIKASI & LISENSI
            </h2>

            <ul class="list-disc list-outside ml-4 space-y-1 text-xs text-slate-800">
                <template x-for="(cert, certIdx) in cv.certifications" :key="cert.id || certIdx">
                    <li class="pl-1">
                        <span class="font-bold" x-text="cert.name"></span>
                        <template x-if="cert.issuer">
                            <span> – <span x-text="cert.issuer"></span></span>
                        </template>
                        <template x-if="cert.year">
                            <span class="text-slate-500 font-medium"> (<span x-text="cert.year"></span>)</span>
                        </template>
                    </li>
                </template>
            </ul>
        </section>
    </template>
</div>
