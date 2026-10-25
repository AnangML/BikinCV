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
window.cvEditor = function () {
    return {
        // State Dokumen
        cv: JSON.parse(JSON.stringify(DEFAULT_CV_DATA)),
        selectedTemplate: 'classic',
        selectedFont: 'inter',
        docFontSize: 'doc-size-base',
        accentColor: '#111827',
        
        // UI Navigation State
        activeSection: 'personal',
        mobileTab: 'form', // 'form' atau 'preview'
        zoomLevel: 100,
        isAutosaved: false,
        saveStatusText: 'Draft tersimpan di browser',
        lastSavedTime: '',
        showActionVerbsModal: false,

        // Inisialisasi
        init() {
            this.loadFromStorage();
            
            // Watch perubahan untuk autosave otomatis
            this.$watch('cv', () => {
                this.saveToStorage();
            }, { deep: true });

            this.$watch('selectedTemplate', () => this.saveToStorage());
            this.$watch('selectedFont', () => this.saveToStorage());
            this.$watch('docFontSize', () => this.saveToStorage());
            this.$watch('accentColor', () => this.saveToStorage());
        },

        // Autosave ke LocalStorage
        saveToStorage() {
            try {
                const payload = {
                    cv: this.cv,
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

        // Hitung ATS Score (0 - 100)
        get atsScore() {
            let score = 0;
            const p = this.cv.personal;

            // 1. Data Kontak (25 poin)
            if (p.fullName && p.fullName.trim().length > 2) score += 5;
            if (p.email && p.email.includes('@')) score += 5;
            if (p.phone && p.phone.trim().length > 6) score += 5;
            if (p.location && p.location.trim().length > 2) score += 5;
            if (p.linkedin && p.linkedin.trim().length > 5) score += 5;

            // 2. Ringkasan Profil (15 poin)
            if (p.summary && p.summary.trim().length >= 80) score += 15;
            else if (p.summary && p.summary.trim().length > 20) score += 8;

            // 3. Pengalaman Kerja (30 poin)
            if (this.cv.experiences && this.cv.experiences.length > 0) {
                score += 10;
                let hasActionVerbs = false;
                let hasBullets = false;

                const actionVerbs = ['merancang', 'membangun', 'mengembangkan', 'memimpin', 'meningkatkan', 'mengurangi', 'mengoptimalkan', 'mengintegrasikan', 'spearheaded', 'developed', 'engineered', 'led', 'optimized', 'reduced', 'increased', 'managed'];

                this.cv.experiences.forEach(exp => {
                    if (exp.bullets && exp.bullets.length > 0) {
                        hasBullets = true;
                        exp.bullets.forEach(b => {
                            const firstWord = b.trim().split(' ')[0].toLowerCase();
                            if (actionVerbs.some(verb => firstWord.includes(verb))) {
                                hasActionVerbs = true;
                            }
                        });
                    }
                });

                if (hasBullets) score += 10;
                if (hasActionVerbs) score += 10;
            }

            // 4. Pendidikan (15 poin)
            if (this.cv.educations && this.cv.educations.length > 0) {
                score += 15;
            }

            // 5. Skills (15 poin)
            const totalSkills = (this.cv.skills.languages?.length || 0) + 
                                (this.cv.skills.frameworks?.length || 0) + 
                                (this.cv.skills.databases?.length || 0) + 
                                (this.cv.skills.tools?.length || 0);
            if (totalSkills >= 8) score += 15;
            else if (totalSkills >= 4) score += 10;
            else if (totalSkills >= 1) score += 5;

            return Math.min(100, score);
        },

        // Helper label skor ATS
        get atsBadge() {
            const score = this.atsScore;
            if (score >= 85) return { label: 'Sangat Siap ATS', color: 'emerald', bg: 'bg-emerald-500' };
            if (score >= 60) return { label: 'Cukup Baik', color: 'amber', bg: 'bg-amber-500' };
            return { label: 'Perlu Dilengkapi', color: 'rose', bg: 'bg-rose-500' };
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
