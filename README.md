# BikinCV — ATS-Friendly Resume Builder & Modern PDF Generator

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

<p align="center">
  <strong>Platform pembuatan Curriculum Vitae (CV) modern, minimalis, dan 100% ramah mesin seleksi otomatis (Applicant Tracking System / ATS).</strong>
</p>

<p align="center">
  <a href="#-fitur-utama"><img src="https://img.shields.io/badge/ATS-100%25_Compliant-success?style=flat-square" alt="ATS Compliant"></a>
  <a href="#-arsitektur--teknologi"><img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel" alt="Laravel"></a>
  <a href="#-arsitektur--teknologi"><img src="https://img.shields.io/badge/TailwindCSS-v4-38B2AC?style=flat-square&logo=tailwind-css" alt="Tailwind CSS"></a>
  <a href="#-arsitektur--teknologi"><img src="https://img.shields.io/badge/Alpine.js-v3-8BC0D0?style=flat-square&logo=alpine.js" alt="Alpine.js"></a>
  <a href="#-status-fitur--perhatian-penting"><img src="https://img.shields.io/badge/Status-Guest--First_Ready-blue?style=flat-square" alt="Status"></a>
</p>

---

> [!WARNING]
> ### ⚠️ PERHATIAN: STATUS FITUR LOGIN & AUTENTIKASI (WIP)
> Fitur **Login, Registrasi, dan Akun Pengguna (Cloud Dashboard)** saat ini **BELUM SELESAI / BELUM MELALUI TAHAP TESTING MENYELURUH (Work in Progress)**.
>
> Mode operasional utama aplikasi saat ini adalah **Mode Tamu (Guest-First)**:
> - Seluruh fitur editor CV, pemilihan template, kontrol tipografi & margin, audit skor ATS, simpan otomatis (*LocalStorage*), import/export JSON, hingga cetak PDF A4 **100% aktif dan dapat langsung digunakan tanpa login**.

---

## 📖 Tentang BikinCV

Mayoritas pelamar kerja gugur pada tahap seleksi awal karena CV yang dibuat menggunakan aplikasi desain visual (seperti Canva/Photoshop) mengandung tabel rumit, elemen grafik, atau tata letak dua kolom yang membingungkan parser ATS.

**BikinCV** hadir untuk memecahkan masalah ini dengan menyediakan pembuat CV berbasis teks murni (*plain text vector layer*) yang:
1. **100% Terbaca ATS**: Format satu kolom terstruktur, hierarki heading jelas, tanpa grafik yang memblokir parser.
2. **Instant Live Preview**: Reaktivitas tinggi dengan *split-screen editor* (formulir di kiri, lembar A4 di kanan).
3. **Cetak PDF Berkualitas Tinggi**: Menggunakan standar `@media print` A4 (`210mm x 297mm`) murni dari browser tanpa watermark dan tanpa beban server.
4. **Audit ATS Real-Time**: Skor kelayakan 0–100% dilengkapi checklist saran perbaikan dan deteksi *action verbs*.

---

## ✨ Fitur Utama

- ⚡ **Split-Screen Editor Reaktif**: Perubahan data pada form langsung tersinkronisasi ke lembar CV dalam waktu `< 16ms` (didukung Alpine.js).
- 🎨 **8 Template ATS Berstandar Internasional**:
  1. **The Classic Executive** (`classic`) — Format formal standar korporat & BUMN.
  2. **Modern Minimalist** (`modern`) — Tampilan bersih untuk startup & tech industry.
  3. **Tech & Engineering Specialist** (`tech`) — Mengutamakan skill teknis, stack, dan aksen monospace.
  4. **Compact One-Pager** (`compact`) — Margin hemat ruang, ideal untuk *fresh graduate* agar pas 1 halaman.
  5. **Academic & Ivy League** (`academic`) — Format prestisius untuk riset, jurnal, beasiswa, dan akademisi.
  6. **The Nordic Clean** (`nordic`) — Desain minimalis Skandinavia dengan tipografi tracking presisi.
  7. **Finance & Wall Street Elite** (`finance`) — Format baku Harvard/Wharton untuk investment banking & konsultan.
  8. **Corporate Enterprise** (`corporate`) — Format terstruktur Fortune 500 dengan banner pembatas aksen.
- 🔠 **Tipografi & Margin Fleksibel**:
  - Pilihan font: *Inter, Roboto, Plus Jakarta Sans, Arial, Merriweather, Georgia, Garamond*.
  - Kontrol ukuran font (*Small 10pt, Normal 11pt, Large 12pt*).
  - Kontrol margin lembar (*Compact, Normal, Spacious*).
  - Kontrol jarak baris / *line-height* (*Tight, Normal, Relaxed*).
- 📊 **Real-time ATS Score Engine**:
  - Audit kelengkapan kontak (Email, Telepon, LinkedIn/GitHub).
  - Audit penggunaan *action verbs* (kata kerja aktif).
  - Audit angka/metrik kuantitatif keberhasilan.
  - Peringatan luapan halaman (*single-page overflow warning*).
- 💾 **Penyimpanan Lokal & Portabilitas Data**:
  - Autosave ke `localStorage` (data tidak hilang saat browser ditutup atau direfresh).
  - Export data ke format `.json` untuk cadangan offline.
  - Import file `.json` untuk memulihkan draf kapan saja.
- 🖨️ **Ekspor PDF Vektor Murni**: Cetak langsung via dialog print browser (`Ctrl + P` / tombol cetak) dengan margin dan pemisah halaman otomatis.

---

## 🛠️ Arsitektur & Teknologi

| Layer | Teknologi | Keterangan |
| :--- | :--- | :--- |
| **Backend Framework** | [Laravel 12.x](https://laravel.com) | PHP 8.2+ dengan standard arsitektur Single-Action Controllers |
| **Frontend Styling** | [Tailwind CSS v4](https://tailwindcss.com) | Styling modern ultra-cepat dengan stylesheet cetak `@media print` |
| **Reactivity** | [Alpine.js v3](https://alpinejs.dev) | Reaktivitas dua arah (*two-way binding*) ringan tanpa framework SPA berat |
| **Database** | SQLite (Default) / MySQL | Penyimpanan ringan dan portabel |
| **Icons & Font** | Google Fonts & Lucide/SVG Icons | Tipografi standar industri ramah ATS |

---

## 🚀 Panduan Menjalankan Aplikasi

Ikuti langkah-langkah di bawah ini untuk menjalankan BikinCV di komputer lokal Anda:

### 1. Prasyarat Sistem
Pastikan perangkat Anda sudah terinstal:
- **PHP** versi 8.2 atau lebih baru ([Unduh PHP](https://www.php.net))
- **Composer** ([Unduh Composer](https://getcomposer.org))
- **Node.js** (v18+) dan **NPM** ([Unduh Node.js](https://nodejs.org))
- **Git** ([Unduh Git](https://git-scm.com))
- *Opsional*: Laragon / XAMPP / Herd untuk kemudahan manajemen environment lokal di Windows/Mac.

---

### 2. Langkah Instalasi

#### Langkah 1: Clone Repository
Buka terminal dan clone repository ini ke folder lokal Anda:
```bash
git clone https://github.com/AnangML/BikinCV.git
cd BikinCV
```

#### Langkah 2: Install Dependensi PHP (Composer)
```bash
composer install
```

#### Langkah 3: Install Dependensi JavaScript & CSS (NPM)
```bash
npm install
```

#### Langkah 4: Siapkan File Environment (`.env`)
Salin file konfigurasi contoh:
- **Windows (Command Prompt / PowerShell):**
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

#### Langkah 6: Siapkan Database (SQLite)
Secara default, aplikasi menggunakan database **SQLite**. Buat file database SQLite jika belum ada:
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

#### Langkah 7: Kompilasi Asset Frontend
Anda memiliki 2 opsi untuk menjalankan asset:

- **Opsi A: Mode Development (Hot Reloading / Watch)**:
  ```bash
  npm run dev
  ```
- **Opsi B: Mode Production Build (Disarankan jika hanya ingin langsung mencoba)**:
  ```bash
  npm run build
  ```

#### Langkah 8: Jalankan Server Lokal Laravel
Buka tab terminal baru (jika `npm run dev` sedang berjalan) dan ketik:
```bash
php artisan serve
```

Server lokal akan berjalan di:
👉 **[http://127.0.0.1:8000](http://127.0.0.1:8000)** atau **[http://localhost:8000](http://localhost:8000)**

Buka URL tersebut di browser (Chrome, Edge, Firefox, atau Safari). Anda akan langsung masuk ke halaman **CV Editor**!

---

### 3. Menjalankan Pengujian Otomatis (Automated Testing)

Aplikasi dilengkapi pengujian unit dan fitur menggunakan PHPUnit / Pest bawaan Laravel:

```bash
php artisan test
```

Untuk menjalankan pengujian fitur CV secara spesifik:
```bash
php artisan test tests/Feature/CvTest.php
```

Untuk menjalankan pemeriksaan standar kode (Pint):
```bash
vendor\bin\pint --test
```

---

## 📂 Struktur Direktori Utama

```text
BikinCV/
├── app/
│   ├── Actions/Cv/             # Single-Action Service (Save, Duplicate, Delete)
│   ├── Http/Controllers/Cv/    # Controller Editor & Manajemen CV
│   └── Http/Requests/Cv/       # Validasi form & template payload
├── resources/
│   ├── css/
│   │   └── app.css             # Tailwind v4 & @media print stylesheet
│   ├── js/
│   │   └── app.js              # Alpine.js state store & logic audit ATS
│   └── views/
│       ├── components/
│       │   └── cv-templates/   # 8 Blade Component Template ATS
│       │       ├── classic.blade.php
│       │       ├── modern.blade.php
│       │       ├── tech.blade.php
│       │       ├── compact.blade.php
│       │       ├── academic.blade.php
│       │       ├── nordic.blade.php
│       │       ├── finance.blade.php
│       │       └── corporate.blade.php
│       └── cv-editor.blade.php # Halaman utama Live Split-Screen Editor
├── md/                         # Dokumentasi Arsitektur, PRD, & Roadmap
│   ├── PRD.md
│   ├── ROADMAP.md
│   ├── TEMPLATES.md
│   └── CODING_STANDARDS.md
└── tests/                      # Automated Feature & Unit Tests
```

---

## 📌 Tips Mencetak PDF Berkualitas Terbaik

Saat mengklik tombol **Cetak / PDF** pada toolbar editor:
1. Pada dialog cetak browser, pilih tujuan (**Destination**): **Save as PDF** / **Simpan sebagai PDF**.
2. Ukuran Kertas (**Paper Size**): **A4**.
3. Margin (**Margins**): **None** / **Tanpa Margin** (karena margin presisi sudah dikontrol oleh sistem aplikasi).
4. Opsi (**Options**): Centang **Background graphics** / **Grafik latar belakang** agar garis pemisah dan aksen warna tercetak jelas.
5. Header & Footer: **Hapus centang** (agar tanggal dan URL browser tidak muncul di lembar CV).

---

## 📄 Lisensi

Proyek ini berada di bawah lisensi terbuka [MIT License](LICENSE).
