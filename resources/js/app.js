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
            score: '890 / 1000',
            issueDate: 'Jan 2024',
            expiryDate: 'Jan 2027',
            year: '2024'
        },
        {
            id: 'cert_2',
            name: 'Laravel Certified Developer',
            issuer: 'Laravel LLC',
            score: '',
            issueDate: 'Agu 2023',
            expiryDate: 'Seumur Hidup',
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
    ],
    trainings: [
        {
            id: 'train_1',
            institution: 'Kementerian Komunikasi dan Digital (Digital Talent Scholarship)',
            title: 'Full Stack Web Developer Professional',
            field: 'Teknologi Informasi dan Komunikasi',
            subField: 'Web Development',
            location: 'Jakarta Selatan',
            startDate: 'Jul 2023',
            endDate: 'Okt 2023',
            description: 'Pelatihan intensif 300+ jam mencakup perancangan RESTful API, arsitektur database relasional, dan deployment aplikasi cloud.'
        }
    ]
};

// Data pengujian multi-page (3+ lembar A4) dengan pengalaman kerja ekstensif 10+ tahun
const MULTIPAGE_CV_DATA = {
    personal: {
        fullName: 'Budi Pratama, M.Kom.',
        jobTitle: 'Principal Software Architect & Engineering Lead',
        email: 'budi.pratama@example.com',
        phone: '+62 812-3456-7890',
        location: 'Jakarta Selatan, DKI Jakarta',
        linkedin: 'linkedin.com/in/budipratama',
        github: 'github.com/budipratama',
        website: 'budipratama.dev',
        summary: 'Principal Software Architect dengan pengalaman 10+ tahun dalam merancang dan memimpin pengembangan arsitektur cloud terdistribusi berskala jutaan pengguna. Berpengalaman memimpin tim engineering multidisiplin hingga 25+ insinyur perangkat lunak, mentransformasi sistem monolitik menuju event-driven microservices berkinerja tinggi, serta mengoptimalkan throughput transaksi perbankan dan e-commerce dengan SLA 99.99%.'
    },
    experiences: [
        {
            id: 'exp_1',
            company: 'PT Toko Karya Teknologi Nusantara',
            position: 'Principal Software Architect',
            location: 'Jakarta Selatan',
            startDate: 'Jan 2023',
            endDate: 'Present',
            isCurrent: true,
            bullets: [
                'Memimpin re-platforming sistem core checkout & payment ke arsitektur microservices berbasis event-driven (Kafka, Go, Laravel) yang memproses 1.200.000+ transaksi harian.',
                'Mengurangi latensi P99 API gateway sebesar 55% (dari 320ms menjadi 144ms) melalui strategi composite multi-tier caching menggunakan Redis Cluster dan CDN edge compute.',
                'Mengarahkan standarisasi platform engineering, automated canary deployments, dan infrastruktur zero-downtime deployment menggunakan Kubernetes dan ArgoCD.',
                'Membina 4 Software Engineering Manager dan 20+ software engineer dalam penerapan domain-driven design (DDD) dan sistem pengujian otomatis berbasis TDD.'
            ]
        },
        {
            id: 'exp_2',
            company: 'Unicorn Fintech Global Asia',
            position: 'Senior Software Engineering Manager',
            location: 'Jakarta Pusat',
            startDate: 'Mar 2021',
            endDate: 'Des 2022',
            isCurrent: false,
            bullets: [
                'Membangun dari awal sistem deteksi fraud transaksi kartu kredit dan dompet digital berbasis scoring real-time yang menyelamatkan potensi kerugian Rp 14 Miliar per tahun.',
                'Mengoptimalkan arsitektur database relasional PostgreSQL sharding dan read-replica yang melayani hingga 8.500 queries per second (QPS) pada jam puncak.',
                'Mengurangi insiden downtime kritis pada environment production sebesar 70% melalui penerapan distributed tracing OpenTelemetry dan error budgeting (SRE).',
                'Memimpin inisiatif pemenuhan standar regulasi perbankan PCI-DSS Level 1 dan audit keamanan ISO 27001.'
            ]
        },
        {
            id: 'exp_3',
            company: 'PT Solusi Awan Digital Internasional',
            position: 'Staff Backend & Cloud Infrastructure Engineer',
            location: 'Jakarta Selatan',
            startDate: 'Jan 2019',
            endDate: 'Feb 2021',
            isCurrent: false,
            bullets: [
                'Merancang pipeline data ingestion analitik data besar yang memproses 10+ TB data log harian menggunakan Apache Kafka, AWS S3, dan Snowflake.',
                'Mengotomatisasi provisi infrastruktur multi-cloud (AWS & GCP) berbasis Infrastructure-as-Code (Terraform) dengan 100% konsistensi environment staging dan production.',
                'Menghemat biaya operasional infrastruktur cloud sebesar 38% ($45.000/tahun) dengan menerapkan instance autoscaling dinamis dan container spot instances.',
                'Membangun framework microservice internal berbasis Laravel Octane dan gRPC yang diadopsi oleh 8 tim produk berbeda.'
            ]
        },
        {
            id: 'exp_4',
            company: 'PT Mega Pratama Informatika',
            position: 'Senior Full Stack Software Engineer',
            location: 'Bandung, Jawa Barat',
            startDate: 'Agu 2017',
            endDate: 'Des 2018',
            isCurrent: false,
            bullets: [
                'Mengembangkan 15+ modul core pada platform ERP SaaS untuk manufaktur terintegrasi berbasis Laravel, PostgreSQL, dan Vue.js.',
                'Mengimplementasikan asynchronous job queue processing dengan Redis yang mempercepat laporan rekapitulasi inventaris dari 45 menit menjadi 2 menit.',
                'Membangun RESTful API public berstandar OpenAPI dengan rate limiting bertingkat dan dokumentasi interaktif Swagger.'
            ]
        },
        {
            id: 'exp_5',
            company: 'Digital Alpha Studio Kreatif',
            position: 'Mid-Level Web Application Developer',
            location: 'Bandung, Jawa Barat',
            startDate: 'Jan 2016',
            endDate: 'Jul 2017',
            isCurrent: false,
            bullets: [
                'Membangun antarmuka pengguna web interaktif responsif untuk 8 klien korporasi dengan fokus aksesibilitas WCAG 2.1 AA.',
                'Mengoptimalkan frontend rendering dan Core Web Vitals (LCP < 1.8 detik, CLS 0) yang meningkatkan conversion rate pelanggan e-commerce sebesar 22%.',
                'Mengintegrasikan payment gateway nasional (Midtrans, DOKU, Xendit) dengan sistem proteksi webhook idempotent.'
            ]
        },
        {
            id: 'exp_6',
            company: 'PT Rekayasa Cipta Piranti Lunak',
            position: 'Junior Web & Database Programmer',
            location: 'Depok, Jawa Barat',
            startDate: 'Agu 2014',
            endDate: 'Des 2015',
            isCurrent: false,
            bullets: [
                'Mengembangkan sistem manajemen konten (CMS) berbasis PHP dan MySQL untuk portal berita dengan 100.000 pengunjung bulanan.',
                'Membuat skrip migrasi database otomatis dan perancangan indeks query untuk mempercepat waktu pencarian artikel sebesar 60%.',
                'Melakukan bug fixing dan pemeliharaan rutin modul autentikasi pengguna dan hak akses berbasis role (RBAC).'
            ]
        }
    ],
    educations: [
        {
            id: 'edu_1',
            institution: 'Universitas Indonesia',
            degree: 'Magister Ilmu Komputer (S2 - Rekayasa Perangkat Lunak)',
            location: 'Kebayoran Lama Selatan, Kebayoran Lama, KOTA ADM. JAKARTA SELATAN, DKI JAKARTA',
            startDate: '2018',
            endDate: '2020',
            gpa: '3.92 / 4.00 (Cum Laude)'
        },
        {
            id: 'edu_2',
            institution: 'Institut Teknologi Bandung',
            degree: 'Sarjana Teknik Informatika (S1 Teknik Informatika)',
            location: 'Jl. Ganesha No. 10, Lebak Siliwangi, Coblong, KOTA BANDUNG, JAWA BARAT',
            startDate: '2010',
            endDate: '2014',
            gpa: '3.78 / 4.00'
        }
    ],
    skills: {
        languages: ['PHP 8.3', 'JavaScript (ES6+)', 'TypeScript', 'Golang', 'Python', 'SQL', 'HTML5/CSS3'],
        frameworks: ['Laravel 11', 'Vue.js 3', 'Alpine.js', 'Tailwind CSS', 'Node.js', 'NestJS', 'Symfony'],
        databases: ['PostgreSQL', 'MySQL', 'Redis Cluster', 'MongoDB', 'Elasticsearch'],
        tools: ['AWS (EC2, S3, RDS, Lambda)', 'Docker', 'Kubernetes', 'Terraform', 'Kafka', 'Git', 'CI/CD GitHub Actions', 'Linux / Nginx']
    },
    projects: [
        {
            id: 'proj_1',
            name: 'OpenResume - Universal ATS Resume Engine',
            role: 'Lead Creator & Maintainer',
            link: 'github.com/budipratama/open-resume',
            description: 'Engine open-source untuk validasi tata letak dan parsing CV terhadap algoritma sistem Applicant Tracking System (ATS) dengan 2.500+ bintang GitHub dan ribuan pengguna global.'
        },
        {
            id: 'proj_2',
            name: 'FinCore - Ultra High-Throughput Payment Engine',
            role: 'Chief Architect',
            link: 'fincore-engine.internal',
            description: 'Arsitektur payment core berlatensi rendah dengan ledger akuntansi ganda terdistribusi dan audit trail kriptografi yang memproses transaksi bernilai Rp 50+ Miliar/bulan.'
        },
        {
            id: 'proj_3',
            name: 'TraceKit - Distributed Observability Toolkit',
            role: 'Core Contributor',
            link: 'github.com/budipratama/tracekit',
            description: 'Pustaka open-source lightweight untuk instrumentasi log terstruktur dan distributed tracing OpenTelemetry pada framework PHP modern.'
        },
        {
            id: 'proj_4',
            name: 'SmartLogistics Real-Time Routing Engine',
            role: 'Full Stack Architect',
            link: 'smartlogistics.tech',
            description: 'Platform dispatching armada kurir logistik berbasis optimasi rute algoritma Dijkstra dan WebSocket geolokasi real-time untuk 500+ kurir harian.'
        }
    ],
    certifications: [
        {
            id: 'cert_1',
            name: 'AWS Certified Solutions Architect – Professional (SAP-C02)',
            issuer: 'Amazon Web Services',
            score: '920 / 1000',
            issueDate: 'Jan 2024',
            expiryDate: 'Jan 2027',
            year: '2024'
        },
        {
            id: 'cert_2',
            name: 'Certified Kubernetes Administrator (CKA)',
            issuer: 'The Linux Foundation / CNCF',
            score: '94 / 100',
            issueDate: 'Mar 2023',
            expiryDate: 'Mar 2026',
            year: '2023'
        },
        {
            id: 'cert_3',
            name: 'Laravel Certified Developer – Professional Level',
            issuer: 'Laravel LLC',
            score: 'Terverifikasi Sangat Baik',
            issueDate: 'Agu 2022',
            expiryDate: 'Seumur Hidup',
            year: '2022'
        },
        {
            id: 'cert_4',
            name: 'HashiCorp Certified: Terraform Associate',
            issuer: 'HashiCorp',
            score: '88 / 100',
            issueDate: 'Nov 2023',
            expiryDate: 'Nov 2025',
            year: '2023'
        }
    ],
    trainings: [
        {
            id: 'train_1',
            institution: 'Kementerian Komunikasi dan Digital (Digital Talent Scholarship)',
            title: 'Advanced Cloud Computing Architecture & Distributed Systems',
            field: 'Teknologi Informasi dan Komunikasi',
            subField: 'Cloud Infrastructure & Architecture',
            location: 'Jakarta Selatan, DKI Jakarta',
            startDate: 'Jul 2023',
            endDate: 'Okt 2023',
            description: 'Pelatihan intensif 320+ jam mencakup perancangan sistem high-availability, microservices deployment pada AWS multi-region, serta implementasi sistem event-driven berbasis Kafka.'
        },
        {
            id: 'train_2',
            institution: 'Google Cloud Enterprise Academy',
            title: 'Kubernetes Enterprise Architecture & Istio Service Mesh',
            field: 'DevOps & Site Reliability Engineering',
            subField: 'Container Orchestration',
            location: 'Jakarta Pusat / Hybrid',
            startDate: 'Feb 2023',
            endDate: 'Apr 2023',
            description: 'Pendalaman arsitektur container enterprise, traffic management, canary release automation, dan zero-trust mTLS security dengan Istio Service Mesh.'
        },
        {
            id: 'train_3',
            institution: 'Executive Technology Leadership Institute',
            title: 'Strategic Engineering Leadership & Agile Engineering Organization',
            field: 'Manajemen Rekayasa Perangkat Lunak',
            subField: 'Engineering Management',
            location: 'BSD City, Tangerang Selatan',
            startDate: 'Agu 2022',
            endDate: 'Sep 2022',
            description: 'Program eksekutif untuk pengelolaan kapasitas organisasi teknologi, penyusunan technical roadmap produk, pengelolaan error budgeting (SRE), dan pembinaan talenta insinyur senior.'
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
        showPrintGuideModal: false,
        dontShowPrintGuide: localStorage.getItem('bikincv_hide_print_tips') === 'true',
        isPageOverflowing: false,
        totalPages: 1,
        isMultiPageDismissed: false,

        // Helper Pemetaan Font Family
        getFontFamily(fontKey) {
            const fonts = {
                inter: "'Inter', sans-serif",
                roboto: "'Roboto', sans-serif",
                jakarta: "'Plus Jakarta Sans', sans-serif",
                arial: "Arial, Helvetica, sans-serif",
                merriweather: "'Merriweather', Georgia, serif",
                georgia: "Georgia, Cambria, 'Times New Roman', serif",
                garamond: "'EB Garamond', Garamond, 'Times New Roman', serif"
            };
            return fonts[fontKey] || "'Inter', sans-serif";
        },

        // Inisialisasi
        init() {
            if (!this.currentCvId) {
                this.loadFromStorage();
            }
            if (!Array.isArray(this.cv.trainings)) {
                this.cv.trainings = [];
            }
            
            // Watch perubahan untuk autosave otomatis & cek overflow halaman
            this.$watch('cv', () => {
                this.saveToStorage();
                this.checkPageOverflow();
            }, { deep: true });

            this.$watch('cvTitle', () => this.saveToStorage());
            this.$watch('selectedTemplate', () => { 
                this.saveToStorage(); 
                this.checkPageOverflow(); 
                setTimeout(() => this.checkPageOverflow(), 120);
            });
            this.$watch('selectedFont', () => { this.saveToStorage(); this.checkPageOverflow(); });
            this.$watch('docFontSize', () => { this.saveToStorage(); this.checkPageOverflow(); });
            this.$watch('accentColor', () => this.saveToStorage());
            this.$watch('zoomLevel', () => this.checkPageOverflow());

            // Initial overflow check
            setTimeout(() => this.checkPageOverflow(), 500);
        },

        // Simpan ke Cloud Database (Tanpa login)
        async saveToCloud() {
            this.isSavingCloud = true;
            this.cloudStatusMessage = 'Menyimpan ke cloud...';

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
                    this.cloudStatusMessage = 'Tersimpan!';
                    setTimeout(() => { this.cloudStatusMessage = ''; }, 3000);
                    alert('Berhasil menyimpan CV ke cloud server! Link dokumen Anda: ' + window.location.origin + '/?id=' + res.cv.id);
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
                    if (parsed.cv) {
                        this.cv = parsed.cv;
                        if (!Array.isArray(this.cv.trainings)) {
                            this.cv.trainings = [];
                        }
                    }
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

        // Isi ulang dengan contoh data demo (default 1 lembar atau multipage 3+ lembar)
        loadDemoData(variant = 'default') {
            const isMulti = variant === 'multipage';
            const label = isMulti ? 'Demo Multi-Page (3+ Lembar)' : 'Demo Standar (1 Lembar)';
            if (confirm(`Muat contoh data ${label}? Seluruh data yang sedang diketik akan digantikan dengan data contoh ini.`)) {
                if (isMulti) {
                    this.cv = JSON.parse(JSON.stringify(MULTIPAGE_CV_DATA));
                    this.cvTitle = 'Resume Multi-Page (3+ Lembar)';
                } else {
                    this.cv = JSON.parse(JSON.stringify(DEFAULT_CV_DATA));
                    this.cvTitle = 'Resume Saya';
                }
                this.saveToStorage();
                this.checkPageOverflow();
                setTimeout(() => this.checkPageOverflow(), 150);
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
                    projects: [],
                    trainings: []
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
            this.checkPageOverflow();
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
            this.checkPageOverflow();
        },
        removeExperience(index) {
            this.cv.experiences.splice(index, 1);
            this.checkPageOverflow();
        },
        addBullet(expIndex) {
            this.cv.experiences[expIndex].bullets.push('');
            this.checkPageOverflow();
        },
        removeBullet(expIndex, bulletIndex) {
            this.cv.experiences[expIndex].bullets.splice(bulletIndex, 1);
            this.checkPageOverflow();
        },

        // Pengurutan (Reorder) Pendidikan
        moveEducation(index, direction) {
            const targetIndex = index + direction;
            if (targetIndex < 0 || targetIndex >= this.cv.educations.length) return;
            const item = this.cv.educations.splice(index, 1)[0];
            this.cv.educations.splice(targetIndex, 0, item);
            this.checkPageOverflow();
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
            this.checkPageOverflow();
        },
        removeEducation(index) {
            this.cv.educations.splice(index, 1);
            this.checkPageOverflow();
        },

        // Skills
        addSkillTag(category, event) {
            const val = event.target.value.trim();
            if (val && !this.cv.skills[category].includes(val)) {
                this.cv.skills[category].push(val);
                event.target.value = '';
                this.checkPageOverflow();
            }
        },
        removeSkillTag(category, index) {
            this.cv.skills[category].splice(index, 1);
            this.checkPageOverflow();
        },

        // Pengurutan (Reorder) Proyek
        moveProject(index, direction) {
            const targetIndex = index + direction;
            if (targetIndex < 0 || targetIndex >= this.cv.projects.length) return;
            const item = this.cv.projects.splice(index, 1)[0];
            this.cv.projects.splice(targetIndex, 0, item);
            this.checkPageOverflow();
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
            this.checkPageOverflow();
        },
        removeProject(index) {
            this.cv.projects.splice(index, 1);
            this.checkPageOverflow();
        },

        // Sertifikasi
        moveCertification(index, direction) {
            const targetIndex = index + direction;
            if (targetIndex < 0 || targetIndex >= this.cv.certifications.length) return;
            const item = this.cv.certifications.splice(index, 1)[0];
            this.cv.certifications.splice(targetIndex, 0, item);
            this.checkPageOverflow();
        },
        addCertification() {
            this.cv.certifications.unshift({
                id: 'cert_' + Date.now(),
                name: '',
                issuer: '',
                score: '',
                issueDate: '',
                expiryDate: '',
                year: ''
            });
            this.activeSection = 'certifications';
            this.checkPageOverflow();
        },
        removeCertification(index) {
            this.cv.certifications.splice(index, 1);
            this.checkPageOverflow();
        },

        // Pelatihan / Seminar
        moveTraining(index, direction) {
            const targetIndex = index + direction;
            if (targetIndex < 0 || targetIndex >= this.cv.trainings.length) return;
            const item = this.cv.trainings.splice(index, 1)[0];
            this.cv.trainings.splice(targetIndex, 0, item);
            this.checkPageOverflow();
        },
        addTraining() {
            if (!Array.isArray(this.cv.trainings)) this.cv.trainings = [];
            this.cv.trainings.unshift({
                id: 'train_' + Date.now(),
                institution: '',
                title: '',
                field: '',
                subField: '',
                location: '',
                startDate: '',
                endDate: '',
                description: ''
            });
            this.activeSection = 'trainings';
            this.checkPageOverflow();
        },
        removeTraining(index) {
            this.cv.trainings.splice(index, 1);
            this.checkPageOverflow();
        },
        // Deteksi dan atur pemotongan halaman fisik A4 (297mm = 1122.5px pada 96 DPI)
        checkPageOverflow() {
            this.$nextTick(() => {
                const sheet = document.getElementById('cv-sheet');
                if (!sheet) return;

                // 1. Bersihkan shim pemisah halaman lama sebelum kalkulasi
                const oldShims = sheet.querySelectorAll('.cv-page-break-shim');
                oldShims.forEach(el => el.remove());

                const a4HeightPx = 1122.52; // Tinggi 1 lembar A4 pada 96 DPI
                const scale = (this.zoomLevel || 100) / 100;
                const sheetRect = sheet.getBoundingClientRect();
                
                // Cari template wrapper yang aktif sesuai template yang dipilih
                const activeWrapper = sheet.querySelector(`[data-template-id="${this.selectedTemplate}"]`)
                    || sheet.querySelector(`[x-show*="${this.selectedTemplate}"]`);
                const templateBody = activeWrapper
                    ? (activeWrapper.classList.contains('cv-template-body') ? activeWrapper : activeWrapper.querySelector('.cv-template-body'))
                    : (Array.from(sheet.querySelectorAll('.cv-template-body')).find(el => el.offsetParent !== null) || sheet.querySelector('.cv-template-body'));
                
                if (!templateBody) return;

                // Ukur tinggi konten sebenarnya dari template body (bukan dari sheet yang memiliki min-height dinamis)
                const rawHeight = templateBody.getBoundingClientRect().height;
                if (rawHeight <= 10) {
                    // Jika elemen belum ter-render sempurna oleh Alpine, jadwalkan pengecekan ulang
                    setTimeout(() => this.checkPageOverflow(), 60);
                    return;
                }
                const contentHeight = rawHeight / scale;
                let calculatedPages = Math.max(1, Math.ceil((contentHeight - 15) / a4HeightPx));

                // 2. Jika dokumen lebih dari 1 halaman, periksa elemen yang memotong garis batas
                if (calculatedPages > 1) {
                    // Kumpulkan blok konten: prioritaskan item detail (.break-inside-avoid, article), lalu section jika berupa heading yatim
                    const itemCandidates = Array.from(templateBody.querySelectorAll('.break-inside-avoid, article'));
                    const sectionCandidates = Array.from(templateBody.querySelectorAll('section'));
                    
                    for (let p = 1; p < 8; p++) {
                        const boundaryY = p * a4HeightPx;
                        const dangerTop = boundaryY - 65; // Batas margin bawah lembar p (area bahaya sebelum pembatas)
                        const safeBottom = boundaryY + 45; // Batas margin atas lembar p+1 (setelah pembatas)

                        let targetCandidate = null;

                        // Cek item terlebih dahulu
                        for (const el of itemCandidates) {
                            const elRect = el.getBoundingClientRect();
                            const elTop = (elRect.top - sheetRect.top) / scale;
                            const elBottom = (elRect.bottom - sheetRect.top) / scale;

                            if (elBottom < dangerTop) continue;

                            if ((elTop < boundaryY && elBottom > dangerTop && elTop > (p - 1) * a4HeightPx + 80) ||
                                (elTop >= dangerTop && elTop < safeBottom)) {
                                targetCandidate = el;
                                break;
                            }
                        }

                        // Jika tidak ada item yang memotong, cek apakah ada header section yang terpotong di tepi bawah
                        if (!targetCandidate) {
                            for (const sec of sectionCandidates) {
                                const secRect = sec.getBoundingClientRect();
                                const secTop = (secRect.top - sheetRect.top) / scale;
                                const secBottom = (secRect.bottom - sheetRect.top) / scale;

                                if (secBottom < dangerTop) continue;

                                if (secTop >= dangerTop - 35 && secTop < safeBottom && secTop > (p - 1) * a4HeightPx + 80) {
                                    targetCandidate = sec;
                                    break;
                                }
                            }
                        }

                        if (targetCandidate) {
                            const candTop = (targetCandidate.getBoundingClientRect().top - sheetRect.top) / scale;
                            const gapNeeded = safeBottom - candTop;
                            if (gapNeeded > 0 && gapNeeded < a4HeightPx) {
                                const shim = document.createElement('div');
                                shim.className = 'cv-page-break-shim no-print w-full block pointer-events-none';
                                shim.style.display = 'block';
                                shim.style.width = '100%';
                                shim.style.height = `${Math.ceil(gapNeeded)}px`;
                                shim.style.minHeight = `${Math.ceil(gapNeeded)}px`;
                                shim.style.clear = 'both';
                                targetCandidate.parentNode.insertBefore(shim, targetCandidate);
                            }
                        } else {
                            const contentBottom = (templateBody.getBoundingClientRect().bottom - sheetRect.top) / scale;
                            if (contentBottom <= boundaryY) {
                                break;
                            }
                        }
                    }

                    // Hitung ulang total pages setelah penyesuaian shim
                    const updatedHeight = templateBody.getBoundingClientRect().height / scale;
                    calculatedPages = Math.max(1, Math.ceil((updatedHeight - 15) / a4HeightPx));
                }

                this.totalPages = calculatedPages;
                this.isPageOverflowing = calculatedPages > 1;
            });
        },

        // Toggle preferensi sembunyikan tips unduh PDF
        toggleDontShowPrintGuide() {
            this.dontShowPrintGuide = !this.dontShowPrintGuide;
            localStorage.setItem('bikincv_hide_print_tips', this.dontShowPrintGuide ? 'true' : 'false');
        },

        // Trigger unduh PDF dengan modal panduan cerdas jika belum diceklis jangan tampilkan
        triggerDownloadPdf() {
            if (this.dontShowPrintGuide) {
                this.printCv();
            } else {
                this.showPrintGuideModal = true;
            }
        },

        // Print CV langsung menggunakan browser print dialog
        printCv() {
            const previousTitle = document.title;
            const previousTab = this.mobileTab;
            const safeName = this.cv.personal.fullName ? this.cv.personal.fullName.trim() : 'Resume';
            document.title = `${safeName} - ATS Resume`;
            
            // Pastikan tab preview aktif sebelum print (untuk antisipasi mobile screen)
            this.mobileTab = 'preview';

            // Beri sedikit jeda render sebelum membuka print dialog browser
            setTimeout(() => {
                window.print();
                setTimeout(() => {
                    document.title = previousTitle;
                    this.mobileTab = previousTab;
                }, 500);
            }, 60);
        }
    };
};

window.Alpine = Alpine;
Alpine.start();
