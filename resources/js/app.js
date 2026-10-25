import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

Alpine.plugin(collapse);

// Demo data standar industri untuk fresh start & tombol isi data demo
const DEFAULT_CV_DATA = {
    personal: {
        fullName: 'Budi Pratama',
        jobTitle: 'Senior Full Stack Software Engineer',
        email: 'budi.pratama@example.com',
        phone: '+62 812-3456-7890',
        location: 'Jakarta, Indonesia',
        linkedin: 'linkedin.com/in/budipratama',
        github: 'github.com/budipratama',
        website: 'budipratama.dev',
        summary: 'Software Engineer dengan pengalaman 5+ tahun membangun aplikasi web berskala besar dan API berkinerja tinggi. Berpengalaman memimpin tim engineering, mengoptimalkan database relasional, dan menerapkan arsitektur mikroservis berbasis cloud.'
    },
    experiences: [
        {
            id: 'exp_1',
            company: 'PT Solusi Teknologi Nusantara',
            position: 'Lead Full Stack Engineer',
            location: 'Jakarta',
            startDate: 'Jan 2022',
            endDate: 'Present',
            isCurrent: true,
            bullets: [
                'Merancang dan membangun ulang arsitektur sistem pembayaran microservice yang memproses 500.000+ transaksi harian dengan uptime 99.98%.',
                'Mengoptimalkan throughput database MySQL dan query latency sebesar 42% melalui strategi indeks komposit dan caching Redis multi-layer.',
                'Memimpin tim lintas disiplin beranggotakan 6 software engineer dalam implementasi metodologi Agile dan automated CI/CD pipeline.'
            ]
        },
        {
            id: 'exp_2',
            company: 'Inovasi Digital Studio',
            position: 'Software Engineer',
            location: 'Bandung',
            startDate: 'Agu 2019',
            endDate: 'Des 2021',
            isCurrent: false,
            bullets: [
                'Mengembangkan 12+ fitur core web e-commerce berbasis Laravel dan Tailwind CSS dengan fokus pada performa Core Web Vitals.',
                'Mengintegrasikan payment gateway pihak ketiga (Midtrans, Xendit) dengan enkripsi webhook signature yang aman.',
                'Menurunkan bundle size JavaScript aplikasi sebesar 35% melalui code splitting dan dynamic imports.'
            ]
        }
    ],
    educations: [
        {
            id: 'edu_1',
            institution: 'Universitas Indonesia',
            degree: 'Sarjana Komputer (S1 Teknik Informatika)',
            location: 'Depok, Jawa Barat',
            startDate: '2015',
            endDate: '2019',
            gpa: '3.82 / 4.00'
        }
    ],
    skills: {
        languages: ['PHP 8.3', 'JavaScript (ES6+)', 'TypeScript', 'SQL', 'HTML5/CSS3'],
        frameworks: ['Laravel', 'Vue.js', 'Alpine.js', 'Tailwind CSS', 'Node.js'],
        databases: ['MySQL', 'PostgreSQL', 'Redis'],
        tools: ['Git', 'Docker', 'AWS (EC2, S3)', 'Postman', 'Linux / Nginx']
    },
    certifications: [
        {
            id: 'cert_1',
            name: 'AWS Certified Solutions Architect – Associate',
            issuer: 'Amazon Web Services',
            year: '2024'
        },
        {
            id: 'cert_2',
            name: 'Laravel Certified Developer',
            issuer: 'Laravel LLC',
            year: '2023'
        }
    ],
    projects: [
        {
            id: 'proj_1',
            name: 'OpenResume - ATS Resume Engine',
            role: 'Creator & Maintainer',
            link: 'github.com/budipratama/open-resume',
            description: 'Platform open-source untuk validasi format dokumen resume terhadap standar parsing ATS dengan 1.200+ bintang GitHub.'
        }
    ]
};

// Component Alpine: cvEditor
window.cvEditor = function (initialConfig = {}) {
    return {
        // State Dokumen
        cv: initialConfig.cv || JSON.parse(JSON.stringify(DEFAULT_CV_DATA)),
        cvTitle: initialConfig.title || 'Resume Saya',
        currentCvId: initialConfig.cvId || null,
        selectedTemplate: initialConfig.template || 'classic',
        selectedFont: initialConfig.font || 'inter',
        docFontSize: initialConfig.fontSize || 'doc-size-base',
        accentColor: initialConfig.accentColor || '#111827',
        
        // Cloud Sync State
        isSavingCloud: false,
        cloudStatusMessage: '',

        // UI Navigation State
        activeSection: 'personal',
        mobileTab: 'form', // 'form' atau 'preview'
        zoomLevel: 100,
        isAutosaved: false,
        saveStatusText: 'Draft tersimpan di browser',
        lastSavedTime: '',
        showActionVerbsModal: false,
        showAtsAuditModal: false,
        isPageOverflowing: false,

        // Inisialisasi
        init() {
            if (!this.currentCvId) {
                this.loadFromStorage();
            }
            
            // Watch perubahan untuk autosave otomatis & cek overflow halaman
            this.$watch('cv', () => {
                this.saveToStorage();
                this.checkPageOverflow();
            }, { deep: true });

            this.$watch('cvTitle', () => this.saveToStorage());
            this.$watch('selectedTemplate', () => { this.saveToStorage(); this.checkPageOverflow(); });
            this.$watch('selectedFont', () => { this.saveToStorage(); this.checkPageOverflow(); });
            this.$watch('docFontSize', () => { this.saveToStorage(); this.checkPageOverflow(); });
            this.$watch('accentColor', () => this.saveToStorage());

            // Initial overflow check
            setTimeout(() => this.checkPageOverflow(), 500);
        },

        // Simpan ke Cloud Database
        async saveToCloud(isLoggedIn) {
            if (!isLoggedIn) {
                if (confirm('Anda belum masuk akun. Ingin masuk atau daftar akun baru agar CV tersimpan secara permanen di cloud?')) {
                    window.location.href = '/login';
                }
                return;
            }

            this.isSavingCloud = true;
            this.cloudStatusMessage = 'Menyimpan ke akun...';

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const response = await fetch('/cv/save', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        cv_id: this.currentCvId,
                        title: this.cvTitle || (this.cv.personal.fullName ? `CV - ${this.cv.personal.fullName}` : 'Resume Saya'),
                        content: this.cv,
                        template_id: this.selectedTemplate,
                        selected_font: this.selectedFont,
                        doc_font_size: this.docFontSize,
                        accent_color: this.accentColor,
                        ats_score: this.atsScore
                    })
                });

                const res = await response.json();
                if (res.success) {
                    this.currentCvId = res.cv.id;
                    this.cloudStatusMessage = 'Tersimpan di Cloud!';
                    setTimeout(() => { this.cloudStatusMessage = ''; }, 3000);
                    alert('Berhasil menyimpan CV ke akun Anda!');
                } else {
                    alert('Gagal menyimpan: ' + (res.message || 'Terjadi kesalahan'));
                }
            } catch (e) {
                console.error(e);
                alert('Gagal menghubungi server untuk menyimpan ke cloud.');
            } finally {
                this.isSavingCloud = false;
            }
        },

        // Cek apakah konten melebihi 1 halaman A4
        checkPageOverflow() {
            this.$nextTick(() => {
                const sheet = document.getElementById('cv-sheet');
                if (sheet) {
                    this.isPageOverflowing = sheet.scrollHeight > 1160;
                }
            });
        },

        // Autosave ke LocalStorage
        saveToStorage() {
            try {
                const payload = {
                    cv: this.cv,
                    title: this.cvTitle,
                    cvId: this.currentCvId,
                    selectedTemplate: this.selectedTemplate,
                    selectedFont: this.selectedFont,
                    docFontSize: this.docFontSize,
                    accentColor: this.accentColor
                };
                localStorage.setItem('bikincv_draft', JSON.stringify(payload));
                this.isAutosaved = true;
                const now = new Date();
                this.lastSavedTime = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                this.saveStatusText = `Tersimpan otomatis ${this.lastSavedTime}`;
            } catch (e) {
                console.warn('Gagal menyimpan ke localStorage', e);
            }
        },

        // Muat dari LocalStorage
        loadFromStorage() {
            try {
                const stored = localStorage.getItem('bikincv_draft');
                if (stored) {
                    const parsed = JSON.parse(stored);
                    if (parsed.cv) this.cv = parsed.cv;
                    if (parsed.title) this.cvTitle = parsed.title;
                    if (parsed.cvId) this.currentCvId = parsed.cvId;
                    if (parsed.selectedTemplate) this.selectedTemplate = parsed.selectedTemplate;
                    if (parsed.selectedFont) this.selectedFont = parsed.selectedFont;
                    if (parsed.docFontSize) this.docFontSize = parsed.docFontSize;
                    if (parsed.accentColor) this.accentColor = parsed.accentColor;
                }
            } catch (e) {
                console.warn('Gagal memuat dari localStorage', e);
            }
        },

        // Ekspor Backup JSON
        exportJson() {
            const dataStr = 'data:text/json;charset=utf-8,' + encodeURIComponent(JSON.stringify({
                app: 'BikinCV',
                version: '1.0',
                exportedAt: new Date().toISOString(),
                cv: this.cv,
                selectedTemplate: this.selectedTemplate,
                selectedFont: this.selectedFont,
                docFontSize: this.docFontSize,
                accentColor: this.accentColor
            }, null, 2));
            
            const dlAnchorElem = document.createElement('a');
            const safeName = (this.cv.personal.fullName || 'resume').toLowerCase().replace(/[^a-z0-9]/g, '-');
            dlAnchorElem.setAttribute('href', dataStr);
            dlAnchorElem.setAttribute('download', `cv-${safeName}.json`);
            dlAnchorElem.click();
        },

        // Import Restore JSON
        importJson(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = (e) => {
                try {
                    const parsed = JSON.parse(e.target.result);
                    if (parsed.cv) {
                        this.cv = parsed.cv;
                        if (parsed.selectedTemplate) this.selectedTemplate = parsed.selectedTemplate;
                        if (parsed.selectedFont) this.selectedFont = parsed.selectedFont;
                        if (parsed.docFontSize) this.docFontSize = parsed.docFontSize;
                        if (parsed.accentColor) this.accentColor = parsed.accentColor;
                        this.saveToStorage();
                        alert('Data CV berhasil diimpor dari file JSON!');
                    } else {
                        alert('Format file JSON tidak sesuai dengan standar BikinCV.');
                    }
                } catch (err) {
                    alert('Gagal membaca file JSON. Pastikan file valid.');
                }
                event.target.value = '';
            };
            reader.readAsText(file);
        },

        // Isi ulang dengan contoh data demo
        loadDemoData() {
            if (confirm('Muat contoh data demo? Seluruh data yang sedang diketik akan digantikan dengan data demo.')) {
                this.cv = JSON.parse(JSON.stringify(DEFAULT_CV_DATA));
                this.saveToStorage();
            }
        },

        // Bersihkan seluruh form
        resetForm() {
            if (confirm('Kosongkan semua data form untuk mulai dari awal?')) {
                this.cv = {
                    personal: { fullName: '', jobTitle: '', email: '', phone: '', location: '', linkedin: '', github: '', website: '', summary: '' },
                    experiences: [],
                    educations: [],
                    skills: { languages: [], frameworks: [], databases: [], tools: [] },
                    certifications: [],
                    projects: []
                };
                this.saveToStorage();
            }
        },

        // Laporan Audit ATS Mendalam
        get atsAudit() {
            const p = this.cv.personal;
            const actionVerbsList = ['merancang', 'membangun', 'mengembangkan', 'memimpin', 'meningkatkan', 'mengurangi', 'mengoptimalkan', 'mengintegrasikan', 'mengotomatisasi', 'spearheaded', 'developed', 'engineered', 'led', 'optimized', 'reduced', 'increased', 'managed'];
            
            // 1. Kategori Kontak (Max: 25)
            const contactItems = [
                {
                    title: 'Nama Lengkap Profesional',
                    passed: !!(p.fullName && p.fullName.trim().length >= 3),
                    tip: 'Cantumkan nama lengkap tanpa nama panggilan singkatan',
                    section: 'personal',
                    points: 5
                },
                {
                    title: 'Target Posisi / Jabatan Pekerjaan',
                    passed: !!(p.jobTitle && p.jobTitle.trim().length >= 3),
                    tip: 'Cantumkan posisi spesifik agar ATS mencocokkan relevansi loker',
                    section: 'personal',
                    points: 5
                },
                {
                    title: 'Alamat Email Aktif & Valid',
                    passed: !!(p.email && p.email.includes('@') && p.email.includes('.')),
                    tip: 'Gunakan email profesional berformat namamu@gmail.com',
                    section: 'personal',
                    points: 5
                },
                {
                    title: 'Nomor WhatsApp / Telepon',
                    passed: !!(p.phone && p.phone.trim().length >= 7),
                    tip: 'Pastikan nomor mudah dihubungi oleh HRD',
                    section: 'personal',
                    points: 5
                },
                {
                    title: 'Domisili / Kota Tempat Tinggal',
                    passed: !!(p.location && p.location.trim().length >= 3),
                    tip: 'Sertakan kota dan negara (contoh: Jakarta, Indonesia)',
                    section: 'personal',
                    points: 5
                }
            ];

            // 2. Kategori Ringkasan Profil (Max: 15)
            const summaryLen = p.summary ? p.summary.trim().length : 0;
            const summaryItems = [
                {
                    title: 'Ringkasan Profil Memikat (80 - 400 karakter)',
                    passed: summaryLen >= 80,
                    tip: summaryLen === 0 ? 'Tulis 2-3 kalimat pengantar keahlianmu' : (summaryLen < 80 ? 'Ringkasan masih terlalu singkat (minimal 80 karakter)' : 'Panjang ringkasan sudah sangat ideal'),
                    section: 'summary',
                    points: 15
                }
            ];

            // 3. Kategori Pengalaman Kerja (Max: 30)
            let hasExp = this.cv.experiences && this.cv.experiences.length > 0;
            let hasBullets = false;
            let hasActionVerbs = false;
            let hasMetrics = false;

            if (hasExp) {
                const metricRegex = /\d+|%|rp|usd|juta|ribu/i;
                this.cv.experiences.forEach(exp => {
                    if (exp.bullets && exp.bullets.length > 0) {
                        hasBullets = true;
                        exp.bullets.forEach(b => {
                            if (!b) return;
                            const firstWord = b.trim().split(' ')[0].toLowerCase();
                            if (actionVerbsList.some(v => firstWord.includes(v))) {
                                hasActionVerbs = true;
                            }
                            if (metricRegex.test(b)) {
                                hasMetrics = true;
                            }
                        });
                    }
                });
            }

            const expItems = [
                {
                    title: 'Minimal 1 Pengalaman Kerja Relevan',
                    passed: hasExp,
                    tip: 'Pengalaman kerja adalah bagian paling dinilai oleh ATS dan recruiter',
                    section: 'experience',
                    points: 10
                },
                {
                    title: 'Poin Pencapaian Terstruktur (Bullet Points)',
                    passed: hasBullets,
                    tip: 'Tulis tanggung jawab dalam poin-poin terpisah, bukan paragraf panjang',
                    section: 'experience',
                    points: 8
                },
                {
                    title: 'Penggunaan Kata Kerja Kuat (Action Verbs)',
                    passed: hasActionVerbs,
                    tip: 'Awali poin dengan kata kerja aksi aktif (misal: Merancang, Memimpin, Mengoptimalkan)',
                    section: 'experience',
                    points: 7
                },
                {
                    title: 'Menyertakan Angka / Hasil Terukur (Formula XYZ)',
                    passed: hasMetrics,
                    tip: 'Sertakan metrik nyata (contoh: "Meningkatkan 30%", "Memproses 500rb data")',
                    section: 'experience',
                    points: 5
                }
            ];

            // 4. Kategori Pendidikan (Max: 15)
            const hasEdu = this.cv.educations && this.cv.educations.length > 0;
            const hasDegree = hasEdu && !!this.cv.educations[0].degree;
            const eduItems = [
                {
                    title: 'Riwayat Pendidikan Formal',
                    passed: hasEdu,
                    tip: 'Cantumkan universitas atau sekolah terakhir',
                    section: 'education',
                    points: 10
                },
                {
                    title: 'Gelar / Jurusan & Tahun Lulus Jelas',
                    passed: hasDegree,
                    tip: 'Sebutkan jurusan spesifik dan tahun kelulusan',
                    section: 'education',
                    points: 5
                }
            ];

            // 5. Kategori Keahlian (Max: 15)
            const totalSkills = (this.cv.skills.languages?.length || 0) + 
                                (this.cv.skills.frameworks?.length || 0) + 
                                (this.cv.skills.databases?.length || 0) + 
                                (this.cv.skills.tools?.length || 0);
            const skillItems = [
                {
                    title: 'Minimal 6 Keahlian / Tech Stack Terdaftar',
                    passed: totalSkills >= 6,
                    tip: `Saat ini ada ${totalSkills} skill terdaftar. Tambahkan minimal 6 skill kata kunci`,
                    section: 'skills',
                    points: 15
                }
            ];

            // Hitung total skor dari seluruh checklist
            const calculateCategory = (items) => {
                let earned = 0;
                let max = 0;
                items.forEach(it => {
                    max += it.points;
                    if (it.passed) earned += it.points;
                });
                return { items, earned, max, pct: Math.round((earned / max) * 100) };
            };

            const catContact = calculateCategory(contactItems);
            const catSummary = calculateCategory(summaryItems);
            const catExp = calculateCategory(expItems);
            const catEdu = calculateCategory(eduItems);
            const catSkill = calculateCategory(skillItems);

            const totalScore = Math.min(100, catContact.earned + catSummary.earned + catExp.earned + catEdu.earned + catSkill.earned);

            return {
                totalScore,
                categories: [
                    { name: 'Data Diri & Kontak', ...catContact },
                    { name: 'Ringkasan Profil', ...catSummary },
                    { name: 'Pengalaman Kerja & Aksi', ...catExp },
                    { name: 'Pendidikan', ...catEdu },
                    { name: 'Keahlian (Skills)', ...catSkill }
                ]
            };
        },

        // Helper label skor ATS
        get atsScore() {
            return this.atsAudit.totalScore;
        },

        get atsBadge() {
            const score = this.atsScore;
            if (score >= 85) return { label: 'Sangat Siap ATS', color: 'emerald', bg: 'bg-emerald-500', text: 'text-emerald-700' };
            if (score >= 60) return { label: 'Cukup Baik', color: 'amber', bg: 'bg-amber-500', text: 'text-amber-700' };
            return { label: 'Perlu Dilengkapi', color: 'rose', bg: 'bg-rose-500', text: 'text-rose-700' };
        },

        // Jump langsung ke form section dari modal audit
        jumpToSection(sectionName) {
            this.activeSection = sectionName;
            this.showAtsAuditModal = false;
            this.mobileTab = 'form';
        },

        // Pengurutan (Reorder) Pengalaman Kerja
        moveExperience(index, direction) {
            const targetIndex = index + direction;
            if (targetIndex < 0 || targetIndex >= this.cv.experiences.length) return;
            const item = this.cv.experiences.splice(index, 1)[0];
            this.cv.experiences.splice(targetIndex, 0, item);
        },
        addExperience() {
            this.cv.experiences.unshift({
                id: 'exp_' + Date.now(),
                company: '',
                position: '',
                location: '',
                startDate: '',
                endDate: '',
                isCurrent: false,
                bullets: ['']
            });
            this.activeSection = 'experience';
        },
        removeExperience(index) {
            this.cv.experiences.splice(index, 1);
        },
        addBullet(expIndex) {
            this.cv.experiences[expIndex].bullets.push('');
        },
        removeBullet(expIndex, bulletIndex) {
            this.cv.experiences[expIndex].bullets.splice(bulletIndex, 1);
        },

        // Pengurutan (Reorder) Pendidikan
        moveEducation(index, direction) {
            const targetIndex = index + direction;
            if (targetIndex < 0 || targetIndex >= this.cv.educations.length) return;
            const item = this.cv.educations.splice(index, 1)[0];
            this.cv.educations.splice(targetIndex, 0, item);
        },
        addEducation() {
            this.cv.educations.unshift({
                id: 'edu_' + Date.now(),
                institution: '',
                degree: '',
                location: '',
                startDate: '',
                endDate: '',
                gpa: ''
            });
            this.activeSection = 'education';
        },
        removeEducation(index) {
            this.cv.educations.splice(index, 1);
        },

        // Skills
        addSkillTag(category, event) {
            const val = event.target.value.trim();
            if (val && !this.cv.skills[category].includes(val)) {
                this.cv.skills[category].push(val);
                event.target.value = '';
            }
        },
        removeSkillTag(category, index) {
            this.cv.skills[category].splice(index, 1);
        },

        // Pengurutan (Reorder) Proyek
        moveProject(index, direction) {
            const targetIndex = index + direction;
            if (targetIndex < 0 || targetIndex >= this.cv.projects.length) return;
            const item = this.cv.projects.splice(index, 1)[0];
            this.cv.projects.splice(targetIndex, 0, item);
        },
        addProject() {
            this.cv.projects.unshift({
                id: 'proj_' + Date.now(),
                name: '',
                role: '',
                link: '',
                description: ''
            });
            this.activeSection = 'projects';
        },
        removeProject(index) {
            this.cv.projects.splice(index, 1);
        },

        // Sertifikasi
        addCertification() {
            this.cv.certifications.unshift({
                id: 'cert_' + Date.now(),
                name: '',
                issuer: '',
                year: ''
            });
            this.activeSection = 'certifications';
        },
        removeCertification(index) {
            this.cv.certifications.splice(index, 1);
        },

        // Print CV langsung menggunakan browser print dialog
        printCv() {
            const previousTitle = document.title;
            const safeName = this.cv.personal.fullName ? this.cv.personal.fullName.trim() : 'Resume';
            document.title = `${safeName} - ATS Resume`;
            window.print();
            setTimeout(() => {
                document.title = previousTitle;
            }, 1000);
        }
    };
};

window.Alpine = Alpine;
Alpine.start();
