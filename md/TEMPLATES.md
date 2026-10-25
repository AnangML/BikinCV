# Specification: ATS-Compliant CV Templates
## Project: BikinCV

Dokumen ini memuat spesifikasi desain, tipografi, struktur section, dan target industri untuk 5 template CV ATS yang tersedia di BikinCV.

---

## 1. Aturan Mutlak Desain Template ATS
Setiap template wajib mematuhi batasan berikut agar lolos parser ATS (Workday, Taleo, Greenhouse, Lever, dll):
1. **No Graphics for Skills**: Dilarang menggunakan bintang, bar persentase (e.g. "Python 80%"), atau dot rating. Skill wajib ditulis dalam bentuk teks terstruktur.
2. **True Single-Column / Unbroken Reading Flow**: Alur pembacaan dari atas ke bawah tanpa kolom samping melayang (*floating sidebars*) yang memecah parsing teks.
3. **High Contrast**: Teks utama wajib menggunakan warna hitam pekat (`#111827` / `#000000`) dengan latar belakang putih murni (`#ffffff`).
4. **Standard Headings**: Menggunakan penamaan bagian baku (*Summary, Experience, Education, Skills, Projects, Certifications*).

---

## 2. Katalog 5 Template ATS

### 2.1 Template 1: "The Classic Executive" (`classic`)
* **Target Industri**: BUMN, Perbankan, Keuangan, Hukum, Konsultan Manajemen, Korporasi Multinasional.
* **Tipografi**: Serif elegan (`Georgia`, `Merriweather`, atau `Times New Roman`).
* **Header Layout**: Rata tengah (*Center-aligned*).
  - Nama kandidat: Ukuran 20pt–24pt, Bold, Uppercase.
  - Kontak: Ditampilkan dalam satu atau dua baris terpusat, dipisahkan oleh tanda bullet (`•`).
* **Section Divider**: Garis horizontal solid tegas (`border-b-2 border-neutral-800`).
* **Karakter**: Formal, berwibawa, dan 100% kompatibel bahkan dengan sistem ATS generasi tertua.

### 2.2 Template 2: "Modern Minimalist" (`modern`)
* **Target Industri**: Startup, Product Management, Marketing, FinTech, Digital Agency.
* **Tipografi**: Sans-serif modern dan bersih (`Inter`, `Roboto`, `Helvetica`).
* **Header Layout**: Rata kiri (*Left-aligned*).
  - Nama kandidat: Ukuran 22pt, Bold.
  - Target Role / Subtitle tepat di bawah nama.
  - Kontak: Grid 2 kolom rapi di sisi header.
* **Section Divider**: Aksen warna profesional (Navy `#1e3a8a`, Slate `#334155`) dengan letter-spacing halus (`tracking-wider`).
* **Karakter**: Tampilan modern dan segar bagi rekruter manusia, namun tetap ramah pembacaan mesin.

### 2.3 Template 3: "Tech & Engineering Specialist" (`tech`)
* **Target Industri**: Software Engineer, DevOps, Cloud Engineer, Data Scientist, QA Engineer.
* **Tipografi**: Hybrid Clean Sans (`Inter`) dengan aksen Monospace (`JetBrains Mono` / `Roboto Mono`) untuk skill tags, versi teknologi, dan tautan repositori.
* **Hirarki Section Khusus**:
  - Section **Skills & Tech Stack ditaruh paling atas** (tepat setelah Ringkasan/Header), dikelompokkan: *Languages, Frameworks, Cloud/Infrastructure, Databases/Tools*.
  - Link GitHub, Portfolio, dan link demo terintegrasi langsung pada item Proyek dan Pengalaman.
* **Karakter**: Didesain khusus agar *Engineering Manager* dan *Tech Recruiter* dapat mencocokkan *tech stack* dalam 3 detik pertama.

### 2.4 Template 4: "Compact One-Pager" (`compact`)
* **Target Industri**: Fresh Graduate, Pelamar Magang, atau Profesional dengan pengalaman di bawah 3 tahun.
* **Tipografi**: Sans-serif efisien ruang (`Arial`, `Inter Compact`).
* **Layout**:
  - Margin kertas lebih hemat (`10mm - 12mm`).
  - Spasi antar item dan line-height dibuat rapat (*dense*) namun tetap proporsional dan mudah dibaca.
  - Tanggal dan lokasi ditaruh sejajar di sisi kanan (*right-aligned inline*).
* **Tujuan**: Mencegah teks meluber ke halaman 2 secara nanggung (menjaga CV tetap presisi 1 lembar A4).

### 2.5 Template 5: "Academic & Ivy League" (`academic`)
* **Target Industri**: Dosen, Peneliti, Tenaga Medis, serta Pelamar Beasiswa Pascasarjana (LPDP, Chevening, Fulbright).
* **Tipografi**: Garamond klasik (*Harvard/Oxford CV Standard*).
* **Hirarki Section Khusus**:
  - Mengutamakan *Education*, *Research Experience*, *Publications*, *Conferences*, *Honors & Awards*.
* **Karakter**: Prestisius, konservatif, dan mematuhi format baku dunia akademik internasional.

### 2.6 Template 6: "The Nordic Clean" (`nordic`)
* **Target Industri**: Product Designer, UI/UX Lead, Brand Strategist, Startup Founder, Creative Technologist.
* **Tipografi**: Geometric Sans-Serif dengan letter-spacing elegan (`tracking-[0.15em]`).
* **Layout**:
  - Header asimetris kiri modern dengan kontak ringkas berpoin dot halus.
  - Heading section bersih dengan garis pemisah hairline netral tipis.
* **Karakter**: Estetika minimalis Skandinavia kontemporer, sangat rapi untuk dibaca manusia dan 100% lolos robot ATS.

### 2.7 Template 7: "Finance & Wall Street Elite" (`finance`)
* **Target Industri**: Investment Banking (Goldman Sachs, Morgan Stanley), Private Equity, Management Consulting (MBB: McKinsey, BCG, Bain), Big 4 Advisory.
* **Tipografi**: Authoritative Serif murni dengan penekanan kuat pada tanggal dan jabatan.
* **Hirarki Section Khusus**:
  - **Education ditaruh paling atas** sesuai konvensi baku Wharton / Harvard / Wall Street Oasis (WSO).
  - Poin pengalaman kerja difokuskan pada hasil transaksi kuantitatif (*transaction/deal bullets*).
* **Karakter**: Elit, berbobot, berwibawa, dan mematuhi standar terketat industri finansial global.

### 2.8 Template 8: "Corporate Enterprise" (`corporate`)
* **Target Industri**: Fortune 500, Healthcare, Supply Chain, Logistik, Project Manager, Operations, HR Corporate.
* **Tipografi**: Modern Sans-Serif bersih dengan banner judul section bergaris aksen kiri (*subtle shaded banner*).
* **Layout**:
  - Blok header korporat 2-kolom dengan kartu kontak kompak di sisi kanan.
  - Section title berbalut background kontras halus (`bg-neutral-100`) dengan border-l aksen.
* **Karakter**: Sangat mudah di-scan dalam 6 detik pertama oleh HRD korporasi besar tanpa mengorbankan keterbacaan bot ATS.

---

## 3. Pilihan Font Terkurasi (ATS-Safe Font Selection)

Pengguna dapat mengganti jenis font dokumen secara bebas melalui toolbar pratinjau. Seluruh font yang disediakan dijamin 100% aman untuk mesin pembaca ATS:

### A. Kategori Modern Sans-Serif (Bersih, Rapi & Tech-friendly)
1. **Inter** *(Default)*: Font geometris dengan legibility tinggi di layar maupun cetak.
2. **Roboto**: Font standar internasional dengan proporsi seimbang.
3. **Plus Jakarta Sans**: Tipografi kontemporer premium yang sangat cocok untuk industri kreatif & teknologi.
4. **Arial**: Font sistem universal tanpa kemungkinan gagal render di parser manapun.

### B. Kategori Formal Serif (Berwibawa, Eksekutif & Akademik)
5. **Merriweather**: Serif modern dengan x-height lebar yang nyaman dibaca untuk teks padat.
6. **Georgia**: Standar korporat global, perbankan, dan hukum.
7. **Garamond**: Format baku institusi akademik dunia dan lamaran beasiswa internasional.

---

## 4. Fitur Kustomisasi Dokumen Tambahan

Pengguna dapat mengubah atribut visual berikut tanpa merusak struktur data:
1. **Pilihan Ukuran Font Dokumen**:
   - `Small (10pt)`: Untuk memadatkan konten banyak agar muat 1 halaman.
   - `Regular (11pt)`: Standar paling seimbang.
   - `Large (12pt)`: Untuk konten fresh graduate agar halaman tidak terlihat sepi.
2. **Pilihan Aksen Warna (Heading & Divider)**:
   - Charcoal Black (`#111827`) - Default
   - Deep Navy (`#1e3a8a`)
   - Slate Blue (`#334155`)
   - Forest Green (`#14532d`)
   - Deep Burgundy (`#4c0519`)
