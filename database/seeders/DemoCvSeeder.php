<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Cv;
use Illuminate\Database\Seeder;

final class DemoCvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $demoCvContent = [
            'personal' => [
                'fullName' => 'Budi Pratama',
                'jobTitle' => 'Senior Full Stack Software Engineer',
                'email' => 'budi.pratama@example.com',
                'phone' => '+62 812-3456-7890',
                'location' => 'Jakarta, Indonesia',
                'linkedin' => 'linkedin.com/in/budipratama',
                'github' => 'github.com/budipratama',
                'website' => 'budipratama.dev',
                'photo' => '',
                'summary' => 'Senior Software Engineer dengan 5+ tahun pengalaman dalam merancang dan mengembangkan aplikasi web berskala besar serta high-performance API. Berpengalaman memimpin tim rekayasa perangkat lunak, optimasi database relasional, dan implementasi arsitektur cloud microservices.',
            ],
            'experiences' => [
                [
                    'id' => 'exp_1',
                    'company' => 'PT Solusi Teknologi Nusantara',
                    'position' => 'Lead Full Stack Engineer',
                    'location' => 'Jakarta',
                    'startDate' => 'Jan 2022',
                    'endDate' => 'Sekarang',
                    'isCurrent' => true,
                    'bullets' => [
                        'Merancang dan merekayasa ulang sistem pembayaran microservices yang memproses 500.000+ transaksi harian dengan uptime 99.98%.',
                        'Mengoptimalkan throughput database MySQL dan mengurangi latensi query hingga 42% melalui strategi composite indexing dan multi-layer Redis caching.',
                        'Memimpin tim lintas fungsi yang terdiri dari 6 software engineer dalam penerapan metodologi Agile dan otomatisasi CI/CD pipelines.',
                    ],
                ],
                [
                    'id' => 'exp_2',
                    'company' => 'Inovasi Digital Studio',
                    'position' => 'Software Engineer',
                    'location' => 'Bandung',
                    'startDate' => 'Agu 2019',
                    'endDate' => 'Des 2021',
                    'isCurrent' => false,
                    'bullets' => [
                        'Mengembangkan 12+ fitur core web e-commerce berbasis Laravel dan Tailwind CSS dengan fokus pada performa Core Web Vitals.',
                        'Mengintegrasikan payment gateway pihak ketiga (Midtrans, Xendit) dengan enkripsi webhook signature yang aman.',
                        'Menurunkan bundle size JavaScript aplikasi sebesar 35% melalui code splitting dan dynamic imports.',
                    ],
                ],
            ],
            'educations' => [
                [
                    'id' => 'edu_1',
                    'institution' => 'Universitas Indonesia',
                    'degree' => 'Sarjana Komputer (S1 Teknik Informatika)',
                    'location' => 'Depok, Jawa Barat',
                    'startDate' => '2015',
                    'endDate' => '2019',
                    'gpa' => '3.82 / 4.00',
                ],
            ],
            'skills' => [
                'languages' => ['PHP 8.3', 'JavaScript (ES6+)', 'TypeScript', 'SQL', 'HTML5/CSS3'],
                'frameworks' => ['Laravel', 'Vue.js', 'Alpine.js', 'Tailwind CSS', 'Node.js'],
                'databases' => ['MySQL', 'PostgreSQL', 'Redis'],
                'tools' => ['Git', 'Docker', 'AWS (EC2, S3)', 'Postman', 'Linux / Nginx'],
            ],
            'certifications' => [
                [
                    'id' => 'cert_1',
                    'name' => 'AWS Certified Solutions Architect – Associate',
                    'issuer' => 'Amazon Web Services',
                    'score' => '890 / 1000',
                    'issueDate' => 'Jan 2024',
                    'expiryDate' => 'Jan 2027',
                    'year' => '2024',
                ],
                [
                    'id' => 'cert_2',
                    'name' => 'Laravel Certified Developer',
                    'issuer' => 'Laravel LLC',
                    'score' => '',
                    'issueDate' => 'Agu 2023',
                    'expiryDate' => 'Seumur Hidup',
                    'year' => '2023',
                ],
            ],
            'projects' => [
                [
                    'id' => 'proj_1',
                    'name' => 'OpenResume - ATS Resume Engine',
                    'role' => 'Creator & Maintainer',
                    'link' => 'github.com/budipratama/open-resume',
                    'description' => 'Platform open-source untuk validasi format dokumen resume terhadap standar parsing ATS dengan 1.200+ bintang GitHub.',
                ],
            ],
            'trainings' => [
                [
                    'id' => 'train_1',
                    'institution' => 'Kementerian Komunikasi dan Digital (Digital Talent Scholarship)',
                    'title' => 'Full Stack Web Developer Professional',
                    'field' => 'Teknologi Informasi dan Komunikasi',
                    'subField' => 'Web Development',
                    'location' => 'Jakarta Selatan',
                    'startDate' => 'Jul 2023',
                    'endDate' => 'Okt 2023',
                    'description' => 'Pelatihan intensif 300+ jam mencakup perancangan RESTful API, arsitektur database relasional, dan deployment aplikasi cloud.',
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

        Cv::query()->updateOrCreate(
            [
                'slug' => 'cv-demo-standar-3-bahasa',
            ],
            [
                'user_id' => null,
                'title' => 'Demo CV Standar (3 Bahasa yang Dikuasai)',
                'template_id' => 'classic',
                'selected_font' => 'inter',
                'doc_font_size' => 'doc-size-base',
                'accent_color' => '#111827',
                'content' => $demoCvContent,
                'ats_score' => 95,
                'is_public' => true,
            ]
        );

        $this->command?->info('CV Demo Standar (3 Bahasa yang Dikuasai) berhasil di-seed!');
    }
}
