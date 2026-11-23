<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Cv;
use Illuminate\Database\Seeder;

final class MultiPageCvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data CV komprehensif untuk pengujian multi-page (3 - 4 lembar A4)
        $multiPageContent = [
            'personal' => [
                'fullName' => 'Budi Pratama, M.Kom.',
                'jobTitle' => 'Principal Software Architect & Engineering Lead',
                'email' => 'budi.pratama@example.com',
                'phone' => '+62 812-3456-7890',
                'location' => 'Jakarta Selatan, DKI Jakarta',
                'linkedin' => 'linkedin.com/in/budipratama',
                'github' => 'github.com/budipratama',
                'website' => 'budipratama.dev',
                'summary' => 'Principal Software Architect dengan pengalaman 10+ tahun dalam merancang dan memimpin pengembangan arsitektur cloud terdistribusi berskala jutaan pengguna. Berpengalaman memimpin tim engineering multidisiplin hingga 25+ insinyur perangkat lunak, mentransformasi sistem monolitik menuju event-driven microservices berkinerja tinggi, serta mengoptimalkan throughput transaksi perbankan dan e-commerce dengan SLA 99.99%.',
            ],
            'experiences' => [
                [
                    'id' => 'exp_1',
                    'company' => 'PT Toko Karya Teknologi Nusantara',
                    'position' => 'Principal Software Architect',
                    'location' => 'Jakarta Selatan',
                    'startDate' => 'Jan 2023',
                    'endDate' => 'Present',
                    'isCurrent' => true,
                    'bullets' => [
                        'Memimpin re-platforming sistem core checkout & payment ke arsitektur microservices berbasis event-driven (Kafka, Go, Laravel) yang memproses 1.200.000+ transaksi harian.',
                        'Mengurangi latensi P99 API gateway sebesar 55% (dari 320ms menjadi 144ms) melalui strategi composite multi-tier caching menggunakan Redis Cluster dan CDN edge compute.',
                        'Mengarahkan standarisasi platform engineering, automated canary deployments, dan infrastruktur zero-downtime deployment menggunakan Kubernetes dan ArgoCD.',
                        'Membina 4 Software Engineering Manager dan 20+ software engineer dalam penerapan domain-driven design (DDD) dan sistem pengujian otomatis berbasis TDD.',
                    ],
                ],
                [
                    'id' => 'exp_2',
                    'company' => 'Unicorn Fintech Global Asia',
                    'position' => 'Senior Software Engineering Manager',
                    'location' => 'Jakarta Pusat',
                    'startDate' => 'Mar 2021',
                    'endDate' => 'Des 2022',
                    'isCurrent' => false,
                    'bullets' => [
                        'Membangun dari awal sistem deteksi fraud transaksi kartu kredit dan dompet digital berbasis scoring real-time yang menyelamatkan potensi kerugian Rp 14 Miliar per tahun.',
                        'Mengoptimalkan arsitektur database relasional PostgreSQL sharding dan read-replica yang melayani hingga 8.500 queries per second (QPS) pada jam puncak.',
                        'Mengurangi insiden downtime kritis pada environment production sebesar 70% melalui penerapan distributed tracing OpenTelemetry dan error budgeting (SRE).',
                        'Memimpin inisiatif pemenuhan standar regulasi perbankan PCI-DSS Level 1 dan audit keamanan ISO 27001.',
                    ],
                ],
                [
                    'id' => 'exp_3',
                    'company' => 'PT Solusi Awan Digital Internasional',
                    'position' => 'Staff Backend & Cloud Infrastructure Engineer',
                    'location' => 'Jakarta Selatan',
                    'startDate' => 'Jan 2019',
                    'endDate' => 'Feb 2021',
                    'isCurrent' => false,
                    'bullets' => [
                        'Merancang pipeline data ingestion analitik data besar yang memproses 10+ TB data log harian menggunakan Apache Kafka, AWS S3, dan Snowflake.',
                        'Mengotomatisasi provisi infrastruktur multi-cloud (AWS & GCP) berbasis Infrastructure-as-Code (Terraform) dengan 100% konsistensi environment staging dan production.',
                        'Menghemat biaya operasional infrastruktur cloud sebesar 38% ($45.000/tahun) dengan menerapkan instance autoscaling dinamis dan container spot instances.',
                        'Membangun framework microservice internal berbasis Laravel Octane dan gRPC yang diadopsi oleh 8 tim produk berbeda.',
                    ],
                ],
                [
                    'id' => 'exp_4',
                    'company' => 'PT Mega Pratama Informatika',
                    'position' => 'Senior Full Stack Software Engineer',
                    'location' => 'Bandung, Jawa Barat',
                    'startDate' => 'Agu 2017',
                    'endDate' => 'Des 2018',
                    'isCurrent' => false,
                    'bullets' => [
                        'Mengembangkan 15+ modul core pada platform ERP SaaS untuk manufaktur terintegrasi berbasis Laravel, PostgreSQL, dan Vue.js.',
                        'Mengimplementasikan asynchronous job queue processing dengan Redis yang mempercepat laporan rekapitulasi inventaris dari 45 menit menjadi 2 menit.',
                        'Membangun RESTful API public berstandar OpenAPI dengan rate limiting bertingkat dan dokumentasi interaktif Swagger.',
                    ],
                ],
                [
                    'id' => 'exp_5',
                    'company' => 'Digital Alpha Studio Kreatif',
                    'position' => 'Mid-Level Web Application Developer',
                    'location' => 'Bandung, Jawa Barat',
                    'startDate' => 'Jan 2016',
                    'endDate' => 'Jul 2017',
                    'isCurrent' => false,
                    'bullets' => [
                        'Membangun antarmuka pengguna web interaktif responsif untuk 8 klien korporasi dengan fokus aksesibilitas WCAG 2.1 AA.',
                        'Mengoptimalkan frontend rendering dan Core Web Vitals (LCP < 1.8 detik, CLS 0) yang meningkatkan conversion rate pelanggan e-commerce sebesar 22%.',
                        'Mengintegrasikan payment gateway nasional (Midtrans, DOKU, Xendit) dengan sistem proteksi webhook idempotent.',
                    ],
                ],
                [
                    'id' => 'exp_6',
                    'company' => 'PT Rekayasa Cipta Piranti Lunak',
                    'position' => 'Junior Web & Database Programmer',
                    'location' => 'Depok, Jawa Barat',
                    'startDate' => 'Agu 2014',
                    'endDate' => 'Des 2015',
                    'isCurrent' => false,
                    'bullets' => [
                        'Mengembangkan sistem manajemen konten (CMS) berbasis PHP dan MySQL untuk portal berita dengan 100.000 pengunjung bulanan.',
                        'Membuat skrip migrasi database otomatis dan perancangan indeks query untuk mempercepat waktu pencarian artikel sebesar 60%.',
                        'Melakukan bug fixing dan pemeliharaan rutin modul autentikasi pengguna dan hak akses berbasis role (RBAC).',
                    ],
                ],
            ],
            'educations' => [
                [
                    'id' => 'edu_1',
                    'institution' => 'Universitas Indonesia',
                    'degree' => 'Magister Ilmu Komputer (S2 - Rekayasa Perangkat Lunak)',
                    'location' => 'Kebayoran Lama Selatan, Kebayoran Lama, KOTA ADM. JAKARTA SELATAN, DKI JAKARTA',
                    'startDate' => '2018',
                    'endDate' => '2020',
                    'gpa' => '3.92 / 4.00 (Cum Laude)',
                ],
                [
                    'id' => 'edu_2',
                    'institution' => 'Institut Teknologi Bandung',
                    'degree' => 'Sarjana Teknik Informatika (S1 Teknik Informatika)',
                    'location' => 'Jl. Ganesha No. 10, Lebak Siliwangi, Coblong, KOTA BANDUNG, JAWA BARAT',
                    'startDate' => '2010',
                    'endDate' => '2014',
                    'gpa' => '3.78 / 4.00',
                ],
            ],
            'skills' => [
                'languages' => ['PHP 8.3', 'JavaScript (ES6+)', 'TypeScript', 'Golang', 'Python', 'SQL', 'HTML5/CSS3'],
                'frameworks' => ['Laravel 11', 'Vue.js 3', 'Alpine.js', 'Tailwind CSS', 'Node.js', 'NestJS', 'Symfony'],
                'databases' => ['PostgreSQL', 'MySQL', 'Redis Cluster', 'MongoDB', 'Elasticsearch'],
                'tools' => ['AWS (EC2, S3, RDS, Lambda)', 'Docker', 'Kubernetes', 'Terraform', 'Kafka', 'Git', 'CI/CD GitHub Actions', 'Linux / Nginx'],
            ],
            'projects' => [
                [
                    'id' => 'proj_1',
                    'name' => 'OpenResume - Universal ATS Resume Engine',
                    'role' => 'Lead Creator & Maintainer',
                    'link' => 'github.com/budipratama/open-resume',
                    'description' => 'Engine open-source untuk validasi tata letak dan parsing CV terhadap algoritma sistem Applicant Tracking System (ATS) dengan 2.500+ bintang GitHub dan ribuan pengguna global.',
                ],
                [
                    'id' => 'proj_2',
                    'name' => 'FinCore - Ultra High-Throughput Payment Engine',
                    'role' => 'Chief Architect',
                    'link' => 'fincore-engine.internal',
                    'description' => 'Arsitektur payment core berlatensi rendah dengan ledger akuntansi ganda terdistribusi dan audit trail kriptografi yang memproses transaksi bernilai Rp 50+ Miliar/bulan.',
                ],
                [
                    'id' => 'proj_3',
                    'name' => 'TraceKit - Distributed Observability Toolkit',
                    'role' => 'Core Contributor',
                    'link' => 'github.com/budipratama/tracekit',
                    'description' => 'Pustaka open-source lightweight untuk instrumentasi log terstruktur dan distributed tracing OpenTelemetry pada framework PHP modern.',
                ],
                [
                    'id' => 'proj_4',
                    'name' => 'SmartLogistics Real-Time Routing Engine',
                    'role' => 'Full Stack Architect',
                    'link' => 'smartlogistics.tech',
                    'description' => 'Platform dispatching armada kurir logistik berbasis optimasi rute algoritma Dijkstra dan WebSocket geolokasi real-time untuk 500+ kurir harian.',
                ],
            ],
            'certifications' => [
                [
                    'id' => 'cert_1',
                    'name' => 'AWS Certified Solutions Architect – Professional (SAP-C02)',
                    'issuer' => 'Amazon Web Services',
                    'score' => '920 / 1000',
                    'issueDate' => 'Jan 2024',
                    'expiryDate' => 'Jan 2027',
                    'year' => '2024',
                ],
                [
                    'id' => 'cert_2',
                    'name' => 'Certified Kubernetes Administrator (CKA)',
                    'issuer' => 'The Linux Foundation / CNCF',
                    'score' => '94 / 100',
                    'issueDate' => 'Mar 2023',
                    'expiryDate' => 'Mar 2026',
                    'year' => '2023',
                ],
                [
                    'id' => 'cert_3',
                    'name' => 'Laravel Certified Developer – Professional Level',
                    'issuer' => 'Laravel LLC',
                    'score' => 'Terverifikasi Sangat Baik',
                    'issueDate' => 'Agu 2022',
                    'expiryDate' => 'Seumur Hidup',
                    'year' => '2022',
                ],
                [
                    'id' => 'cert_4',
                    'name' => 'HashiCorp Certified: Terraform Associate',
                    'issuer' => 'HashiCorp',
                    'score' => '88 / 100',
                    'issueDate' => 'Nov 2023',
                    'expiryDate' => 'Nov 2025',
                    'year' => '2023',
                ],
            ],
            'trainings' => [
                [
                    'id' => 'train_1',
                    'institution' => 'Kementerian Komunikasi dan Digital (Digital Talent Scholarship)',
                    'title' => 'Advanced Cloud Computing Architecture & Distributed Systems',
                    'field' => 'Teknologi Informasi dan Komunikasi',
                    'subField' => 'Cloud Infrastructure & Architecture',
                    'location' => 'Jakarta Selatan, DKI Jakarta',
                    'startDate' => 'Jul 2023',
                    'endDate' => 'Okt 2023',
                    'description' => 'Pelatihan intensif 320+ jam mencakup perancangan sistem high-availability, microservices deployment pada AWS multi-region, serta implementasi sistem event-driven berbasis Kafka.',
                ],
                [
                    'id' => 'train_2',
                    'institution' => 'Google Cloud Enterprise Academy',
                    'title' => 'Kubernetes Enterprise Architecture & Istio Service Mesh',
                    'field' => 'DevOps & Site Reliability Engineering',
                    'subField' => 'Container Orchestration',
                    'location' => 'Jakarta Pusat / Hybrid',
                    'startDate' => 'Feb 2023',
                    'endDate' => 'Apr 2023',
                    'description' => 'Pendalaman arsitektur container enterprise, traffic management, canary release automation, dan zero-trust mTLS security dengan Istio Service Mesh.',
                ],
                [
                    'id' => 'train_3',
                    'institution' => 'Executive Technology Leadership Institute',
                    'title' => 'Strategic Engineering Leadership & Agile Engineering Organization',
                    'field' => 'Manajemen Rekayasa Perangkat Lunak',
                    'subField' => 'Engineering Management',
                    'location' => 'BSD City, Tangerang Selatan',
                    'startDate' => 'Agu 2022',
                    'endDate' => 'Sep 2022',
                    'description' => 'Program eksekutif untuk pengelolaan kapasitas organisasi teknologi, penyusunan technical roadmap produk, pengelolaan error budgeting (SRE), dan pembinaan talenta insinyur senior.',
                ],
            ],
            'languages' => [
                [
                    'id' => 'lang_1',
                    'name' => 'Bahasa Indonesia',
                    'level' => 'Penutur Asli (Native)',
                    'info' => '',
                ],
                [
                    'id' => 'lang_2',
                    'name' => 'Bahasa Inggris',
                    'level' => 'Tingkat Kerja Profesional',
                    'info' => 'TOEFL ITP: 600',
                ],
                [
                    'id' => 'lang_3',
                    'name' => 'Bahasa Jepang',
                    'level' => 'Tingkat Percakapan (Conversational)',
                    'info' => 'JLPT N3',
                ],
            ],
        ];

        // Simpan atau perbarui CV Multi-Page di database (Guest / Anonymous)
        Cv::query()->updateOrCreate(
            [
                'slug' => 'cv-multipage-3-lembar',
            ],
            [
                'user_id' => null,
                'title' => 'CV Multi-Page (3+ Lembar) - Modern Minimalist',
                'template_id' => 'modern',
                'selected_font' => 'inter',
                'doc_font_size' => 'doc-size-base',
                'accent_color' => '#111827',
                'content' => $multiPageContent,
                'ats_score' => 98,
                'is_public' => true,
            ]
        );

        $this->command?->info('CV Multi-Page (3+ Lembar) berhasil di-seed!');
    }
}
