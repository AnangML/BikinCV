{{-- Template 6: The Nordic Clean (Minimalist Scandinavian ATS Format) --}}
<div class="cv-template-body text-neutral-900 leading-relaxed">
    
    {{-- Header: Ultra-Clean Scandinavian Left Layout --}}
    <header class="pb-4 mb-5 border-b border-neutral-300">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-neutral-900"
                    :style="'color: ' + accentColor"
                    x-text="cv.personal.fullName || 'NAMA LENGKAP'"></h1>
                
                <p class="text-xs font-semibold tracking-wider text-neutral-500 mt-1 uppercase"
                   x-text="cv.personal.jobTitle || 'TARGET POSISI / BIDANG KEAHLIAN'"></p>
            </div>

            {{-- Compact Contact Details --}}
            <div class="text-[11px] text-neutral-500 space-y-0.5 text-left sm:text-right font-medium">
                <template x-if="cv.personal.email">
                    <div class="text-neutral-700" x-text="cv.personal.email"></div>
                </template>
                <div class="flex flex-wrap items-center gap-x-2 sm:justify-end">
                    <span x-text="cv.personal.phone"></span>
                    <span class="text-neutral-300" x-show="cv.personal.phone && cv.personal.location">•</span>
                    <span x-text="cv.personal.location"></span>
                </div>
                <div class="flex flex-wrap items-center gap-x-2 sm:justify-end text-neutral-600">
                    <template x-if="cv.personal.linkedin">
                        <span x-text="cv.personal.linkedin"></span>
                    </template>
                    <span class="text-neutral-300" x-show="cv.personal.linkedin && cv.personal.github">•</span>
                    <template x-if="cv.personal.github">
                        <span x-text="cv.personal.github"></span>
                    </template>
                    <span class="text-neutral-300" x-show="(cv.personal.linkedin || cv.personal.github) && cv.personal.website">•</span>
                    <template x-if="cv.personal.website">
                        <span x-text="cv.personal.website"></span>
                    </template>
                </div>
            </div>
        </div>
    </header>

    {{-- Section: Professional Summary --}}
    <template x-if="cv.personal.summary">
        <section class="mb-4.5 break-inside-avoid">
            <h2 class="text-[11px] font-bold uppercase tracking-[0.15em] text-neutral-400 pb-1 mb-2 border-b border-neutral-200">
                PROFIL PROFESIONAL
            </h2>
            <p class="text-neutral-800 leading-normal text-justify text-xs" x-text="cv.personal.summary"></p>
        </section>
    </template>

    {{-- Section: Work Experience --}}
    <template x-if="cv.experiences && cv.experiences.length > 0">
        <section class="mb-4.5">
            <h2 class="text-[11px] font-bold uppercase tracking-[0.15em] text-neutral-400 pb-1 mb-2.5 border-b border-neutral-200">
                PENGALAMAN KERJA
            </h2>

            <div class="space-y-3.5">
                <template x-for="(exp, expIdx) in cv.experiences" :key="exp.id || expIdx">
                    <template x-if="exp.position || exp.company">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between gap-2">
                                <div>
                                    <span class="font-bold text-neutral-900 text-xs" x-text="exp.position"></span>
                                    <span class="text-neutral-400 mx-1" x-show="exp.position && exp.company">|</span>
                                    <span class="font-medium text-neutral-600 text-xs" x-text="exp.company"></span>
                                </div>
                                <template x-if="exp.startDate || exp.endDate || exp.isCurrent">
                                    <div class="text-[11px] text-neutral-500 shrink-0 font-medium text-right">
                                        <span x-text="exp.startDate"></span>
                                        <span x-show="exp.startDate && (exp.isCurrent || exp.endDate)">–</span>
                                        <span x-text="exp.isCurrent ? 'Sekarang' : exp.endDate"></span>
                                    </div>
                                </template>
                            </div>

                            <div class="text-[11px] text-neutral-400 mb-1" x-show="exp.location" x-text="exp.location"></div>

                            <ul class="list-disc ml-4 space-y-1 text-neutral-700 text-xs marker:text-neutral-300">
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

    {{-- Section: Education --}}
    <template x-if="cv.educations && cv.educations.length > 0">
        <section class="mb-4.5">
            <h2 class="text-[11px] font-bold uppercase tracking-[0.15em] text-neutral-400 pb-1 mb-2.5 border-b border-neutral-200">
                RIWAYAT PENDIDIKAN
            </h2>

            <div class="space-y-2.5">
                <template x-for="(edu, eduIdx) in cv.educations" :key="edu.id || eduIdx">
                    <template x-if="edu.institution || edu.degree">
                        <div class="break-inside-avoid flex items-baseline justify-between gap-2">
                            <div>
                                <span class="font-bold text-neutral-900 text-xs" x-text="edu.institution"></span>
                                <div class="text-neutral-600 text-xs">
                                    <span x-text="edu.degree"></span>
                                    <span class="text-neutral-400" x-show="edu.gpa && edu.gpa.trim().length > 0" x-text="' — IPK: ' + edu.gpa"></span>
                                </div>
                            </div>
                            <template x-if="edu.startDate || edu.endDate">
                                <div class="text-[11px] text-neutral-500 font-medium shrink-0 text-right">
                                    <span x-text="edu.startDate"></span>
                                    <span x-show="edu.startDate && edu.endDate">–</span>
                                    <span x-text="edu.endDate"></span>
                                </div>
                            </template>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Skills & Competencies --}}
    <template x-if="cv.skills && (cv.skills.languages?.length || cv.skills.frameworks?.length || cv.skills.databases?.length || cv.skills.tools?.length)">
        <section class="mb-4.5 break-inside-avoid">
            <h2 class="text-[11px] font-bold uppercase tracking-[0.15em] text-neutral-400 pb-1 mb-2 border-b border-neutral-200">
                KEAHLIAN & KOMPETENSI
            </h2>

            <div class="space-y-1 text-xs">
                <template x-if="cv.skills.languages && cv.skills.languages.length > 0">
                    <div class="flex items-baseline">
                        <span class="w-36 font-semibold text-neutral-600 shrink-0 text-[11px]">Bahasa & Inti:</span>
                        <span class="text-neutral-800" x-text="cv.skills.languages.join(', ')"></span>
                    </div>
                </template>

                <template x-if="cv.skills.frameworks && cv.skills.frameworks.length > 0">
                    <div class="flex items-baseline">
                        <span class="w-36 font-semibold text-neutral-600 shrink-0 text-[11px]">Frameworks:</span>
                        <span class="text-neutral-800" x-text="cv.skills.frameworks.join(', ')"></span>
                    </div>
                </template>

                <template x-if="cv.skills.databases && cv.skills.databases.length > 0">
                    <div class="flex items-baseline">
                        <span class="w-36 font-semibold text-neutral-600 shrink-0 text-[11px]">Database:</span>
                        <span class="text-neutral-800" x-text="cv.skills.databases.join(', ')"></span>
                    </div>
                </template>

                <template x-if="cv.skills.tools && cv.skills.tools.length > 0">
                    <div class="flex items-baseline">
                        <span class="w-36 font-semibold text-neutral-600 shrink-0 text-[11px]">Tools & Cloud:</span>
                        <span class="text-neutral-800" x-text="cv.skills.tools.join(', ')"></span>
                    </div>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Featured Projects --}}
    <template x-if="cv.projects && cv.projects.length > 0">
        <section class="mb-4.5">
            <h2 class="text-[11px] font-bold uppercase tracking-[0.15em] text-neutral-400 pb-1 mb-2 border-b border-neutral-200">
                PROYEK PORTOFOLIO
            </h2>

            <div class="space-y-2.5">
                <template x-for="(proj, projIdx) in cv.projects" :key="proj.id || projIdx">
                    <template x-if="proj.name">
                        <div class="break-inside-avoid">
                            <div class="flex items-baseline justify-between gap-2">
                                <span class="font-bold text-neutral-900 text-xs" x-text="proj.name"></span>
                                <span class="text-[11px] text-neutral-500 font-medium" x-show="proj.role" x-text="proj.role"></span>
                            </div>
                            <p class="text-xs text-neutral-700 leading-normal" x-text="proj.description"></p>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Certifications --}}
    <template x-if="cv.certifications && cv.certifications.length > 0">
        <section class="break-inside-avoid">
            <h2 class="text-[11px] font-bold uppercase tracking-[0.15em] text-neutral-400 pb-1 mb-2 border-b border-neutral-200">
                SERTIFIKASI & LISENSI
            </h2>

            <div class="space-y-1 text-xs">
                <template x-for="(cert, cIdx) in cv.certifications" :key="cIdx">
                    <template x-if="cert.name">
                        <div class="flex items-baseline justify-between">
                            <div>
                                <span class="font-semibold text-neutral-900" x-text="cert.name"></span>
                                <span class="text-neutral-500" x-show="cert.issuer" x-text="' — ' + cert.issuer"></span>
                            </div>
                            <span class="text-[11px] text-neutral-500 font-medium shrink-0" x-text="cert.year"></span>
                        </div>
                    </template>
                </template>
            </div>
        </section>
    </template>

</div>
