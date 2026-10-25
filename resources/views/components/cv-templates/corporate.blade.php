{{-- Template 8: Corporate Enterprise (Fortune 500 & Operations ATS Standard) --}}
<div class="p-8 sm:p-11 text-neutral-900 leading-relaxed">
    
    {{-- Header: Corporate Split Header --}}
    <header class="pb-3 mb-4 border-b-2" :style="'border-color: ' + accentColor">
        <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-2">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight"
                    :style="'color: ' + accentColor"
                    x-text="cv.personal.fullName || 'NAMA LENGKAP'"></h1>
                
                <p class="text-xs font-semibold tracking-wide text-neutral-600 mt-0.5 uppercase"
                   x-text="cv.personal.jobTitle || 'TARGET POSISI / BIDANG KEAHLIAN'"></p>
            </div>

            {{-- Right: Compact Contact Grid --}}
            <div class="text-[11px] text-neutral-600 sm:text-right font-medium space-y-0.5">
                <div>
                    <span x-text="cv.personal.phone"></span>
                    <span class="text-neutral-300" x-show="cv.personal.phone && cv.personal.email">|</span>
                    <span class="text-neutral-900 font-semibold" x-text="cv.personal.email"></span>
                </div>
                <div>
                    <span x-text="cv.personal.location"></span>
                    <span class="text-neutral-300" x-show="cv.personal.location && (cv.personal.linkedin || cv.personal.website)">|</span>
                    <span x-text="cv.personal.linkedin || cv.personal.website"></span>
                </div>
            </div>
        </div>
    </header>

    {{-- Section: Executive Summary --}}
    <template x-if="cv.personal.summary">
        <section class="mb-4 break-inside-avoid">
            <div class="bg-neutral-100 px-2.5 py-1 mb-2 rounded-xs border-l-3"
                 :style="'border-color: ' + accentColor">
                <h2 class="text-[11px] font-bold uppercase tracking-wider text-neutral-900">
                    RINGKASAN EKSEKUTIF
                </h2>
            </div>
            <p class="text-xs text-neutral-800 leading-normal text-justify" x-text="cv.personal.summary"></p>
        </section>
    </template>

    {{-- Section: Work Experience --}}
    <template x-if="cv.experiences && cv.experiences.length > 0">
        <section class="mb-4">
            <div class="bg-neutral-100 px-2.5 py-1 mb-2.5 rounded-xs border-l-3"
                 :style="'border-color: ' + accentColor">
                <h2 class="text-[11px] font-bold uppercase tracking-wider text-neutral-900">
                    PENGALAMAN KERJA & PENCAPAIAN
                </h2>
            </div>

            <div class="space-y-3.5">
                <template x-for="(exp, expIdx) in cv.experiences" :key="exp.id || expIdx">
                    <div class="break-inside-avoid">
                        <div class="flex items-baseline justify-between gap-2">
                            <div>
                                <span class="font-bold text-neutral-900 text-xs" x-text="exp.position"></span>
                                <span class="text-neutral-400 mx-1">—</span>
                                <span class="font-semibold text-neutral-700 text-xs" x-text="exp.company"></span>
                            </div>
                            <div class="text-[11px] text-neutral-600 font-medium shrink-0 text-right">
                                <span x-text="exp.startDate"></span>
                                <span>–</span>
                                <span x-text="exp.isCurrent ? 'Sekarang' : exp.endDate"></span>
                            </div>
                        </div>

                        <div class="text-[11px] text-neutral-500 mb-1" x-show="exp.location" x-text="exp.location"></div>

                        <ul class="list-disc ml-4 space-y-1 text-xs text-neutral-800">
                            <template x-for="(bullet, bIdx) in exp.bullets" :key="bIdx">
                                <template x-if="bullet && bullet.trim().length > 0">
                                    <li class="leading-normal pl-0.5" x-text="bullet"></li>
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
        <section class="mb-4">
            <div class="bg-neutral-100 px-2.5 py-1 mb-2 rounded-xs border-l-3"
                 :style="'border-color: ' + accentColor">
                <h2 class="text-[11px] font-bold uppercase tracking-wider text-neutral-900">
                    LATAR BELAKANG PENDIDIKAN
                </h2>
            </div>

            <div class="space-y-2">
                <template x-for="(edu, eduIdx) in cv.educations" :key="edu.id || eduIdx">
                    <div class="break-inside-avoid flex items-baseline justify-between gap-2 text-xs">
                        <div>
                            <span class="font-bold text-neutral-900" x-text="edu.institution"></span>
                            <div class="text-neutral-700">
                                <span x-text="edu.degree"></span>
                                <span class="text-neutral-500" x-show="edu.gpa && edu.gpa.trim().length > 0" x-text="' (IPK: ' + edu.gpa + ')'"></span>
                            </div>
                        </div>
                        <div class="text-[11px] text-neutral-600 font-medium shrink-0 text-right">
                            <span x-text="edu.startDate"></span>
                            <span x-show="edu.startDate && edu.endDate">–</span>
                            <span x-text="edu.endDate"></span>
                        </div>
                    </div>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Skills & Technical Proficiencies --}}
    <template x-if="cv.skills && (cv.skills.languages?.length || cv.skills.frameworks?.length || cv.skills.databases?.length || cv.skills.tools?.length)">
        <section class="mb-4 break-inside-avoid">
            <div class="bg-neutral-100 px-2.5 py-1 mb-2 rounded-xs border-l-3"
                 :style="'border-color: ' + accentColor">
                <h2 class="text-[11px] font-bold uppercase tracking-wider text-neutral-900">
                    KEAHLIAN & KOMPETENSI UTAMA
                </h2>
            </div>

            <div class="space-y-1 text-xs">
                <template x-if="cv.skills.languages && cv.skills.languages.length > 0">
                    <div class="flex items-baseline">
                        <span class="w-36 font-semibold text-neutral-700 shrink-0 text-[11px]">Bahasa & Inti:</span>
                        <span class="text-neutral-900" x-text="cv.skills.languages.join(', ')"></span>
                    </div>
                </template>

                <template x-if="cv.skills.frameworks && cv.skills.frameworks.length > 0">
                    <div class="flex items-baseline">
                        <span class="w-36 font-semibold text-neutral-700 shrink-0 text-[11px]">Frameworks:</span>
                        <span class="text-neutral-900" x-text="cv.skills.frameworks.join(', ')"></span>
                    </div>
                </template>

                <template x-if="cv.skills.databases && cv.skills.databases.length > 0">
                    <div class="flex items-baseline">
                        <span class="w-36 font-semibold text-neutral-700 shrink-0 text-[11px]">Database:</span>
                        <span class="text-neutral-900" x-text="cv.skills.databases.join(', ')"></span>
                    </div>
                </template>

                <template x-if="cv.skills.tools && cv.skills.tools.length > 0">
                    <div class="flex items-baseline">
                        <span class="w-36 font-semibold text-neutral-700 shrink-0 text-[11px]">Tools & Sistem:</span>
                        <span class="text-neutral-900" x-text="cv.skills.tools.join(', ')"></span>
                    </div>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Projects --}}
    <template x-if="cv.projects && cv.projects.length > 0">
        <section class="mb-4">
            <div class="bg-neutral-100 px-2.5 py-1 mb-2 rounded-xs border-l-3"
                 :style="'border-color: ' + accentColor">
                <h2 class="text-[11px] font-bold uppercase tracking-wider text-neutral-900">
                    PROYEK STRATEGIS & KEPEMIMPINAN
                </h2>
            </div>

            <div class="space-y-2">
                <template x-for="(proj, projIdx) in cv.projects" :key="proj.id || projIdx">
                    <div class="break-inside-avoid text-xs">
                        <div class="flex items-baseline justify-between gap-2">
                            <span class="font-bold text-neutral-900" x-text="proj.name"></span>
                            <span class="text-[11px] text-neutral-500 font-medium" x-show="proj.role" x-text="proj.role"></span>
                        </div>
                        <p class="text-neutral-800 leading-normal" x-text="proj.description"></p>
                    </div>
                </template>
            </div>
        </section>
    </template>

    {{-- Section: Certifications --}}
    <template x-if="cv.certifications && cv.certifications.length > 0">
        <section class="break-inside-avoid">
            <div class="bg-neutral-100 px-2.5 py-1 mb-2 rounded-xs border-l-3"
                 :style="'border-color: ' + accentColor">
                <h2 class="text-[11px] font-bold uppercase tracking-wider text-neutral-900">
                    SERTIFIKASI PROFESIONAL
                </h2>
            </div>

            <div class="space-y-1 text-xs">
                <template x-for="(cert, cIdx) in cv.certifications" :key="cIdx">
                    <div class="flex items-baseline justify-between">
                        <div>
                            <span class="font-semibold text-neutral-900" x-text="cert.name"></span>
                            <span class="text-neutral-600" x-show="cert.issuer" x-text="' — ' + cert.issuer"></span>
                        </div>
                        <span class="text-[11px] text-neutral-500 font-medium shrink-0" x-text="cert.year"></span>
                    </div>
                </template>
            </div>
        </section>
    </template>

</div>
