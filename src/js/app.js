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
        photo: '',
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
    ],
    languages: [
        {
            id: 'lang_1',
            name: 'Bahasa Indonesia',
            level: 'Penutur Asli (Native)',
            info: ''
        },
        {
            id: 'lang_2',
            name: 'Bahasa Inggris',
            level: 'Tingkat Kerja Profesional',
            info: 'TOEFL ITP: 600'
        },
        {
            id: 'lang_3',
            name: 'Bahasa Jepang',
            level: 'Tingkat Percakapan (Conversational)',
            info: 'JLPT N3'
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
        photo: '',
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
    ],
    languages: [
        {
            id: 'lang_1',
            name: 'Bahasa Indonesia',
            level: 'Penutur Asli (Native)',
            info: ''
        },
        {
            id: 'lang_2',
            name: 'Bahasa Inggris',
            level: 'Tingkat Kerja Profesional',
            info: 'TOEFL ITP: 600'
        },
        {
            id: 'lang_3',
            name: 'Bahasa Jepang',
            level: 'Tingkat Percakapan (Conversational)',
            info: 'JLPT N3'
        }
    ]
};

// Data contoh resume full Bahasa Inggris dengan Action Verbs berbobot tinggi standar global
const ENGLISH_CV_DATA = {
    personal: {
        fullName: 'Budi Pratama',
        jobTitle: 'Senior Full Stack Software Engineer',
        email: 'budi.pratama@example.com',
        phone: '+62 812-3456-7890',
        location: 'Jakarta, Indonesia',
        linkedin: 'linkedin.com/in/budipratama',
        github: 'github.com/budipratama',
        website: 'budipratama.dev',
        photo: '',
        summary: 'Senior Software Engineer with 5+ years of experience engineering high-throughput web applications and scalable cloud APIs. Proven track record leading agile cross-functional engineering teams, optimizing relational database architectures, and deploying resilient cloud microservices.'
    },
    experiences: [
        {
            id: 'exp_1',
            company: 'PT Solusi Teknologi Nusantara',
            position: 'Lead Full Stack Engineer',
            location: 'Jakarta, Indonesia',
            startDate: 'Jan 2022',
            endDate: 'Present',
            isCurrent: true,
            bullets: [
                'Architected and deployed a resilient payment microservices platform processing 500,000+ daily transactions with 99.98% uptime.',
                'Optimized MySQL relational database throughput, reducing p99 query latency by 42% via composite indexing and multi-tier Redis caching strategies.',
                'Spearheaded a cross-functional engineering team of 6, establishing Agile best practices, automated CI/CD pipelines, and 85%+ test coverage.'
            ]
        },
        {
            id: 'exp_2',
            company: 'Inovasi Digital Studio',
            position: 'Software Engineer',
            location: 'Bandung, Indonesia',
            startDate: 'Aug 2019',
            endDate: 'Dec 2021',
            isCurrent: false,
            bullets: [
                'Engineered 12+ mission-critical e-commerce features using Laravel and Tailwind CSS, focusing on optimal Core Web Vitals (LCP < 1.8s).',
                'Integrated multiple third-party payment gateways (Midtrans, Xendit) with HMAC webhook signature verification and zero fraud incidents.',
                'Reduced frontend JavaScript bundle size by 35% through strategic code splitting, lazy loading, and dynamic imports.'
            ]
        }
    ],
    educations: [
        {
            id: 'edu_1',
            institution: 'Universitas Indonesia',
            degree: 'Bachelor of Computer Science (B.Comp.Sc.)',
            location: 'Depok, West Java',
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
            issueDate: 'Aug 2023',
            expiryDate: 'Lifetime',
            year: '2023'
        }
    ],
    projects: [
        {
            id: 'proj_1',
            name: 'OpenResume - ATS Resume Engine',
            role: 'Creator & Lead Maintainer',
            link: 'github.com/budipratama/open-resume',
            description: 'Open-source platform for validating resume documents against ATS parsing specifications with 1,200+ GitHub stars.'
        }
    ],
    trainings: [
        {
            id: 'train_1',
            institution: 'Ministry of Communication and Digital Affairs (DTS Program)',
            title: 'Professional Full Stack Web Developer',
            field: 'Information & Communications Technology',
            subField: 'Web Architecture & Cloud Deployment',
            location: 'South Jakarta',
            startDate: 'Jul 2023',
            endDate: 'Oct 2023',
            description: 'Intensive 300+ hour advanced program covering RESTful API architecture, relational database indexing, and cloud-native application deployment.'
        }
    ],
    languages: [
        {
            id: 'lang_1',
            name: 'Indonesian',
            level: 'Native or Bilingual Proficiency',
            info: ''
        },
        {
            id: 'lang_2',
            name: 'English',
            level: 'Full Professional Working Proficiency',
            info: 'TOEFL ITP: 600'
        },
        {
            id: 'lang_3',
            name: 'Japanese',
            level: 'Limited Working Proficiency',
            info: 'JLPT N3'
        }
    ]
};

// Kamus istilah multibahasa (ID/EN) untuk 12 template CV
const I18N = {
    id: {
        summary: 'RINGKASAN PROFIL',
        summary_desc: 'PROFIL PROFESIONAL',
        summary_editorial: 'Statement',
        experience: 'PENGALAMAN KERJA',
        experience_desc: 'RIWAYAT KARIR',
        experience_editorial: 'Experience',
        education: 'RIWAYAT PENDIDIKAN',
        education_editorial: 'Education',
        skills: 'KEAHLIAN & TEKNOLOGI',
        skills_alt: 'KEAHLIAN & KETERAMPILAN',
        skills_competency: 'KOMPETENSI',
        skills_editorial: 'Skills',
        projects: 'PROYEK UTAMA',
        projects_editorial: 'Portfolio',
        certifications: 'SERTIFIKASI & LISENSI',
        certifications_editorial: 'Credentials',
        trainings: 'PELATIHAN & SEMINAR',
        trainings_editorial: 'Development',
        languages_spoken: 'BAHASA',
        languages_spoken_alt: 'BAHASA YANG DIKUASAI',
        languages_spoken_editorial: 'Languages',
        present: 'Sekarang',
        gpa: 'IPK',
        score: 'Nilai / Skor',
        field: 'Kejuruan',
        contact: 'KONTAK',
        email: 'Email',
        tel: 'Telp',
        location: 'Domisili',
        web: 'Web',
        languages: 'Bahasa',
        frameworks: 'Frameworks',
        databases: 'Databases',
        tools: 'Tools / Cloud',
        page_sep_end: 'Akhir Lembar',
        page_sep_start: 'Awal Lembar',
        page_sep_label: 'Pemisah Halaman A4',
        page_label: 'Halaman',
    },
    en: {
        summary: 'PROFESSIONAL SUMMARY',
        summary_desc: 'PROFILE OVERVIEW',
        summary_editorial: 'Statement',
        experience: 'WORK EXPERIENCE',
        experience_desc: 'CAREER HISTORY',
        experience_editorial: 'Experience',
        education: 'EDUCATION',
        education_editorial: 'Education',
        skills: 'SKILLS & EXPERTISE',
        skills_alt: 'TECHNICAL & PROFESSIONAL SKILLS',
        skills_competency: 'CORE COMPETENCIES',
        skills_editorial: 'Skills',
        projects: 'KEY PROJECTS',
        projects_editorial: 'Portfolio',
        certifications: 'CERTIFICATIONS & LICENSES',
        certifications_editorial: 'Credentials',
        trainings: 'TRAINING & CERTIFICATES',
        trainings_editorial: 'Development',
        languages_spoken: 'LANGUAGES',
        languages_spoken_alt: 'LANGUAGES',
        languages_spoken_editorial: 'Languages',
        present: 'Present',
        gpa: 'GPA',
        score: 'Score',
        field: 'Vocational Field',
        contact: 'CONTACT',
        email: 'Email',
        tel: 'Phone',
        location: 'Location',
        web: 'Website',
        languages: 'Languages',
        frameworks: 'Frameworks',
        databases: 'Databases',
        tools: 'Tools & Cloud',
        page_sep_end: 'End of Page',
        page_sep_start: 'Start of Page',
        page_sep_label: 'A4 Page Boundary',
        page_label: 'Page',
    }
};

// Aturan pemoles kata kerja aksi (Action Verbs Polisher)
const ACTION_VERB_REPLACEMENTS = [
    { pattern: /^(responsible for (doing|making|managing|developing|leading)|bertanggung jawab atas|bertanggung jawab dalam)\s+/i, replace: 'Spearheaded ' },
    { pattern: /^(responsible for|bertanggung jawab untuk)\s+/i, replace: 'Orchestrated ' },
    { pattern: /^(helped to|helping to|assisted in|assisting in|membantu)\s+/i, replace: 'Collaborated to ' },
    { pattern: /^(worked on|working on|mengerjakan)\s+/i, replace: 'Engineered ' },
    { pattern: /^(making|make|membuat)\s+/i, replace: 'Engineered ' },
    { pattern: /^(managing|manage|mengelola)\s+/i, replace: 'Orchestrated ' },
    { pattern: /^(leading|lead|memimpin)\s+/i, replace: 'Spearheaded ' },
    { pattern: /^(creating|create|menciptakan)\s+/i, replace: 'Pioneered ' },
    { pattern: /^(improving|improve|meningkatkan)\s+/i, replace: 'Optimized ' },
    { pattern: /^(reducing|reduce|menurunkan|mengurangi)\s+/i, replace: 'Reduced ' },
    { pattern: /^(building|build|membangun)\s+/i, replace: 'Architected ' },
    { pattern: /^(handling|handle|menangani)\s+/i, replace: 'Resolved ' },
    { pattern: /^(doing|menjalankan|melakukan)\s+/i, replace: 'Executed ' },
    { pattern: /^(designing|design|merancang)\s+/i, replace: 'Architected ' },
    { pattern: /^(maintaining|maintain|merawat|memelihara)\s+/i, replace: 'Maintained ' },
    { pattern: /^(supervising|supervise|mengawasi)\s+/i, replace: 'Directed ' },
];

function enhanceActionVerb(sentence) {
    if (!sentence || typeof sentence !== 'string') return sentence;
    let polished = sentence.trim();
    for (const rule of ACTION_VERB_REPLACEMENTS) {
        if (rule.pattern.test(polished)) {
            polished = polished.replace(rule.pattern, rule.replace);
            break;
        }
    }
    return polished.charAt(0).toUpperCase() + polished.slice(1);
}

// Konversi nama bulan dan masa berlaku tanggal dari Bahasa Indonesia ke Bahasa Inggris standar
function translateIndonesianDate(dateStr) {
    if (!dateStr || typeof dateStr !== 'string') return dateStr;
    let text = dateStr.trim();
    if (!text) return text;

    // Istilah khusus durasi / masa berlaku
    const specials = [
        { regex: /\bseumur\s*hidup\b/gi, replacement: 'Lifetime' },
        { regex: /\b(sekarang|saat\s*ini)\b/gi, replacement: 'Present' },
        { regex: /\btanpa\s*kedaluwarsa\b/gi, replacement: 'No Expiration' },
        { regex: /\btanpa\s*batas\s*waktu\b/gi, replacement: 'Permanent' },
    ];
    for (const { regex, replacement } of specials) {
        text = text.replace(regex, replacement);
    }

    // Nama bulan (lengkap dan singkatan umum)
    const monthReplacements = [
        { regex: /\b(agu|agt|agustus)\b/gi, en: 'Aug' },
        { regex: /\b(okt|oktober)\b/gi, en: 'Oct' },
        { regex: /\b(des|desember)\b/gi, en: 'Dec' },
        { regex: /\b(mei)\b/gi, en: 'May' },
        { regex: /\b(maret|mar)\b/gi, en: 'Mar' },
        { regex: /\b(januari|jan)\b/gi, en: 'Jan' },
        { regex: /\b(februari|feb)\b/gi, en: 'Feb' },
        { regex: /\b(april|apr)\b/gi, en: 'Apr' },
        { regex: /\b(juni|jun)\b/gi, en: 'Jun' },
        { regex: /\b(juli|jul)\b/gi, en: 'Jul' },
        { regex: /\b(september|sep)\b/gi, en: 'Sep' },
        { regex: /\b(nopember|nop|november|nov)\b/gi, en: 'Nov' },
    ];
    for (const { regex, en } of monthReplacements) {
        text = text.replace(regex, en);
    }

    return text;
}

// Client-side translation helper (Google Translate single endpoint with MyMemory fallback)
async function translateText(text, from = 'id', to = 'en') {
    if (!text || !text.trim()) return text;
    const cleanText = text.trim();
    try {
        const url = `https://translate.googleapis.com/translate_a/single?client=gtx&sl=${from}&tl=${to}&dt=t&q=${encodeURIComponent(cleanText)}`;
        const res = await fetch(url);
        if (res.ok) {
            const data = await res.json();
            if (Array.isArray(data) && Array.isArray(data[0])) {
                const translated = data[0].map(item => item[0]).join('');
                if (translated && translated.trim().length > 0) return translated;
            }
        }
    } catch (e) {
        // Fallback to MyMemory if Google Translate fails
    }

    try {
        const url = `https://api.mymemory.translated.net/get?q=${encodeURIComponent(cleanText)}&langpair=${from}|${to}`;
        const res = await fetch(url);
        if (res.ok) {
            const data = await res.json();
            if (data.responseData?.translatedText) {
                return data.responseData.translatedText;
            }
        }
    } catch (e) {
        console.warn('Translation failed, keeping original text', e);
    }
    return cleanText;
}

// Component Alpine: cvEditor (100% Privacy-First, Client-Side Only)
window.cvEditor = function () {
    return {
        // State Dokumen
        cv: JSON.parse(JSON.stringify(DEFAULT_CV_DATA)),
        cvTitle: 'Resume Saya',
        docLanguage: 'id', // 'id' atau 'en'
        selectedTemplate: 'classic',
        selectedFont: 'inter',
        docFontSize: 'doc-size-base',
        accentColor: '#111827',

        // Translation & Backup State
        isTranslating: false,
        translationProgressText: '',
        hasIndonesianBackup: false,
        originalIndonesianBackup: null,

        // UI Navigation State
        activeSection: 'personal',
        mobileTab: 'form', // 'form' atau 'preview'
        zoomLevel: 100,
        isAutosaved: false,
        saveStatusText: 'Draft tersimpan di browser',
        lastSavedTime: '',
        showActionVerbsModal: false,
        showAtsAuditModal: false,
        showPrintGuideModal: false,
        dontShowPrintGuide: localStorage.getItem('bikincv_hide_print_tips') === 'true',
        isPageOverflowing: false,
        totalPages: 1,
        isMultiPageDismissed: false,
        _watchDebounceTimer: null,

        normalizeCvData(rawCv) {
            const cv = rawCv && typeof rawCv === 'object' ? rawCv : {};
            if (!cv.personal || typeof cv.personal !== 'object') cv.personal = {};
            if (typeof cv.personal.photo !== 'string' || (cv.personal.photo && !cv.personal.photo.startsWith('data:image/'))) {
                cv.personal.photo = '';
            }
            if (!Array.isArray(cv.experiences)) cv.experiences = [];
            if (!Array.isArray(cv.educations)) cv.educations = [];
            if (!cv.skills || typeof cv.skills !== 'object') {
                cv.skills = { languages: [], frameworks: [], databases: [], tools: [] };
            }
            if (!Array.isArray(cv.skills.languages)) cv.skills.languages = [];
            if (!Array.isArray(cv.skills.frameworks)) cv.skills.frameworks = [];
            if (!Array.isArray(cv.skills.databases)) cv.skills.databases = [];
            if (!Array.isArray(cv.skills.tools)) cv.skills.tools = [];
            if (!Array.isArray(cv.certifications)) cv.certifications = [];
            if (!Array.isArray(cv.projects)) cv.projects = [];
            if (!Array.isArray(cv.trainings)) cv.trainings = [];
            if (!Array.isArray(cv.languages)) cv.languages = [];
            return cv;
        },

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

        // Helper terjemahan label template dinamis (ID / EN)
        t(key) {
            const lang = this.docLanguage || 'id';
            return I18N[lang]?.[key] || I18N['id']?.[key] || key;
        },

        // Format rentang tanggal standar konsisten: "Aug 2019 - Dec 2021"
        formatDateRange(startDate, endDate, isCurrent = false) {
            const start = startDate ? String(startDate).trim() : '';
            const end = isCurrent ? this.t('present') : (endDate ? String(endDate).trim() : '');
            if (start && end) {
                return `${start} - ${end}`;
            }
            return start || end || '';
        },

        // Inisialisasi
        init() {
            this.loadFromStorage();
            this.cv = this.normalizeCvData(this.cv);
            
            // Watch perubahan untuk autosave otomatis & cek overflow halaman (debounced)
            this.$watch('cv', () => {
                clearTimeout(this._watchDebounceTimer);
                this._watchDebounceTimer = setTimeout(() => {
                    this.saveToStorage();
                    this.checkPageOverflow();
                }, 150);
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
            this.$watch('docLanguage', () => { this.saveToStorage(); this.checkPageOverflow(); });
            // Catatan: zoomLevel murni mengatur skala tampilan kanvas visual di layar,
            // sehingga sengaja tidak memicu checkPageOverflow() agar lembar CV dan jumlah halaman tidak berubah.

            // Initial overflow check
            setTimeout(() => this.checkPageOverflow(), 500);
        },

        // Autosave ke LocalStorage
        saveToStorage() {
            try {
                const payload = {
                    cv: this.cv,
                    title: this.cvTitle,
                    docLanguage: this.docLanguage || 'id',
                    selectedTemplate: this.selectedTemplate,
                    selectedFont: this.selectedFont,
                    docFontSize: this.docFontSize,
                    accentColor: this.accentColor
                };
                localStorage.setItem('bikincv_draft', JSON.stringify(payload));
                this.isAutosaved = true;
                const now = new Date();
                this.lastSavedTime = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                this.saveStatusText = `Tersimpan di browser ${this.lastSavedTime}`;
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
                        this.cv = this.normalizeCvData(parsed.cv);
                    }
                    if (parsed.title) this.cvTitle = parsed.title;
                    if (parsed.docLanguage) this.docLanguage = parsed.docLanguage;
                    if (parsed.selectedTemplate) this.selectedTemplate = parsed.selectedTemplate;
                    if (parsed.selectedFont) this.selectedFont = parsed.selectedFont;
                    if (parsed.docFontSize) this.docFontSize = parsed.docFontSize;
                    if (parsed.accentColor) this.accentColor = parsed.accentColor;
                }

                // Pulihkan cadangan Bahasa Indonesia jika tersimpan di LocalStorage
                const storedBackup = localStorage.getItem('bikincv_id_backup');
                if (storedBackup) {
                    try {
                        this.originalIndonesianBackup = JSON.parse(storedBackup);
                        this.hasIndonesianBackup = true;
                    } catch (e) {
                        console.warn('Gagal memuat backup Bahasa Indonesia', e);
                    }
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
                docLanguage: this.docLanguage || 'id',
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
                        this.cv = this.normalizeCvData(parsed.cv);
                        if (parsed.docLanguage) this.docLanguage = parsed.docLanguage;
                        if (parsed.selectedTemplate) this.selectedTemplate = parsed.selectedTemplate;
                        if (parsed.selectedFont) this.selectedFont = parsed.selectedFont;
                        if (parsed.docFontSize) this.docFontSize = parsed.docFontSize;
                        if (typeof parsed.accentColor === 'string' && /^#[0-9a-fA-F]{3,8}$/.test(parsed.accentColor)) {
                            this.accentColor = parsed.accentColor;
                        }
                        this.saveToStorage();
                        this.checkPageOverflow();
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

        // Isi ulang dengan contoh data demo (default 1 lembar, multipage 3+ lembar, atau English ATS)
        loadDemoData(variant = 'default') {
            const isEnglish = variant === 'english';
            const isMulti = variant === 'multipage';
            let label = 'Demo Standar (1 Lembar)';
            if (isEnglish) label = 'Demo English ATS (Standar Global 🇬🇧)';
            else if (isMulti) label = 'Demo Multi-Page (3+ Lembar)';

            if (confirm(`Muat contoh data ${label}? Seluruh data yang sedang diketik akan digantikan dengan data contoh ini.`)) {
                if (isEnglish) {
                    this.cv = JSON.parse(JSON.stringify(ENGLISH_CV_DATA));
                    this.cvTitle = 'Professional Resume';
                    this.docLanguage = 'en';
                } else if (isMulti) {
                    this.cv = JSON.parse(JSON.stringify(MULTIPAGE_CV_DATA));
                    this.cvTitle = 'Resume Multi-Page (3+ Lembar)';
                    this.docLanguage = 'id';
                } else {
                    this.cv = JSON.parse(JSON.stringify(DEFAULT_CV_DATA));
                    this.cvTitle = 'Resume Saya';
                    this.docLanguage = 'id';
                }
                this.saveToStorage();
                this.checkPageOverflow();
                setTimeout(() => this.checkPageOverflow(), 150);
            }
        },

        // Auto-Translate Seluruh Isi CV ke Bahasa Inggris (Google Gemini AI)
        async translateAllToEnglish() {
            if (this.isTranslating) return;
            if (!confirm('Terjemahkan seluruh isi CV ke Bahasa Inggris standar ATS menggunakan Google Gemini AI?\n\nKami akan menyimpan salinan cadangan Bahasa Indonesia agar kamu bisa mengembalikannya kapan saja.')) {
                return;
            }

            this.isTranslating = true;
            this.translationProgressText = 'Menghubungkan ke Google Gemini AI...';

            // Simpan snapshot cadangan bahasa Indonesia asli ke memori & LocalStorage
            this.originalIndonesianBackup = JSON.parse(JSON.stringify(this.cv));
            this.hasIndonesianBackup = true;
            try {
                localStorage.setItem('bikincv_id_backup', JSON.stringify(this.cv));
            } catch (e) {
                console.warn('Gagal menyimpan backup ke localStorage', e);
            }

            try {
                // Tahap 1: Coba translasi cerdas melalui Cloudflare Worker AI Proxy
                const aiResponse = await fetch('/cv/translate-ai', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ cv: this.cv })
                });

                if (aiResponse.ok) {
                    const result = await aiResponse.json();
                    if (result.success && result.cv) {
                        this.translationProgressText = 'Berhasil diterjemahkan oleh Google Gemini AI! Memoles tanggal & Action Verbs...';
                        
                        // Terapkan hasil terjemahan AI
                        this.cv = result.cv;

                        // Ekstra sanitasi tanggal & Action Verbs pada seluruh seksi
                        if (Array.isArray(this.cv.experiences)) {
                            this.cv.experiences.forEach(exp => {
                                if (exp.startDate) exp.startDate = translateIndonesianDate(exp.startDate);
                                if (exp.endDate) exp.endDate = translateIndonesianDate(exp.endDate);
                                if (Array.isArray(exp.bullets)) {
                                    exp.bullets = exp.bullets.map(b => enhanceActionVerb(b));
                                }
                            });
                        }
                        if (Array.isArray(this.cv.educations)) {
                            this.cv.educations.forEach(edu => {
                                if (edu.startDate) edu.startDate = translateIndonesianDate(edu.startDate);
                                if (edu.endDate) edu.endDate = translateIndonesianDate(edu.endDate);
                            });
                        }
                        if (Array.isArray(this.cv.certifications)) {
                            this.cv.certifications.forEach(cert => {
                                if (cert.issueDate) cert.issueDate = translateIndonesianDate(cert.issueDate);
                                if (cert.expiryDate) cert.expiryDate = translateIndonesianDate(cert.expiryDate);
                            });
                        }
                        if (Array.isArray(this.cv.trainings)) {
                            this.cv.trainings.forEach(tr => {
                                if (tr.startDate) tr.startDate = translateIndonesianDate(tr.startDate);
                                if (tr.endDate) tr.endDate = translateIndonesianDate(tr.endDate);
                                if (tr.description) tr.description = enhanceActionVerb(tr.description);
                            });
                        }
                        if (Array.isArray(this.cv.projects)) {
                            this.cv.projects.forEach(proj => {
                                if (proj.description) proj.description = enhanceActionVerb(proj.description);
                            });
                        }

                        this.docLanguage = 'en';
                        this.saveToStorage();
                        this.checkPageOverflow();
                        setTimeout(() => this.checkPageOverflow(), 150);
                        return;
                    }
                }

                // Tahap 2: Fallback ke client-side translation jika server/Gemini sedang limit
                this.translationProgressText = 'Menggunakan fallback translator & penerjemah tanggal...';
                if (this.cv.personal.jobTitle) {
                    this.cv.personal.jobTitle = await translateText(this.cv.personal.jobTitle);
                }
                if (this.cv.personal.summary) {
                    this.cv.personal.summary = await translateText(this.cv.personal.summary);
                }
                if (this.cv.personal.location) {
                    this.cv.personal.location = await translateText(this.cv.personal.location);
                }

                if (Array.isArray(this.cv.experiences)) {
                    for (let i = 0; i < this.cv.experiences.length; i++) {
                        const exp = this.cv.experiences[i];
                        this.translationProgressText = `Menerjemahkan pengalaman kerja ${i + 1} dari ${this.cv.experiences.length}...`;
                        if (exp.position) {
                            exp.position = await translateText(exp.position);
                        }
                        if (exp.location) {
                            exp.location = await translateText(exp.location);
                        }
                        if (exp.startDate) {
                            exp.startDate = translateIndonesianDate(exp.startDate);
                        }
                        if (exp.endDate) {
                            exp.endDate = translateIndonesianDate(exp.endDate);
                        }
                        if (Array.isArray(exp.bullets)) {
                            for (let b = 0; b < exp.bullets.length; b++) {
                                if (exp.bullets[b] && exp.bullets[b].trim()) {
                                    const translated = await translateText(exp.bullets[b]);
                                    exp.bullets[b] = enhanceActionVerb(translated);
                                }
                            }
                        }
                    }
                }

                if (Array.isArray(this.cv.educations)) {
                    for (let i = 0; i < this.cv.educations.length; i++) {
                        const edu = this.cv.educations[i];
                        if (edu.degree) {
                            edu.degree = await translateText(edu.degree);
                        }
                        if (edu.location) {
                            edu.location = await translateText(edu.location);
                        }
                        if (edu.startDate) {
                            edu.startDate = translateIndonesianDate(edu.startDate);
                        }
                        if (edu.endDate) {
                            edu.endDate = translateIndonesianDate(edu.endDate);
                        }
                    }
                }

                if (Array.isArray(this.cv.certifications)) {
                    for (let i = 0; i < this.cv.certifications.length; i++) {
                        const cert = this.cv.certifications[i];
                        if (cert.name) cert.name = await translateText(cert.name);
                        if (cert.issuer) cert.issuer = await translateText(cert.issuer);
                        if (cert.issueDate) cert.issueDate = translateIndonesianDate(cert.issueDate);
                        if (cert.expiryDate) cert.expiryDate = translateIndonesianDate(cert.expiryDate);
                    }
                }

                if (Array.isArray(this.cv.projects)) {
                    for (let i = 0; i < this.cv.projects.length; i++) {
                        const proj = this.cv.projects[i];
                        if (proj.role) proj.role = await translateText(proj.role);
                        if (proj.description) proj.description = enhanceActionVerb(await translateText(proj.description));
                    }
                }

                if (Array.isArray(this.cv.trainings)) {
                    for (let i = 0; i < this.cv.trainings.length; i++) {
                        const tr = this.cv.trainings[i];
                        if (tr.title) tr.title = await translateText(tr.title);
                        if (tr.field) tr.field = await translateText(tr.field);
                        if (tr.subField) tr.subField = await translateText(tr.subField);
                        if (tr.location) tr.location = await translateText(tr.location);
                        if (tr.startDate) tr.startDate = translateIndonesianDate(tr.startDate);
                        if (tr.endDate) tr.endDate = translateIndonesianDate(tr.endDate);
                        if (tr.description) tr.description = enhanceActionVerb(await translateText(tr.description));
                    }
                }

                if (Array.isArray(this.cv.languages)) {
                    for (let i = 0; i < this.cv.languages.length; i++) {
                        const lang = this.cv.languages[i];
                        if (lang.name) lang.name = await translateText(lang.name);
                        if (lang.level) lang.level = await translateText(lang.level);
                        if (lang.info) lang.info = await translateText(lang.info);
                    }
                }

                this.docLanguage = 'en';
                this.saveToStorage();
                this.checkPageOverflow();
                setTimeout(() => this.checkPageOverflow(), 150);
            } catch (err) {
                console.error('Error saat proses translasi:', err);
                alert('Terjadi kendala saat menerjemahkan beberapa teks. Silakan periksa kembali formulir.');
            } finally {
                this.isTranslating = false;
                this.translationProgressText = '';
            }
        },

        // Kembalikan ke Versi Bahasa Indonesia Asli (Undo / Back)
        restoreOriginalIndonesian() {
            if (!this.originalIndonesianBackup) {
                try {
                    const storedBackup = localStorage.getItem('bikincv_id_backup');
                    if (storedBackup) {
                        this.originalIndonesianBackup = JSON.parse(storedBackup);
                        this.hasIndonesianBackup = true;
                    }
                } catch (e) {
                    console.warn('Gagal membaca cadangan dari localStorage', e);
                }
            }

            if (this.originalIndonesianBackup) {
                if (confirm('Batalkan terjemahan Bahasa Inggris dan kembalikan seluruh isi CV ke Bahasa Indonesia?')) {
                    this.cv = JSON.parse(JSON.stringify(this.originalIndonesianBackup));
                    this.docLanguage = 'id';
                    this.hasIndonesianBackup = false;
                    this.originalIndonesianBackup = null;
                    try {
                        localStorage.removeItem('bikincv_id_backup');
                    } catch (e) {}
                    this.saveToStorage();
                    this.checkPageOverflow();
                    setTimeout(() => this.checkPageOverflow(), 150);
                }
            } else {
                if (confirm('Cadangan teks Bahasa Indonesia tidak ditemukan. Apakah ingin mengubah bahasa template ke Bahasa Indonesia?')) {
                    this.docLanguage = 'id';
                    this.saveToStorage();
                    this.checkPageOverflow();
                    setTimeout(() => this.checkPageOverflow(), 150);
                }
            }
        },

        // Upload & Kompresi Foto Profil (Client-Side Canvas)
        handlePhotoUpload(event) {
            const file = event.target.files[0];
            if (!file) return;

            if (!file.type.startsWith('image/')) {
                alert('Silakan pilih file gambar (JPG, PNG, atau WebP).');
                return;
            }

            if (file.size > 3 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 3MB.');
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                const img = new Image();
                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    const maxDim = 400; // Ukuran tajam untuk A4 print
                    let width = img.width;
                    let height = img.height;

                    if (width > height) {
                        if (width > maxDim) {
                            height = Math.round((height * maxDim) / width);
                            width = maxDim;
                        }
                    } else {
                        if (height > maxDim) {
                            width = Math.round((width * maxDim) / height);
                            height = maxDim;
                        }
                    }

                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);

                    const compressedDataUrl = canvas.toDataURL('image/jpeg', 0.88);
                    this.cv.personal.photo = compressedDataUrl;
                    this.saveToStorage();
                    this.checkPageOverflow();
                    setTimeout(() => this.checkPageOverflow(), 100);
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
            event.target.value = '';
        },

        // Hapus Foto Profil
        removePhoto() {
            this.cv.personal.photo = '';
            this.saveToStorage();
            this.checkPageOverflow();
        },

        // Bersihkan seluruh form
        resetForm() {
            if (confirm('Kosongkan semua data form untuk mulai dari awal?')) {
                this.cv = {
                    personal: { fullName: '', jobTitle: '', email: '', phone: '', location: '', linkedin: '', github: '', website: '', summary: '', photo: '' },
                    experiences: [],
                    educations: [],
                    skills: { languages: [], frameworks: [], databases: [], tools: [] },
                    certifications: [],
                    projects: [],
                    trainings: [],
                    languages: []
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

        // Bahasa yang Dikuasai
        moveLanguage(index, direction) {
            const targetIndex = index + direction;
            if (targetIndex < 0 || targetIndex >= this.cv.languages.length) return;
            const item = this.cv.languages.splice(index, 1)[0];
            this.cv.languages.splice(targetIndex, 0, item);
            this.checkPageOverflow();
        },
        addLanguage() {
            if (!Array.isArray(this.cv.languages)) this.cv.languages = [];
            this.cv.languages.push({
                id: 'lang_' + Date.now(),
                name: '',
                level: '',
                info: ''
            });
            this.activeSection = 'languages';
            this.checkPageOverflow();
        },
        removeLanguage(index) {
            this.cv.languages.splice(index, 1);
            this.checkPageOverflow();
        },
        // Deteksi dan atur pemotongan halaman fisik A4 (297mm = 1122.5px pada 96 DPI)
        // Pengukuran dilakukan selalu pada skala asli 1:1 independen dari zoom tampilan layar
        checkPageOverflow(retryCount = 0) {
            this.$nextTick(() => {
                const sheet = document.getElementById('cv-sheet');
                if (!sheet || sheet.offsetParent === null) return;

                // Nonaktifkan sementara transform pada scaler saat mengukur agar dimensi selalu 100% presisi 1:1 A4
                const scaler = document.getElementById('cv-sheet-scaler');
                const prevTransform = scaler ? scaler.style.transform : '';
                const prevTransition = scaler ? scaler.style.transition : '';
                if (scaler) {
                    scaler.style.transition = 'none';
                    scaler.style.transform = 'none';
                }

                // 1. Bersihkan shim pemisah halaman lama sebelum kalkulasi
                const oldShims = sheet.querySelectorAll('.cv-page-break-shim');
                oldShims.forEach(el => el.remove());

                const a4HeightPx = 1122.52; // Tinggi 1 lembar A4 pada 96 DPI
                const sheetRect = sheet.getBoundingClientRect();
                
                // Cari template wrapper yang aktif sesuai template yang dipilih
                const activeWrapper = sheet.querySelector(`[data-template-id="${this.selectedTemplate}"]`)
                    || sheet.querySelector(`[x-show*="${this.selectedTemplate}"]`);
                const templateBody = activeWrapper
                    ? (activeWrapper.classList.contains('cv-template-body') ? activeWrapper : activeWrapper.querySelector('.cv-template-body'))
                    : (Array.from(sheet.querySelectorAll('.cv-template-body')).find(el => el.offsetParent !== null) || sheet.querySelector('.cv-template-body'));
                
                if (!templateBody) {
                    if (scaler) {
                        scaler.style.transform = prevTransform;
                        scaler.style.transition = prevTransition;
                    }
                    return;
                }

                // Ukur tinggi konten sebenarnya dari template body secara unscaled 1:1
                const rawHeight = templateBody.getBoundingClientRect().height;
                if (rawHeight <= 10) {
                    if (scaler) {
                        scaler.style.transform = prevTransform;
                        scaler.style.transition = prevTransition;
                    }
                    // Jika elemen belum ter-render sempurna oleh Alpine, jadwalkan pengecekan ulang maksimal 3 kali
                    if (retryCount < 3) {
                        setTimeout(() => this.checkPageOverflow(retryCount + 1), 60);
                    }
                    return;
                }
                const contentHeight = rawHeight;
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
                            const elTop = elRect.top - sheetRect.top;
                            const elBottom = elRect.bottom - sheetRect.top;

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
                                const secTop = secRect.top - sheetRect.top;
                                const secBottom = secRect.bottom - sheetRect.top;

                                if (secBottom < dangerTop) continue;

                                if (secTop >= dangerTop - 35 && secTop < safeBottom && secTop > (p - 1) * a4HeightPx + 80) {
                                    targetCandidate = sec;
                                    break;
                                }
                            }
                        }

                        if (targetCandidate) {
                            const candTop = targetCandidate.getBoundingClientRect().top - sheetRect.top;
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
                            const contentBottom = templateBody.getBoundingClientRect().bottom - sheetRect.top;
                            if (contentBottom <= boundaryY) {
                                break;
                            }
                        }
                    }

                    // Hitung ulang total pages setelah penyesuaian shim pada skala asli
                    const updatedHeight = templateBody.getBoundingClientRect().height;
                    calculatedPages = Math.max(1, Math.ceil((updatedHeight - 15) / a4HeightPx));
                }

                // Pulihkan kembali transform scaler tampilan layar secara instan
                if (scaler) {
                    scaler.style.transform = prevTransform;
                    scaler.style.transition = prevTransition;
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
