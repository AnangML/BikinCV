# Implementation Roadmap & Milestone Tracker
## Project: BikinCV

---

## 🎯 Tahap 1: Setup Foundation & Static ATS Preview
- [x] Buat layout split-screen Blade (`cv-editor.blade.php`) dengan Tailwind CSS v4.
- [x] Implementasi stylesheet cetak A4 (`@media print`) untuk output PDF murni vector text.
- [x] Bangun komponen template ATS pertama (**The Classic Executive**) dengan margin dan tipografi baku.
- [x] Isi state awal dengan data demo berkualitas tinggi.

## 🎯 Tahap 2: Alpine.js Reaktif & Local Autosave
- [x] Buat store/komponen Alpine.js (`cvEditor()`) untuk *two-way data binding* antara form dan lembar A4.
- [x] Fitur penambahan, penghapusan, dan pengaturan urutan item dinamis (Pengalaman, Pendidikan, Skill).
- [x] Fitur `localStorage` autosave & restore otomatis (agar data pengguna tidak hilang jika browser ditutup).
- [x] Implementasi tombol trigger `window.print()` untuk ekspor PDF instan.

## 🎯 Tahap 3: 8 Template ATS Standar & Pengaturan Tipografi
- [x] Template 1: **The Classic Executive** (`classic`) — Serif / Formal / BUMN & Korporasi.
- [x] Template 2: **Modern Minimalist** (`modern`) — Clean Sans / Startup & Tech.
- [x] Template 3: **Tech & Engineering Specialist** (`tech`) — Skills & Stack first, Monospace accents.
- [x] Template 4: **Compact One-Pager** (`compact`) — Margin hemat, pas 1 lembar untuk Freshgrad.
- [x] Template 5: **Academic & Ivy League** (`academic`) — Prestisius, riset, publikasi, beasiswa.
- [x] Template 6: **The Nordic Clean** (`nordic`) — Estetika minimalis Skandinavia, tracking rapi, asimetris elegan.
- [x] Template 7: **Finance & Wall Street Elite** (`finance`) — Format baku Harvard/Wharton IB, Education first, deal bullets.
- [x] Template 8: **Corporate Enterprise** (`corporate`) — Fortune 500, Operations & HR, banner section bergaris aksen.
- [x] Selector switch template real-time tanpa me-reset data yang sudah diketik pengguna.
- [x] Kontrol ukuran font dokumen (Small 10pt, Regular 11pt, Large 12pt) dan pilihan aksen warna ATS-safe.

## 🎯 Tahap 4: ATS Score Engine & Content Helper
- [x] Algoritma audit konten CV (client-side):
  - [x] Deteksi kelengkapan data kontak.
  - [x] Deteksi penggunaan *action verbs* pada setiap poin pengalaman kerja.
  - [x] Peringatan overflow halaman (jika teks melebihi 1 halaman A4).
- [x] Indikator skor ATS dinamis (0–100%) dengan checklist saran perbaikan visual.
- [x] Modal/Accordion daftar saran kata kerja aktif per kategori.

## 🎯 Tahap 5: Backend Cloud Sync & Akun Pengguna (Optional Phase)
- [x] Migrasi tabel `cvs` dengan kolom payload `content (json)`.
- [x] Implementasi Single-Action: `SaveCvAction`, `DuplicateCvAction`, `DeleteCvAction`.
- [x] Otentikasi pengguna untuk sinkronisasi draft dari `localStorage` ke database.
- [x] Dashboard CV Pengguna (Edit, Duplikasi 1-klik, Hapus, Paginasi efisien).
