# BikinCV — ATS-Friendly Resume Builder & Modern Multi-Page PDF Generator

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

<p align="center">
  <strong>Platform pembuatan Curriculum Vitae (CV) modern, minimalis, dan 100% ramah sistem Applicant Tracking System (ATS) dengan dukungan cetak multi-page A4 presisi, terjemahan AI Google Gemini, dan privasi penuh tanpa perlu login.</strong>
</p>

<p align="center">
  <a href="#-fitur-utama"><img src="https://img.shields.io/badge/ATS-100%25_Compliant-success?style=flat-square" alt="ATS Compliant"></a>
  <a href="#-stack-teknologi--arsitektur"><img src="https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat-square&logo=laravel" alt="Laravel 13"></a>
  <a href="#-stack-teknologi--arsitektur"><img src="https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square&logo=php" alt="PHP 8.3+"></a>
  <a href="#-stack-teknologi--arsitektur"><img src="https://img.shields.io/badge/TailwindCSS-v4-38B2AC?style=flat-square&logo=tailwind-css" alt="Tailwind CSS v4"></a>
  <a href="#-stack-teknologi--arsitektur"><img src="https://img.shields.io/badge/Alpine.js-v3-8BC0D0?style=flat-square&logo=alpine.js" alt="Alpine.js v3"></a>
  <a href="#-stack-teknologi--arsitektur"><img src="https://img.shields.io/badge/AI-Google_Gemini-4285F4?style=flat-square&logo=google-gemini" alt="Google Gemini AI"></a>
  <a href="#-fitur-utama"><img src="https://img.shields.io/badge/Access-100%25_Privacy--First-blue?style=flat-square" alt="Privacy First"></a>
</p>

---

## 📖 Tentang BikinCV

Mayoritas pelamar kerja gugur pada tahap seleksi awal perusahaan karena format CV yang dibuat dari aplikasi grafis (seperti Canva, Figma, atau Photoshop) mengandung tabel rumit atau elemen vektor dekoratif yang membuat sistem **Applicant Tracking System (ATS)** gagal mem-parsing isi dokumen.

**BikinCV** hadir untuk memecahkan masalah ini dengan menyediakan mesin pembuat CV berbasis teks murni (*plain text vector layer*) dengan keunggulan:
1. **100% Lolos Parsing ATS**: Hierarki heading semantik (`h1`, `h2`, `h3`, `p`, `li`), kontras teks tinggi, dan struktur rapi yang terbaca jelas oleh bot ATS maupun HRD.
2. **100% Bebas Akses (*Privacy-First & Zero-Login*)**: Tanpa kewajiban mendaftar atau login akun. Seluruh data CV disimpan aman di browser pengguna (`LocalStorage`).
3. **Instant Live Preview**: Tampilan *split-screen* (formulir akordion di sisi kiri, lembar kerja A4 dinamis di sisi kanan) yang sinkron seketika.
4. **Smart Multi-Page Engine (1, 2, 3+ Lembar)**: Mendeteksi tinggi konten terhadap dimensi fisik A4 (`297mm` / `1122.52px` pada 96 DPI), menampilkan garis pemisah antar halaman, serta menyisipkan `.cv-page-break-shim` untuk mencegah teks atau heading terpotong canggung di batas halaman.
5. **Auto-Translate Bahasa Inggris (Google Gemini AI)**: Mengubah seluruh isi CV berbahasa Indonesia ke Bahasa Inggris profesional standar ATS dalam satu klik, lengkap dengan tombol **Balik ke ID** untuk mengembalikan versi asli.
6. **Cetak PDF Berkualitas Vektor**: Menggunakan `@media print` A4 (`210mm x 297mm`) langsung dari dialog cetak browser tanpa watermark dan tanpa beban rendering di server.

---

## 🛠️ Stack Teknologi & Arsitektur

| Layer | Teknologi | Versi (`composer.json` / `package.json`) | Peran |
| :--- | :--- | :--- | :--- |
| **Backend Framework** | [Laravel](https://laravel.com) | `^13.17` | Routing web, rendering Blade view, dan endpoint proxy AI (`/cv/translate-ai`). |
| **Runtime Bahasa** | [PHP](https://www.php.net) | `^8.3` | Strict typing (`declare(strict_types=1)`), Invokable Controllers. |
| **Frontend Styling** | [Tailwind CSS](https://tailwindcss.com) | `^4.0.0` (`@tailwindcss/vite`) | Styling editor, 12 template CV, serta aturan cetak `@media print` A4. |
| **Reaktivitas UI** | [Alpine.js](https://alpinejs.dev) | `^3.17.5` (`+ @alpinejs/collapse`) | Two-way data binding (`cvEditor()`), pengelolaan 9 seksi, autosave, dan kalkulasi ATS. |
| **Asset Bundler** | [Vite](https://vitejs.dev) | `^8.0.0` (`laravel-vite-plugin ^3.1`) | Bundling CSS & JavaScript modern ke `public/build/`. |
| **AI Translator** | [Google Gemini API](https://ai.google.dev) | Default `gemini-3-flash-preview` | Terjemahan batch CV Indonesia ➔ Inggris standar ATS (dengan fallback client-side). |
| **Database** | [SQLite](https://www.sqlite.org) / MySQL | Default SQLite | Menyimpan skema tabel `cvs` dan menjalankan data seeder demo (`DemoCvSeeder`, `MultiPageCvSeeder`). |
| **Testing & Linting** | [PHPUnit](https://phpunit.de) & Pint | PHPUnit `^12.5.12`, Pint `^1.27` | Pengujian fitur otomatis ([CvTest.php](tests/Feature/CvTest.php)) dan format kode standar Laravel. |

---

## 🌐 Rute Aplikasi

| Method & URI | Route Name | Controller / Aksi | Deskripsi |
| :--- | :--- | :--- | :--- |
| `GET /` | `cv.editor` | `ShowCvEditorController` | Menampilkan halaman utama split-screen CV Editor. |
| `POST /cv/translate-ai` | `cv.translate.ai` | `AiTranslateCvController` | Proxy terjemahan single-text atau batch CV ke Google Gemini API (`throttle:30,1`). |
| `GET /login`, `/register`, `/dashboard`, `/cv/save` | — | `Route::redirect(..., '/')` | Rute warisan dialihkan langsung ke editor utama (*Privacy-First*). |

---

## ✨ Fitur-Fitur Utama

### 1. 12 Template CV ATS Berstandar Industri
Tersedia 12 pilihan template di [resources/views/components/cv-templates/](resources/views/components/cv-templates) yang dapat diganti secara instan tanpa kehilangan data:
1. **The Classic Executive** (`classic`) — Format formal standar perbankan, BUMN, dan korporasi multinasional.
2. **Modern Minimalist** (`modern`) — Desain modern bersih dengan aksen garis tipis, ideal untuk startup dan industri teknologi.
3. **Tech & Engineering Specialist** (`tech`) — Mengedepankan hierarki keahlian teknis, tools, dan aksen monospace (`JetBrains Mono`).
4. **Compact One-Pager** (`compact`) — Tata letak rapat hemat ruang, cocok untuk *fresh graduate* agar pas 1 halaman.
5. **Academic & Ivy League** (`academic`) — Format tipografi serif klasik untuk riset, akademisi, dosen, dan beasiswa.
6. **The Nordic Clean** (`nordic`) — Gaya minimalis Skandinavia dengan letter-spacing presisi.
7. **Finance & Wall Street Elite** (`finance`) — Format baku Harvard/Wharton (*Education-first*) untuk konsultasi manajemen & finansial.
8. **Corporate Enterprise** (`corporate`) — Format korporat terstruktur dengan banner judul seksi beraksen kiri.
9. **The Modern Two-Column** (`dual`) — Layout 2 kolom dengan pas foto opsional, sidebar kontak/keahlian/sertifikasi/bahasa, dan body karir.
10. **The Swiss International** (`swiss`) — Tata letak grid asimetris Swiss dengan timeline tanggal di margin kiri (`~26%` gutter, `~74%` detail).
11. **The Bold Header** (`bold`) — Header banner kartu beraksen tebal, pas foto opsional, contact chips, dan body leluasa.
12. **The Editorial / Modern Creative** (`editorial`) — Estetika majalah kontemporer dengan penomoran seksi editorial (`01 / ...`) dan double-hairline strip.

**Kustomisasi Tipografi & Warna:**
- **7 Pilihan Font:** `Inter`, `Roboto`, `Plus Jakarta Sans`, `Arial`, `Merriweather`, `Georgia`, dan `Garamond`.
- **3 Ukuran Dokumen:** `10pt` (`doc-size-sm`), `11pt` (`doc-size-base`), dan `12pt` (`doc-size-lg`).
- **4 Warna Aksen ATS-Safe:** Hitam (`#111827`), Navy (`#1e3a8a`), Charcoal (`#334155`), dan Forest (`#14532d`).
- **Kontrol Zoom Layar:** `50%` hingga `150%` untuk kenyamanan pratinjau tanpa mengubah ukuran cetak asli A4.

### 2. Formulir CV Lengkap & Terstruktur (9 Seksi)
Formulir input di panel kiri menggunakan akordion bernomor dengan tombol urutan naik/turun (`↑`/`↓`), dan setiap penambahan item baru (`+ Tambah ...`) otomatis bertambah ke urutan bawah (`push`):
- **01. Informasi Pribadi**: Unggah & kompresi foto profil otomatis di browser (`<canvas>`, maks `400px` JPEG, batas input 3MB), nama lengkap, target posisi, email, telepon, domisili, LinkedIn, GitHub, dan website pribadi.
- **02. Ringkasan Profil**: Deskripsi singkat karir dan proposisi nilai kandidat.
- **03. Pengalaman Kerja**: Posisi, perusahaan, domisili, periode kerja, status aktif (*Masih bekerja di posisi ini*), poin pencapaian, serta modal **Kamus Kata Kerja Aktif** (*Action Verbs*).
- **04. Riwayat Pendidikan**: Institusi, gelar & jurusan, lokasi, periode studi, dan IPK/GPA.
- **05. Keahlian & Teknologi**: Tag input terkelompok untuk Bahasa Pemrograman (`skills.languages`), Frameworks, Databases, dan Tools/Cloud.
- **06. Proyek & Portofolio**: Nama proyek, peran, tautan, dan deskripsi dampak.
- **07. Sertifikasi & Lisensi**: Nama sertifikasi, penerbit, skor/nilai (opsional), tanggal terbit, dan masa berlaku.
- **08. Pelatihan & Seminar**: Lembaga pelatihan, program, kejuruan, sub-kejuruan, lokasi, periode, dan uraian materi.
- **09. Bahasa yang Dikuasai** (*Spoken Languages*): Nama bahasa, tingkat kemahiran (dilengkapi `<datalist>` rekomendasi bahasa & level standar ATS), serta keterangan/skor tes opsional (seperti TOEFL, IELTS, atau JLPT). Bersifat opsional: tidak ditampilkan di CV jika kosong.

### 3. Auto-Translate Bahasa Inggris (Google Gemini AI + Backup Restore)
- **`✨ Auto EN (AI)`**: Menerjemahkan seluruh data CV Bahasa Indonesia menjadi Bahasa Inggris profesional standar ATS dalam 1 batch request via [AiTranslateCvController.php](app/Http/Controllers/Cv/AiTranslateCvController.php).
- **Normalisasi Tanggal & Action Verbs**: Otomatis mengonversi nama bulan & durasi Indonesia ke format Inggris (`Agu` ➔ `Aug`, `Okt` ➔ `Oct`, `Des` ➔ `Dec`, `Seumur Hidup` ➔ `Lifetime`, `Sekarang` ➔ `Present`), menjaga konsistensi pemisah ` - ` via `formatDateRange()`, dan memoles kalimat dengan kata kerja aktif.
- **`↩️ Balik ke ID`**: Sebelum menerjemahkan, aplikasi menyimpan snapshot cadangan di `LocalStorage` (`bikincv_id_backup`) sehingga pengguna bisa membatalkan terjemahan dan kembali ke versi Bahasa Indonesia kapan saja.
- **Fallback Otomatis**: Jika `GEMINI_API_KEY` belum diisi atau API gagal/limit, sistem otomatis memakai fallback translator client-side.

### 4. Audit Skor ATS Real-Time
- Evaluasi langsung skor kelayakan dokumen (`0–100%`) dari 5 kategori: Data Diri & Kontak (25 poin), Ringkasan Profil (15 poin), Pengalaman Kerja & Aksi (30 poin), Pendidikan (15 poin), dan Keahlian (15 poin).
- Dilengkapi tombol **"Perbaiki"** pada modal audit untuk melompat langsung ke seksi formulir yang masih kurang.

### 5. Portabilitas, Autosave & 3 Preset Demo
- **Autosave `LocalStorage`**: Menyimpan draf aktif (`bikincv_draft`), cadangan Bahasa Indonesia (`bikincv_id_backup`), dan preferensi tips cetak PDF (`bikincv_hide_print_tips`) secara otomatis di browser.
- **Ekspor & Impor JSON**: Unduh seluruh isi CV sebagai file `.json` cadangan offline dan muat kembali kapan saja.
- **3 Preset Data Demo**:
  - **Demo Standar (1 Lembar)**: Format ringkas ATS lengkap dengan 3 bahasa yang dikuasai (*Indonesia, Inggris, Jepang*).
  - **Demo Multi-Page (3+ Lembar)**: Pengalaman ekstensif 6 posisi kerja, S1 & S2, proyek, sertifikasi, pelatihan, dan 3 bahasa.
  - **Demo English ATS 🇬🇧**: Contoh resume Bahasa Inggris standar global dengan action verbs berbobot dan 3 bahasa.

---

## 🗄️ Skema Database & Seeders

Tabel `cvs` didefinisikan pada [2026_10_25_000001_create_cvs_table.php](database/migrations/2026_10_25_000001_create_cvs_table.php) dan digunakan oleh model [Cv.php](app/Models/Cv.php) serta seeder demo:

| Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | `BIGINT UNSIGNED (PK)` | ID unik CV (Auto Increment). |
| `user_id` | `BIGINT UNSIGNED (FK, Nullable)` | ID pemilik CV (nullable, `nullOnDelete`). |
| `title` | `VARCHAR(255)` | Judul dokumen CV (default: `"Resume Saya"`). |
| `slug` | `VARCHAR(255) (Unique)` | Slug unik dokumen. |
| `template_id` | `VARCHAR(255)` | ID template aktif (default: `'classic'`). |
| `selected_font` | `VARCHAR(255)` | Font terpilih (default: `'inter'`). |
| `doc_font_size` | `VARCHAR(255)` | Ukuran font dokumen (default: `'doc-size-base'`). |
| `accent_color` | `VARCHAR(255)` | Kode warna aksen (default: `'#111827'`). |
| `content` | `JSON` | Payload lengkap isi CV (`personal`, `experiences`, `educations`, `skills`, `certifications`, `projects`, `trainings`, `languages`). |
| `ats_score` | `TINYINT UNSIGNED` | Skor kelayakan ATS (`0–100`, default `0`). |
| `is_public` | `BOOLEAN` | Status publikasi dokumen (default `false`). |
| `created_at` / `updated_at` | `TIMESTAMP` | Waktu pembuatan dan pembaruan, dengan composite index `['user_id', 'updated_at']`. |

---

## 🚀 Panduan Menjalankan Aplikasi di Lokal

### 1. Prasyarat Sistem
- **PHP** versi `8.3` atau lebih baru
- **Composer**
- **Node.js** (v18+) dan **NPM**
- **Git**

### 2. Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/AnangML/BikinCV.git
cd BikinCV

# 2. Install dependensi PHP & Node.js
composer install
npm install

# 3. Salin file environment & buat key aplikasi
copy .env.example .env    # (atau `cp .env.example .env` di Linux/macOS)
php artisan key:generate
```

#### Konfigurasi Opsional Google Gemini AI (`.env`)
Agar fitur **Auto EN (AI)** menggunakan Google Gemini AI (jika dikosongkan, sistem otomatis memakai fallback translator client-side):
```dotenv
GEMINI_API_KEY=isi_api_key_gemini_anda
GEMINI_MODEL=gemini-3-flash-preview
```

#### Database & Seeder (SQLite Default)
```powershell
# Buat file SQLite jika belum ada (Windows PowerShell)
if (!(Test-Path -Path "database\database.sqlite")) { New-Item -ItemType File -Path "database\database.sqlite" }

# Migrasi tabel & jalankan seeder (DemoCvSeeder + MultiPageCvSeeder)
php artisan migrate
php artisan db:seed
```

#### Build Aset & Jalankan Server
```bash
# Build aset produksi (atau gunakan `npm run dev` untuk mode development)
npm run build

# Jalankan server lokal
php artisan serve --port=8000
```

Aplikasi dapat diakses di **[http://localhost:8000](http://localhost:8000)**.

---

## 🧪 Pengujian Otomatis & Standar Kode

```bash
# Menjalankan seluruh test suite (9 tests pada tests/Feature/CvTest.php)
php artisan test --compact

# Memformat kode PHP menggunakan Laravel Pint
vendor\bin\pint --dirty --format agent
```

---

## 📂 Struktur Direktori Proyek

```text
BikinCV/
├── app/
│   ├── Actions/Cv/                   # Action warisan (SaveCvAction, DuplicateCvAction, DeleteCvAction)
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/                 # Controller auth warisan (rute saat ini di-redirect ke /)
│   │   │   └── Cv/
│   │   │       ├── AiTranslateCvController.php  # Proxy translasi AI via Google Gemini
│   │   │       ├── ShowCvEditorController.php   # Halaman utama editor CV (GET /)
│   │   │       └── ...                          # Controller CV warisan lainnya
│   │   └── Requests/                 # Form Requests
│   └── Models/                       # Eloquent Model (Cv, User)
├── config/
│   └── services.php                  # Konfigurasi third-party termasuk Google Gemini ('gemini')
├── database/
│   ├── migrations/                   # Skema tabel database (users, cache, jobs, cvs)
│   └── seeders/                      # DatabaseSeeder, DemoCvSeeder, MultiPageCvSeeder
├── md/                               # Dokumen spesifikasi proyek (PRD, Architecture, Coding Standards, Roadmap, Templates, UI/UX)
├── resources/
│   ├── css/
│   │   └── app.css                   # Konfigurasi Tailwind v4, font rules, & stylesheet @media print A4
│   ├── js/
│   │   └── app.js                    # Store Alpine.js cvEditor(), 3 preset demo, I18N, translasi, multi-page shim, & audit ATS
│   └── views/
│       ├── components/
│       │   └── cv-templates/         # 12 Template CV ATS
│       │       ├── academic.blade.php
│       │       ├── bold.blade.php
│       │       ├── classic.blade.php
│       │       ├── compact.blade.php
│       │       ├── corporate.blade.php
│       │       ├── dual.blade.php
│       │       ├── editorial.blade.php
│       │       ├── finance.blade.php
│       │       ├── modern.blade.php
│       │       ├── nordic.blade.php
│       │       ├── swiss.blade.php
│       │       └── tech.blade.php
│       ├── layouts/
│       │   └── app.blade.php
│       └── cv-editor.blade.php       # Antarmuka utama Split-Screen Editor
├── routes/
│   └── web.php                       # Definisi rute web
└── tests/
    └── Feature/
        └── CvTest.php                # Automated Feature Tests (9 tests)
```

---

## 🖨️ Tips Mencetak PDF A4 Sempurna

Saat mengklik tombol **Unduh PDF** pada aplikasi:
1. **Tujuan Cetak (*Destination*)**: Pilih **Save as PDF** (*Simpan sebagai PDF*).
2. **Ukuran Kertas (*Paper Size*)**: Pilih **A4** (aturan `@page` sudah diset `A4 portrait` dengan margin `12mm 15mm 12mm 15mm`).
3. **Grafik Latar Belakang (*Background Graphics*)**: Aktifkan agar warna aksen, border, dan chip/badge tercetak sesuai pratinjau.
4. **Header & Footer**: **Hapus centang (Uncheck)** agar tanggal, jam, judul halaman, dan URL browser tidak ikut tercetak di kertas CV.

---

## 📄 Lisensi

Proyek ini dirilis di bawah lisensi terbuka [MIT License](LICENSE).
