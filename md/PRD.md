# Product Requirements Document (PRD)
## Project: BikinCV - ATS-Friendly Resume Builder

---

## 1. Executive Summary & Problem Statement
### 1.1 Latar Belakang
Sebagian besar pelamar kerja di Indonesia dan global menggunakan template visual (seperti Canva) dengan grafik, tabel kompleks, dan dekorasi yang tidak ramah mesin pencari pelamar kerja (**Applicant Tracking System / ATS**). Akibatnya, CV mereka gagal terbaca atau tereliminasi di tahap seleksi otomatis sebelum dibaca oleh HRD.

### 1.2 Tujuan Produk
Membangun platform pembuat CV modern yang:
1. Menjamin output dokumen 100% terbaca oleh ATS (*plain text vector layer extraction*).
2. Memberikan pengalaman pembuatan CV instan (*real-time split screen preview*) yang ringan menggunakan **Laravel Blade + Alpine.js + Tailwind CSS v4**.
3. Menerapkan alur **Privacy-First & Zero-Login**: pengguna langsung menyusun CV, menyimpan draf di `LocalStorage`, dan mengunduh PDF secara instan tanpa hambatan registrasi atau penyimpanan data pribadi di server.
4. Memberikan audit kelengkapan dan skor ATS (*ATS Score Checker*) beserta kamus *Action Verbs*.
5. Menyediakan terjemahan otomatis Bahasa Indonesia ke Bahasa Inggris standar ATS berbasis **Google Gemini AI** dengan cadangan restore satu klik.
6. Menghasilkan file PDF berstandar A4 (1 hingga multi-halaman) yang rapi dan konsisten via browser print native.

---

## 2. Target Pengguna (User Persona)
* **Fresh Graduate**: Butuh panduan struktur CV yang benar, rekomendasi kata kerja aktif (*action verbs*), dan template hemat halaman (*Compact One-Pager*) gratis tanpa watermark.
* **Mid-level & Senior Professional**: Butuh kustomisasi 9 seksi lengkap, dukungan dokumen multi-page A4 (2–4 lembar), serta terjemahan instan ke Bahasa Inggris standar global untuk melamar ke perusahaan multinasional atau remote.
* **Career Switcher & Tech Talent**: Butuh penekanan pada *skills*, *projects*, sertifikasi, pelatihan, dan penguasaan bahasa dengan format ATS yang bersih.

---

## 3. Fitur Utama & Ruang Lingkup (Scope)

### 3.1 Fase 1: Core Editor & ATS Templates
| ID | Fitur | Deskripsi | Prioritas | Status |
| :--- | :--- | :--- | :--- | :--- |
| **F-01** | **Split-Screen Editor (Blade + Alpine.js)** | Form input akordion di sisi kiri dan preview dokumen A4 di sisi kanan dengan sinkronisasi instan (*two-way binding via Alpine.js*). | P0 | Selesai |
| **F-02** | **Privacy-First & Zero-Login** | Pengguna langsung diarahkan ke editor CV di `/` tanpa login/register. Draft otomatis tersimpan di browser (`LocalStorage`). | P0 | Selesai |
| **F-03** | **Dynamic 9-Section Management** | Tambah (ke urutan bawah / `push`), hapus, dan atur urutan (`↑`/`↓`) untuk: Informasi Pribadi (+ kompresi foto client-side), Ringkasan Profil, Pengalaman Kerja, Pendidikan, Keahlian & Teknologi, Proyek, Sertifikasi, Pelatihan & Seminar, dan Bahasa yang Dikuasai. | P0 | Selesai |
| **F-04** | **12 ATS Standard Templates** | Tersedia 12 template (`classic`, `modern`, `tech`, `compact`, `academic`, `nordic`, `finance`, `corporate`, `dual`, `swiss`, `bold`, `editorial`) dengan pilihan 7 font, 3 ukuran teks, dan 4 aksen warna. Detail lengkap di `md/TEMPLATES.md`. | P0 | Selesai |
| **F-05** | **Client-Side Native PDF Print & Multi-Page** | Cetak/unduh PDF via CSS `@media print` A4 (`210mm x 297mm`) tanpa watermark, dilengkapi *Smart Page Break Shim* dan modal panduan cetak bersih. | P0 | Selesai |
| **F-06** | **3 Preset Data Demo** | Dropdown 1-klik untuk memuat *Demo Standar (1 Lembar)*, *Demo Multi-Page (3+ Lembar)*, dan *Demo English ATS*, seluruhnya dilengkapi 3 bahasa yang dikuasai. | P1 | Selesai |

### 3.2 Fase 2: ATS Intelligence & AI Translation
| ID | Fitur | Deskripsi | Prioritas | Status |
| :--- | :--- | :--- | :--- | :--- |
| **F-07** | **ATS Score Engine (Client-Side)** | Audit skor `0–100%` pada 5 kategori (Kontak, Ringkasan, Pengalaman/Action Verbs/Metrik, Pendidikan, Keahlian) dengan tombol navigasi *"Perbaiki"*. | P1 | Selesai |
| **F-08** | **Action Verb Recommender** | Modal kamus kata kerja kuat per kategori (Teknis, Kepemimpinan, Hasil & Pertumbuhan). | P1 | Selesai |
| **F-09** | **AI Auto-Translate EN & Undo Backup** | Terjemahan batch seluruh isi CV Indonesia ➔ Inggris standar ATS via Google Gemini (`POST /cv/translate-ai`) + konversi tanggal/bulan, fallback client-side, dan tombol `↩️ Balik ke ID` (`bikincv_id_backup`). | P1 | Selesai |
| **F-10** | **Import / Export JSON** | Backup dan restore seluruh data CV dalam format file `.json` secara offline. | P2 | Selesai |

### 3.3 Fase 3: Status Modul Akun & Cloud Sync (Legacy / Nonaktif)
| ID | Fitur | Status Saat Ini |
| :--- | :--- | :--- |
| **F-11** | **Auth & Cloud Save (`/login`, `/register`, `/dashboard`, `/cv/save`)** | Komponen backend (tabel `cvs`, model `Cv`, `SaveCvAction`, auth controllers) tersedia sebagai fondasi historis, namun rute webnya sengaja **di-redirect ke `/`** untuk mempertahankan arsitektur **100% Gratis, Tanpa Login, dan Privacy-First**. |

---

## 4. Kriteria Non-Fungsional (Non-Functional Requirements)
1. **Performa & Responsivitas**:
   - Reaktivitas pengetikan form ke pratinjau A4 berjalan murni di client-side Alpine.js.
   - Desktop: Split-screen (sidebar form `380px–400px` di kiri, kanvas preview A4 dengan zoom `50%–150%` di kanan).
   - Mobile: Bottom bar switch (`Editor Form` <-> `Pratinjau A4`) beserta tombol `Cetak`.
2. **Kesesuaian ATS**:
   - Dokumen PDF wajib memiliki layer teks UTF-8 yang dapat diseleksi dan di-copy-paste.
   - Menggunakan heading semantik dan alur pembacaan yang jelas tanpa elemen dekoratif penghalang parser.
3. **Estetika & Kemudahan Pengguna (UI/UX)**:
   - Desain SaaS modern minimalis (palet neutral bersih, modal panduan unduh PDF, kontrol bar terjemahan AI ringkas). Detail lengkap di `md/UI_UX_DESIGN.md`.
