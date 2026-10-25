# UI/UX Design System & Experience Guidelines
## Project: BikinCV - Modern, Clean & Intuitive ATS Resume Builder

Dokumen ini mendefinisikan filosofi desain antarmuka (UI), arsitektur tata letak (layout), dan pengalaman pengguna (UX) agar BikinCV tampil **modern, elegan, berkelas SaaS premium**, sekaligus **sangat mudah dipahami oleh orang awam**.

---

## 1. Filosofi Desain: "Powerfully Simple"
Banyak web pembuat CV terlalu rumit (terlalu banyak tombol membingungkan) atau sebaliknya terlalu membosankan seperti form administrasi jadul. BikinCV mengadopsi standar desain produk modern (terinspirasi dari estetika *Linear, Notion, & Stripe*):
* **Zero Cognitive Overload**: Informasi disajikan bertahap (*progressive disclosure*) menggunakan accordion interaktif yang rapi.
* **Instant Gratification**: Setiap huruf yang diketik di sisi kiri langsung muncul di lembar CV A4 sisi kanan secara instan (*live split-screen*).
* **Guiding, Not Judging**: Indikator skor ATS dirancang edukatif dan memotivasi, bukan membuat pengguna takut salah.

---

## 2. Palet Warna & Tipografi

### 2.1 Palet Warna Web Application (Ultra-Clean & Minimalist)
* **Canvas Background**: `bg-neutral-100` (memberikan kontras bersih agar lembar CV A4 putih terlihat menonjol dan proporsional seperti kertas asli di atas meja kerja).
* **Primary Brand Action**: `Neutral-900` pekat (`#171717`) dengan hover `Neutral-800` untuk tombol aksi utama (*Unduh PDF*). Bersih, tegas, dan elegan tanpa gradient pelangi atau shadow berlebihan.
* **Secondary Actions & Inputs**: Border tipis `border-neutral-200` dengan latar belakang putih atau `neutral-50`.
* **Indicator**: `Emerald-500` halus untuk titik status autosave dan skor ATS tinggi.
* **Text Hierarchy**: `Neutral-900` untuk judul utama, `Neutral-700` untuk body/label, dan `Neutral-400` untuk keterangan sekunder atau placeholder.

### 2.2 Tipografi
* **UI Website**: Menggunakan font modern **Plus Jakarta Sans** atau **Inter** dari Google Fonts dengan bobot tipografi presisi (*medium* & *semibold*).
* **Dokumen CV**: Menggunakan font khusus ATS yang dapat diganti per template (Inter, Roboto, Plus Jakarta Sans, Arial, Merriweather, Georgia, Garamond).

---

## 3. Komponen Antarmuka & Tata Letak

### 3.1 Top Navigation Bar (Header Minimalis)
* **Kiri**: Logo tipografis bersih `BikinCV` tanpa ikon/box gradien yang mencolok, dilengkapi indikator autosave minimalis.
* **Tengah**: 
  - Kontrol dokumen tanpa ikon ramai: Dropdown template, font selector, font size, dan titik warna aksen minimalis.
* **Kanan**:
  - Tombol teks **"Isi Demo"** (tanpa ikon).
  - Pill indikator **"ATS: 100%"** ringkas.
  - Tombol sekunder **"Simpan Cloud"**.
  - Tombol utama **"Unduh PDF"** berwarna hitam pekat (`bg-neutral-900`).
  - Link Akun / Masuk.

### 3.2 Panel Kiri: Form Editor Minimalis (Accordion Bernomor)
* **Struktur Bersih Tanpa Ikon Berlebih**:
  - `01. Informasi Pribadi`
  - `02. Ringkasan Profil`
  - `03. Pengalaman Kerja`
  - `04. Riwayat Pendidikan`
  - `05. Keahlian & Keterampilan`
  - `06. Proyek Portofolio`
  - `07. Sertifikasi & Lisensi`
* **Indikator Senyap**: Menggunakan indikator `−`/`+` dan panah ringkas `↑`/`↓` tanpa visual noise.
* **Input Field**: Border tipis netral dengan fokus ring hitam yang rapi.

### 3.3 Panel Kanan: Canvas Dokumen A4 Realistis
* Lembar putih A4 (`210mm x 297mm`) diletakkan di tengah viewport dengan latar netral bersih (`bg-neutral-100`) dan border halus.
* Floating Zoom Controls di bagian atas (`A4`, `−`, `100%`, `+`, `Reset`).
* Indikator peringatan jika teks pengguna mulai meluap melebihi 1 halaman (*page break indicator*).

### 3.4 Responsivitas di Layar HP (Mobile UX)
Di layar HP, split-screen desktop otomatis berubah menjadi mode intuitif:
* **Bottom Floating Bar**: Dua tombol switch besar:
  - `[ 📝 Isi Data ]` (Form Mode)
  - `[ 👁️ Pratinjau ]` (Full A4 Preview Mode)
* Tombol *Download PDF* tetap mudah dijangkau dari mana saja.

---

## 4. Mikro-Animasi & Interaksi Halus
1. **Feedback Visual**: Saat mengklik *"Isi Contoh Data"*, field terisi dengan transisi lembut.
2. **Dynamic ATS Meter**: Lingkaran skor ATS bertambah secara animatif dari 0% ke 85%+ saat user melengkapi form.
3. **Template Preview Hover**: Menampilkan preview thumbnail kecil saat memilih template.
