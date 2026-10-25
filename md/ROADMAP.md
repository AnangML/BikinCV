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

## 🎯 Tahap 3: 5 Template ATS Standar & Pengaturan Tipografi
- [x] Template 1: **The Classic Executive** (Serif / Formal / BUMN & Finance).
- [x] Template 2: **Modern Minimalist** (Clean Sans / Tech & Startup).
- [x] Template 3: **Tech & Engineering Specialist** (Skills & Stack first, Monospace accents).
- [x] Template 4: **Compact One-Pager** (Margin hemat, pas 1 lembar untuk Freshgrad).
- [x] Template 5: **Academic & Ivy League** (Prestisius, riset, beasiswa, publikasi).
- [x] Selector switch template real-time tanpa me-reset data yang sudah diketik pengguna.
- [x] Kontrol ukuran font dokumen (Small 10pt, Regular 11pt, Large 12pt) dan pilihan aksen warna ATS-safe.

## 🎯 Tahap 4: ATS Score Engine & Content Helper
- [ ] Algoritma audit konten CV (client-side):
  - Deteksi kelengkapan data kontak.
  - Deteksi penggunaan *action verbs* pada setiap poin pengalaman kerja.
  - Peringatan overflow halaman (jika teks melebihi 1 halaman A4).
- [ ] Indikator skor ATS dinamis (0–100%) dengan checklist saran perbaikan visual.
- [ ] Modal/Accordion daftar saran kata kerja aktif per kategori.

## 🎯 Tahap 5: Backend Cloud Sync & Akun Pengguna (Optional Phase)
- [ ] Migrasi tabel `cvs` dengan kolom payload `content (json)`.
- [ ] Implementasi Single-Action: `SaveCvAction`, `LoadCvAction`, `DuplicateCvAction`.
- [ ] Otentikasi pengguna untuk sinkronisasi draft dari `localStorage` ke database.
