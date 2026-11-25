# Implementation Roadmap & Milestone Tracker
## Project: BikinCV

---

## 🎯 Tahap 1: Setup Foundation & Static ATS Preview
- [x] Buat layout split-screen Blade ([resources/views/cv-editor.blade.php](../resources/views/cv-editor.blade.php)) dengan Tailwind CSS v4.
- [x] Implementasi stylesheet cetak A4 (`@media print` di [resources/css/app.css](../resources/css/app.css)) untuk output PDF murni vector text.
- [x] Bangun komponen template ATS pertama (**The Classic Executive**) dengan margin dan tipografi baku.
- [x] Isi state awal dengan data demo berkualitas tinggi.

## 🎯 Tahap 2: Alpine.js Reaktif, Local Autosave & Portabilitas
- [x] Buat store/komponen Alpine.js (`cvEditor()` di [resources/js/app.js](../resources/js/app.js)) untuk *two-way data binding* antara form dan lembar A4.
- [x] Fitur penambahan ke bawah (`push`), penghapusan, dan pengaturan urutan item dinamis (`↑`/`↓`) pada seluruh seksi berulang.
- [x] Lengkapi menjadi **9 Seksi Formulir**: Informasi Pribadi (+ kompresi foto profil client-side), Ringkasan Profil, Pengalaman Kerja, Pendidikan, Keahlian & Teknologi, Proyek, Sertifikasi, Pelatihan & Seminar, serta Bahasa yang Dikuasai.
- [x] Fitur `LocalStorage` autosave (`bikincv_draft`) & restore otomatis serta **Ekspor / Impor JSON**.
- [x] Implementasi kontrol zoom pratinjau (`50%–150%`), modal panduan cetak bersih (`bikincv_hide_print_tips`), dan ekspor PDF instan (`window.print()`).

## 🎯 Tahap 3: 12 Template ATS Standar & Pengaturan Tipografi
- [x] Template 1: **The Classic Executive** (`classic`)
- [x] Template 2: **Modern Minimalist** (`modern`)
- [x] Template 3: **Tech & Engineering Specialist** (`tech`)
- [x] Template 4: **Compact One-Pager** (`compact`)
- [x] Template 5: **Academic & Ivy League** (`academic`)
- [x] Template 6: **The Nordic Clean** (`nordic`)
- [x] Template 7: **Finance & Wall Street Elite** (`finance`)
- [x] Template 8: **Corporate Enterprise** (`corporate`)
- [x] Template 9: **The Modern Two-Column** (`dual`)
- [x] Template 10: **The Swiss International** (`swiss`)
- [x] Template 11: **The Bold Header** (`bold`)
- [x] Template 12: **The Editorial / Modern Creative** (`editorial`)
- [x] Selector switch template real-time, 7 pilihan font ATS-safe, 3 ukuran dokumen (`10pt`/`11pt`/`12pt`), dan 4 aksen warna.

## 🎯 Tahap 4: ATS Score Engine, Smart Multi-Page & Gemini AI Translation
- [x] Algoritma audit konten CV client-side (`atsAudit` skor `0–100%` pada 5 kategori + tombol jump *"Perbaiki"*).
- [x] Modal kamus saran kata kerja aktif (*Action Verbs*).
- [x] Smart Multi-Page Engine (`checkPageOverflow()`) dengan garis batas halaman A4 visual dan anti-orphan `.cv-page-break-shim`.
- [x] Kamus label multibahasa (`I18N` ID/EN) di 12 template dan pemformat rentang tanggal konsisten `formatDateRange()`.
- [x] Integrasi Google Gemini AI (`AiTranslateCvController` di `POST /cv/translate-ai`) dengan batch prompting, normalisasi bulan/durasi Indonesia ➔ Inggris, fallback translator client-side, dan fitur **Balik ke ID** (`bikincv_id_backup`).
- [x] 3 Preset Demo (`default`, `multipage`, `english`) dan seeder database (`DemoCvSeeder`, `MultiPageCvSeeder`) dengan 3 bahasa yang dikuasai.

## 🎯 Tahap 5: Skema Database & Status Privacy-First
- [x] Migrasi tabel `cvs` ([2026_10_25_000001_create_cvs_table.php](../database/migrations/2026_10_25_000001_create_cvs_table.php)) dan Eloquent model `Cv`.
- [x] Action classes (`SaveCvAction`, `DuplicateCvAction`, `DeleteCvAction`) & feature tests (`tests/Feature/CvTest.php`).
- [x] **Keputusan Arsitektur Final:** Untuk menjaga komitmen **100% Privacy-First & Zero-Login**, rute `/login`, `/register`, `/dashboard`, dan `/cv/save` di-redirect ke `/` di [routes/web.php](../routes/web.php) — aplikasi berjalan murni di browser pengguna dan versi komersial berfitur cloud disiapkan sebagai proyek terpisah.
