# BikinCV — ATS-Friendly Resume Builder & Modern Multi-Page PDF Generator

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

<p align="center">
  <strong>Platform pembuatan Curriculum Vitae (CV) modern, minimalis, dan 100% ramah sistem Applicant Tracking System (ATS) dengan dukungan cetak multi-page A4 presisi tanpa perlu login.</strong>
</p>

<p align="center">
  <a href="#-fitur-utama"><img src="https://img.shields.io/badge/ATS-100%25_Compliant-success?style=flat-square" alt="ATS Compliant"></a>
  <a href="#-arsitektur--teknologi"><img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel" alt="Laravel"></a>
  <a href="#-arsitektur--teknologi"><img src="https://img.shields.io/badge/PHP-8.3-777BB4?style=flat-square&logo=php" alt="PHP 8.3"></a>
  <a href="#-arsitektur--teknologi"><img src="https://img.shields.io/badge/TailwindCSS-v4-38B2AC?style=flat-square&logo=tailwind-css" alt="Tailwind CSS"></a>
  <a href="#-arsitektur--teknologi"><img src="https://img.shields.io/badge/Alpine.js-v3-8BC0D0?style=flat-square&logo=alpine.js" alt="Alpine.js"></a>
  <a href="#-arsitektur--teknologi"><img src="https://img.shields.io/badge/Database-SQLite_%2F_MySQL-003B57?style=flat-square&logo=sqlite" alt="Database"></a>
  <a href="#-filosofi-guest-first"><img src="https://img.shields.io/badge/Access-100%25_Guest--First-blue?style=flat-square" alt="Guest First"></a>
</p>

---

## 📖 Tentang BikinCV

Mayoritas pelamar kerja gugur pada tahap seleksi awal perusahaan karena format CV yang dibuat dari aplikasi grafis (seperti Canva, Figma, atau Photoshop) mengandung tabel rumit, elemen vektor dekoratif, atau tata letak dua kolom yang membuat sistem **Applicant Tracking System (ATS)** gagal mem-parsing isi dokumen.

**BikinCV** hadir untuk memecahkan masalah ini dengan menyediakan mesin pembuat CV berbasis teks murni (*plain text vector layer*) dengan keunggulan:
1. **100% Lolos Parsing ATS**: Tata letak satu kolom terstruktur, hierarki heading semantik (`h1`, `h2`, `h3`, `p`, `li`), serta tanpa tabel atau grafik yang membingungkan bot ATS.
2. **100% Bebas Akses (Guest-First & Zero Friction)**: Tanpa kewajiban mendaftar atau login akun. Pengguna langsung membuka aplikasi, mengisi formulir, melihat preview, dan mengunduh PDF seketika.
3. **Instant Live Preview**: Reaktivitas tinggi dengan tampilan *split-screen* (formulir input di sisi kiri, lembar kerja A4 dinamis di sisi kanan) dengan waktu respons `< 16ms`.
4. **Smart Multi-Page Engine (1, 2, 3+ Lembar)**: Sistem otomatis mendeteksi panjang konten dokumen dan membaginya ke lembar A4 kedua, ketiga, atau seterusnya lengkap dengan garis batas pemisah fisik dan kalkulasi shim pencegah teks terpotong (*anti-orphan element*).
5. **Cetak PDF Berkualitas Vektor**: Menggunakan standar `@media print` A4 (`210mm x 297mm`) langsung dari mesin browser modern tanpa watermark, tanpa biaya, dan tanpa beban rendering di server.

---

## 🛠️ Stack Teknologi & Arsitektur

| Layer | Teknologi | Versi | Penjelasan & Peran |
| :--- | :--- | :--- | :--- |
| **Backend Framework** | [Laravel](https://laravel.com) | `12.x` | Framework PHP modern dengan arsitektur *Single-Action Controllers* (`__invoke`), request validation, dan Action pattern. |
| **Runtime Bahasa** | [PHP](https://www.php.net) | `8.3+` | Memanfaatkan fitur PHP modern seperti *constructor property promotion*, strict types, dan typed properties. |
| **Frontend Styling** | [Tailwind CSS](https://tailwindcss.com) | `v4.x` | Mesin styling CSS utility-first ultra-cepat dengan konfigurasi kustom `@media print` untuk standarisasi cetak A4. |
| **Reaktivitas UI** | [Alpine.js](https://alpinejs.dev) | `v3.x` | Library reaktivitas dua arah (*two-way data binding*) ringan dengan plugin `@alpinejs/collapse` untuk accordion form. |
| **Asset Bundler** | [Vite](https://vitejs.dev) | `8.x` | Bundler modul frontend modern dengan proses kompilasi instan. |
| **Database** | [SQLite](https://www.sqlite.org) / [MySQL](https://www.mysql.com) | Default SQLite | Menyimpan draf CV cloud dalam kolom JSON terstruktur dengan indeks komposit. |
| **Testing Suite** | [PHPUnit](https://phpunit.de) | `11.x` | Pengujian fitur otomatis (*Feature & Unit Tests*) untuk validasi endpoint dan integritas data. |
| **Code Formatter** | [Laravel Pint](https://laravel.com/docs/pint) | Latest | Linter dan pemformat kode PHP berstandar PSR-12 / Laravel. |

---

## 🗄️ Skema Database

Aplikasi menggunakan struktur database yang efisien dan fleksibel untuk menyimpan dokumen CV:

### Tabel `cvs`
| Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | `BIGINT UNSIGNED (PK)` | ID unik CV (Auto Increment). |
| `user_id` | `BIGINT UNSIGNED (FK, Nullable)` | ID pemilik CV (opsional, mendukung penyimpanan anonim/tamu). |
| `title` | `VARCHAR(255)` | Judul dokumen CV (misal: "Resume Saya"). |
| `slug` | `VARCHAR(255) (Unique)` | Slug unik dokumen untuk tautan permanen. |
| `template_id` | `VARCHAR(50)` | ID template yang digunakan (`classic`, `modern`, `tech`, dll.). |
| `selected_font` | `VARCHAR(50)` | Font terpilih (`inter`, `roboto`, `jakarta`, `arial`, `merriweather`, dll.). |
| `doc_font_size` | `VARCHAR(50)` | Ukuran font dokumen (`doc-size-sm`, `doc-size-base`, `doc-size-lg`). |
| `accent_color` | `VARCHAR(20)` | Kode warna aksen dokumen (misal: `#111827`, `#1e3a8a`). |
| `content` | `JSON` | Seluruh payload data CV (personal, pengalaman, pendidikan, keahlian, proyek, sertifikasi, pelatihan). |
| `ats_score` | `TINYINT UNSIGNED` | Skor kelayakan ATS (0–100%). |
| `is_public` | `BOOLEAN` | Status publikasi dokumen. |
| `created_at` / `updated_at` | `TIMESTAMP` | Waktu pembuatan dan pembaruan draf. |

> **Indeks Database:**
> - `cvs_user_id_updated_at_index`: Pengindeksan komposit untuk kecepatan query riwayat CV.
> - `cvs_slug_unique`: Menjamin keunikan slug dokumen.

---

## ✨ Fitur-Fitur Utama

### 1. 12 Template CV ATS Berstandar Industri
Tersedia 12 pilihan template yang dapat diganti secara instan kapan saja tanpa kehilangan data:
1. **The Editorial / Modern Creative** (`editorial`) — Desain majalah modern dengan tipografi masthead berkelas, garis pembatas *hairline* presisi, penomoran dossier editorial, dan pembagian seksi berkarakter.
2. **The Bold Header** (`bold`) — Format modern berwibawa dengan banner kartu header, pas foto profesional elegan, chips kontak minimalis, dan body 1 kolom penuh yang leluasa dan 100% ramah parsing ATS.
3. **The Swiss International** (`swiss`) — Tata letak tipografi Swiss dengan timeline margin-date (~26% gutter tanggal/institusi, ~74% body pencapaian) yang optimal untuk pemindaian mata 6 detik (*F-pattern scanning*).
4. **The Modern Two-Column** (`dual`) — Layout dual-grid 2 kolom modern dengan pas foto profesional, sidebar keahlian/kontak, dan body karir komprehensif yang tetap 100% ramah parser ATS.
5. **Modern Minimalist** (`modern`) — Desain modern bersih dengan aksen garis tipis, ideal untuk startup, teknologi, dan industri kreatif.
6. **The Classic Executive** (`classic`) — Format formal standar perbankan, BUMN, dan korporasi multinasional.
7. **Tech & Engineering Specialist** (`tech`) — Mengedepankan hierarki keahlian teknis, tools, dan aksen monospace.
8. **Compact One-Pager** (`compact`) — Tata letak rapat hemat ruang, sangat cocok bagi *fresh graduate* yang ingin dokumen pas 1 halaman.
9. **Academic & Ivy League** (`academic`) — Format prestisius untuk riset, akademisi, dosen, dan lamaran beasiswa.
10. **The Nordic Clean** (`nordic`) — Gaya minimalis Skandinavia dengan tipografi tracking presisi.
11. **Finance & Wall Street Elite** (`finance`) — Format baku Harvard/Wharton untuk konsultan manajemen & investment banking.
12. **Corporate Enterprise** (`corporate`) — Format terstruktur Fortune 500 dengan pembatas aksen profesional.

### 2. Formulir CV Lengkap & Terstruktur (8 Seksi)
Formulir input disusun berdasarkan kaidah standar kurikulum resume profesional:
- **01. Informasi Pribadi**: Foto profil profesional (unggah & kompresi client-side otomatis), nama lengkap, target posisi, email, telepon, domisili, LinkedIn, GitHub, dan website pribadi.
- **02. Ringkasan Profil**: Deskripsi singkat karir, kompetensi inti, dan proposisi nilai pelamar.
- **03. Pengalaman Kerja**: Posisi, nama perusahaan, domisili, periode kerja, status pekerjaan aktif (*Present*), dan poin-poin pencapaian dengan action verbs.
- **04. Riwayat Pendidikan**: Nama universitas/sekolah, gelar & jurusan, format alamat lengkap institusi, periode studi, dan IPK/GPA.
- **05. Keahlian & Keterampilan**: Pengelompokan bahasa pemrograman, frameworks, databases, dan tools/platforms.
- **06. Proyek Portofolio**: Nama proyek, peran, tautan publik, dan deskripsi kontribusi.
- **07. Sertifikasi & Lisensi**: Nama program sertifikasi, lembaga penerbit, nilai/skor (opsional), dan periode berlaku.
- **08. Pelatihan & Seminar**: Lembaga penyelenggara, program pelatihan, kejuruan, sub-kejuruan, alamat lokasi, tanggal mulai/akhir, dan uraian materi pelatihan.

### 3. Mesin Multi-Page Cerdas (Smart Page Break Engine)
- **Deteksi Tinggi Fisik A4**: Menghitung tinggi konten secara dinamis terhadap standar lembar A4 (`297mm` / `1122.5px`).
- **Pemisah Halaman Realistis**: Memunculkan visual gap dan penanda *"Akhir Lembar 1 / Awal Lembar 2"* langsung pada layar preview.
- **Anti-Orphan Element Shim**: Mencegah judul seksi atau poin pengalaman terbelah canggung di tengah garis batas kertas dengan menyisipkan penyesuaian jarak (*page-break shim*) secara otomatis.

### 4. Audit Skor ATS Real-Time
- Evaluasi langsung skor kelayakan dokumen (0–100%).
- Analisis kelengkapan kontak, kata kerja aksi (*action verbs*), dan kuantifikasi metrik keberhasilan.
- Tombol modal interaktif panduan kata kerja aktif (*Action Verbs Bank*) untuk memperkaya narasi CV.

### 5. Portabilitas & Privasi Data Penuh (Zero-Knowledge / 100% Client-Side)
- **100% Privacy-First**: Data pribadi pelamar **tidak pernah disimpan di database server**. Seluruh data diproses murni di browser pengguna.
- **Autosave Browser**: Draf otomatis tersimpan aman di `LocalStorage` browser sehingga tidak akan hilang saat halaman ditutup atau tidak sengaja ter-refresh.
- **Ekspor & Impor JSON**: Pengguna dapat mengunduh backup file `.json` dari CV mereka untuk disimpan sendiri secara offline, dan mengimpornya kembali kapan pun dibutuhkan.
- **Preset Data Demo**:
  - *Demo Standar*: Contoh CV ringkas 1 lembar (cocok untuk fresh graduate / pelamar awal).
  - *Demo Multi-Page*: Contoh CV ekstensif 10+ tahun pengalaman yang langsung memuat 3–4 lembar A4 penuh.

---

## 🚀 Panduan Menjalankan Aplikasi di Lokal

Ikuti langkah-langkah berikut untuk menjalankan aplikasi BikinCV pada komputer lokal Anda:

### 1. Prasyarat Sistem
- **PHP** versi 8.3 atau lebih baru
- **Composer** (Package manager PHP)
- **Node.js** (v18+) dan **NPM**
- **Git**
- *Environment Lokal*: Laragon, XAMPP, atau Laravel Herd

---

### 2. Langkah Instalasi

#### Langkah 1: Clone Repository
```bash
git clone https://github.com/AnangML/BikinCV.git
cd BikinCV
```

#### Langkah 2: Install Dependensi PHP
```bash
composer install
```

#### Langkah 3: Install Dependensi Node.js
```bash
npm install
```

#### Langkah 4: Konfigurasi File Environment (`.env`)
Salin file `.env.example` menjadi `.env`:
- **Windows (PowerShell / Command Prompt):**
  ```powershell
  copy .env.example .env
  ```
- **Linux / macOS:**
  ```bash
  cp .env.example .env
  ```

#### Langkah 5: Generate Application Key
```bash
php artisan key:generate
```

#### Langkah 6: Konfigurasi & Migrasi Database
Aplikasi menggunakan **SQLite** secara default (dapat juga menggunakan MySQL). Buat file database SQLite jika belum ada:
- **Windows (PowerShell):**
  ```powershell
  if (!(Test-Path -Path "database\database.sqlite")) { New-Item -ItemType File -Path "database\database.sqlite" }
  ```
- **Linux / macOS:**
  ```bash
  touch database/database.sqlite
  ```

Jalankan migrasi database:
```bash
php artisan migrate
```

Jalankan seeder untuk mengisi data contoh multi-page (3–4 lembar):
```bash
php artisan db:seed
```

#### Langkah 7: Kompilasi Asset Frontend
- **Mode Development (Hot-Reloading):**
  ```bash
  npm run dev
  ```
- **Mode Production Build:**
  ```bash
  npm run build
  ```

#### Langkah 8: Jalankan Server Lokal
```bash
php artisan serve
```

Aplikasi siap dibuka di browser melalui tautan:
👉 **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## 🧪 Pengujian Otomatis & Standar Kode

Aplikasi telah dilengkapi pengujian otomatis untuk memastikan seluruh fungsi berjalan tanpa cacat:

```bash
# Menjalankan seluruh test suite
php artisan test

# Menjalankan pengujian fitur CV secara spesifik
php artisan test tests/Feature/CvTest.php

# Memeriksa dan memformat standar kode PHP (Pint)
vendor\bin\pint --test
```

---

## 📂 Struktur Direktori Proyek

```text
BikinCV/
├── app/
│   ├── Actions/Cv/                   # Service aksi bisnis domain (SaveCvAction)
│   ├── Http/Controllers/Cv/          # Invokable Controllers (ShowCvEditor, SaveCv)
│   ├── Http/Requests/Cv/             # Form Requests & validasi payload CV
│   └── Models/                       # Eloquent Model (Cv, User)
├── database/
│   ├── migrations/                   # Skema tabel database (cvs, users, cache, jobs)
│   └── seeders/                      # Seeder database (MultiPageCvSeeder, DatabaseSeeder)
├── resources/
│   ├── css/
│   │   └── app.css                   # Konfigurasi Tailwind v4 & stylesheet @media print A4
│   ├── js/
│   │   └── app.js                    # Store Alpine.js, logika multi-page shim, & audit ATS
│   └── views/
│       ├── components/
│       │   └── cv-templates/         # 8 Template CV ATS
│       │       ├── academic.blade.php
│       │       ├── classic.blade.php
│       │       ├── compact.blade.php
│       │       ├── corporate.blade.php
│       │       ├── finance.blade.php
│       │       ├── modern.blade.php
│       │       ├── nordic.blade.php
│       │       └── tech.blade.php
│       ├── layouts/
│       │   └── app.blade.php         # Layout utama aplikasi
│       └── cv-editor.blade.php       # Tampilan antarmuka utama (Split-Screen Editor)
├── routes/
│   └── web.php                       # Definisi rute web & API
└── tests/
    └── Feature/
        └── CvTest.php                # Automated Feature Tests
```

---

## 🖨️ Tips Mencetak PDF A4 Sempurna

Saat mengklik tombol **Unduh PDF** pada aplikasi:
1. **Tujuan Cetak (*Destination*)**: Pilih **Save as PDF** (*Simpan sebagai PDF*).
2. **Ukuran Kertas (*Paper Size*)**: Pilih **A4**.
3. **Margin (*Margins*)**: Pilih **None** (*Tanpa Margin*) — margin halaman standar 12–15mm telah diatur secara presisi oleh CSS cetak aplikasi.
4. **Grafik Latar Belakang (*Background Graphics*)**: **Centang / Aktifkan** agar garis aksen dan warna heading tercetak sempurna.
5. **Header & Footer**: **Hapus centang / Nonaktifkan** agar URL browser (`localhost`), tanggal, dan nomor halaman browser tidak muncul di kertas CV Anda.

---

## 📄 Lisensi

Proyek ini dirilis di bawah lisensi terbuka [MIT License](LICENSE).
