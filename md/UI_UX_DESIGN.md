# UI/UX Design System & Experience Guidelines
## Project: BikinCV - Modern, Clean & Intuitive ATS Resume Builder

Dokumen ini mendefinisikan filosofi desain antarmuka (UI), arsitektur tata letak (*layout*), dan pengalaman pengguna (UX) pada [cv-editor.blade.php](../resources/views/cv-editor.blade.php) agar BikinCV tampil **modern, minimalis, dan intuitif**.

---

## 1. Filosofi Desain: "Powerfully Simple"
Terinspirasi oleh estetika aplikasi SaaS modern (seperti *Linear, Notion, & Stripe*):
* **Zero Cognitive Overload**: Formulir dikelompokkan dalam akordion bernomor (`01`–`09`) dengan pembuka satu seksi pada satu waktu.
* **Instant Gratification**: Setiap perubahan pada formulir di sisi kiri langsung dirender pada lembar kertas A4 di sisi kanan secara real-time.
* **Guiding, Not Judging**: Skor ATS dilengkapi tombol **"Perbaiki"** yang melompat langsung ke seksi yang perlu dilengkapi, serta modal kamus kata kerja aktif dan panduan cetak PDF.

---

## 2. Palet Warna & Tipografi

### 2.1 Palet Warna Web Application
* **Canvas Background**: `bg-neutral-100` untuk menciptakan kontras jelas di sekitar kertas A4 putih (`#ffffff`).
* **Primary CTA**: `bg-neutral-900` dengan hover `bg-neutral-800` untuk tombol utama (*Unduh PDF*, *Auto EN (AI)*).
* **Surface & Borders**: Sidebar putih dengan border netral tipis (`border-neutral-200`) dan grup toolbar bergaya pill/segment (`bg-neutral-50`).
* **Semantic Dots**: `bg-emerald-500`/`bg-emerald-600` untuk status tersimpan, Bahasa Indonesia, dan skor ATS tinggi; `bg-blue-600` untuk status mode English (ATS) dan proses translasi AI; `bg-amber-500` / `bg-rose-500` untuk indikator skor ATS menengah/rendah.

### 2.2 Tipografi
* **UI Website**: Menggunakan `Plus Jakarta Sans` / `Inter` dengan ukuran kompak (`text-xs` & `text-[11px]`) agar sidebar tetap lega.
* **Dokumen CV**: 7 pilihan font ATS-safe (`Inter`, `Roboto`, `Plus Jakarta Sans`, `Arial`, `Merriweather`, `Georgia`, `Garamond`) + `JetBrains Mono` untuk aksen monospace.

---

## 3. Komponen Antarmuka & Tata Letak

### 3.1 Top Navigation Bar (`header.no-print`)
* **Kiri**: Logo tipografis `BikinCV`, input inline edit judul dokumen (`cvTitle`), dan indikator autosave (`saveStatusText`).
* **Tengah** *(Desktop `lg:flex`)*: Segmen toolbar kompak berisi dropdown **12 Template**, **7 Font**, **3 Ukuran Font (`10pt`/`11pt`/`12pt`)**, dan **4 Dot Warna Aksen** (`#111827`, `#1e3a8a`, `#334155`, `#14532d`).
* **Kanan**:
  - Dropdown **"Demo"** berisi 3 pilihan: *Demo Standar (1 Lembar)*, *Demo Multi-Page (3+ Lembar)*, dan *Demo English ATS 🇬🇧*.
  - Pill indikator **"ATS {skor}%"** untuk membuka modal audit kelayakan ATS.
  - Tombol CTA utama **"Unduh PDF"**.

### 3.2 Panel Kiri: Sidebar Formulir (`380px–400px`)
* **Quick Tools Header**: Tombol ringkas `Impor` (`.json`), `Ekspor` (`.json`), dan `Reset`.
* **Global AI Translation Bar**:
  - Menampilkan status bahasa aktif dengan indikator dot: `Bahasa: Indonesia` atau `Bahasa: English (ATS)`.
  - Mode **Indonesia**: Menampilkan satu tombol utama minimalis **`✨ Auto EN (AI)`** (`bg-neutral-900`).
  - Mode **English** (atau saat ada backup ID): Menampilkan tombol **`↩️ Balik ke ID`** berdampingan dengan **`✨ Re-Translate`**, serta toast progres *Gemini AI* saat proses berjalan.
* **9 Seksi Akordion Bernomor**:
  - `01` Informasi Pribadi *(+ Upload & hapus foto profil)*
  - `02` Ringkasan Profil
  - `03` Pengalaman Kerja *(+ link Kamus Kata Kerja Aktif)*
  - `04` Riwayat Pendidikan
  - `05` Keahlian & Teknologi *(Tag input per kategori)*
  - `06` Proyek & Portofolio
  - `07` Sertifikasi & Lisensi
  - `08` Pelatihan & Seminar
  - `09` Bahasa yang Dikuasai *(dengan datalist saran bahasa & tingkat kemahiran)*
* **Urutan Item Konsisten**: Setiap seksi berulang memiliki kontrol **`↑` / `↓`**, tombol `Hapus`, serta tombol **`+ Tambah ...`** di bagian bawah yang selalu menambahkan item baru ke urutan paling bawah (`push`).

### 3.3 Panel Kanan: Canvas Dokumen A4 Realistis
* **Control Bar Atas**: Menampilkan info `Format A4 • N Halaman`, badge status (`1 Lembar (Standar)` atau `Multi-Page (N Lembar)`), dan kontrol zoom layar (`−`, `50%–150%`, `+`, `Reset`).
* **Multi-Page Info Banner**: Muncul saat halaman > 1 dengan tombol cepat **"Padatkan (10pt)"** dan opsi tutup.
* **Visual A4 Sheet & Divider**: Menunjukkan jarak pemisah kertas fisik A4 (*Akhir Lembar p / PEMISAH HALAMAN A4 / Awal Lembar p+1*) lengkap dengan kalkulasi shim anti-orphan.

### 3.4 Modals & Mobile Sticky Bar
* **3 Modals Edukatif**:
  1. Modal **Kata Kerja Kuat (Action Verbs)** (`showActionVerbsModal`).
  2. Modal **Audit Skor ATS** (`showAtsAuditModal`) dengan progress bar per kategori & tombol *Perbaiki*.
  3. Modal **Tips Unduh PDF Bersih Standar ATS** (`showPrintGuideModal`) lengkap dengan opsi *"Jangan tampilkan tips ini lagi"*.
* **Mobile Bottom Bar (`< lg`)**: Switch tab **`Editor Form`** <-> **`Pratinjau A4`** beserta tombol **`Cetak`**.
