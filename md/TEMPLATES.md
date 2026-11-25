# Specification: 12 ATS-Compliant CV Templates
## Project: BikinCV

Dokumen ini memuat spesifikasi desain, tipografi, struktur section, dan target industri untuk **12 template CV ATS** yang tersedia di BikinCV ([resources/views/components/cv-templates/](../resources/views/components/cv-templates)).

---

## 1. Aturan Desain Template ATS
Setiap template dirancang untuk menjaga keterbacaan oleh mesin parser ATS (Workday, Taleo, Greenhouse, Lever, dll.) sekaligus tampil rapi bagi HRD:
1. **No Graphics for Skills**: Dilarang menggunakan bintang, bar persentase (mis. "Python 80%"), atau dot rating. Keahlian & penguasaan bahasa ditulis dalam bentuk teks terstruktur.
2. **Clean Text Reading Flow**: Menggunakan elemen HTML semantik (`header`, `section`, `h1`, `h2`, `h3`, `ul`, `li`, `p`) tanpa tabel kompleks. Pada template ber-sidebar/timeline (`dual`, `swiss`), pembagian kolom tetap memakai struktur flex terurut yang mudah diekstrak sebagai teks murni.
3. **High Contrast**: Teks utama menggunakan kontras hitam/abu gelap pada latar putih murni (`#ffffff`).
4. **Bilingual Standard Headings (`I18N`)**: Mendukung label bahasa **Indonesia** (`BAHASA`, `PENGALAMAN KERJA`, dst.) maupun **English** (`LANGUAGES`, `WORK EXPERIENCE`, dst.) secara dinamis melalui helper `t()`.
5. **Conditional Optional Sections**: Seksi opsional (seperti *Proyek*, *Sertifikasi*, *Pelatihan*, dan *Bahasa yang Dikuasai*) otomatis tersembunyi bila datanya kosong agar tidak menyisakan ruang kosong.

---

## 2. Katalog 12 Template ATS

### 2.1 Template 1: "The Classic Executive" (`classic`)
* **Target Industri**: BUMN, Perbankan, Keuangan, Hukum, Konsultan Manajemen, Korporasi Multinasional.
* **Header & Layout**: Tata letak 1 kolom formal rata tengah, pembatas section berupa garis solid berwarna aksen (`border-b`), serta daftar ber-bullet klasik.

### 2.2 Template 2: "Modern Minimalist" (`modern`)
* **Target Industri**: Startup, Product Management, Marketing, FinTech, Digital Agency.
* **Header & Layout**: Header rata kiri bersih dengan garis pembatas seksi beraksen warna dan spasi huruf modern (`tracking-wider`).

### 2.3 Template 3: "Tech & Engineering Specialist" (`tech`)
* **Target Industri**: Software Engineer, DevOps, Cloud Engineer, Data Scientist, QA Engineer.
* **Hirarki Khusus**: Seksi **Keahlian & Teknologi** ditempatkan di bagian awal tepat setelah ringkasan profil, dengan aksen monospace (`JetBrains Mono`) untuk tag teknologi dan alignment 2 kolom untuk daftar skill & bahasa.

### 2.4 Template 4: "Compact One-Pager" (`compact`)
* **Target Industri**: Fresh Graduate, Pelamar Magang, atau profesional dengan pengalaman < 3 tahun.
* **Layout**: Padding dan jarak vertikal dirapatkan terukur agar konten padat tetap muat presisi dalam 1 lembar A4.

### 2.5 Template 5: "Academic & Ivy League" (`academic`)
* **Target Industri**: Dosen, Peneliti, Tenaga Medis, Pelamar Beasiswa Pascasarjana (LPDP, Chevening, Fulbright).
* **Karakter**: Penekanan tipografi serif (`font-serif`) bergaya standar CV akademik internasional.

### 2.6 Template 6: "The Nordic Clean" (`nordic`)
* **Target Industri**: Product Designer, UI/UX Lead, Brand Strategist, Startup Founder.
* **Karakter**: Minimalis Skandinavia dengan uppercase tracking (`tracking-[0.15em]`), garis hairline abu-abu lembut (`border-neutral-200`), dan layout label-nilai sejajar.

### 2.7 Template 7: "Finance & Wall Street Elite" (`finance`)
* **Target Industri**: Investment Banking, Private Equity, Management Consulting, Big 4 Advisory.
* **Hirarki Khusus**: **Education ditempatkan paling atas** sesuai konvensi Harvard/Wharton, dengan pembatas garis hitam tegas (`border-b border-black`) dan penekanan metrik kuantitatif.

### 2.8 Template 8: "Corporate Enterprise" (`corporate`)
* **Target Industri**: Fortune 500, Operations, Supply Chain, Project Manager, HR Corporate.
* **Karakter**: Judul seksi berbalut banner halus (`bg-neutral-100 rounded-xs border-l-3`) dengan warna aksen di sisi kiri dan susunan info rata rapi.

### 2.9 Template 9: "The Modern Two-Column" (`dual`)
* **Target Industri**: Profesional kreatif, Manajer Produk, Konsultan, serta pelamar yang ingin menampilkan pas foto profesional.
* **Layout**: 2 kolom (`34%` sidebar kiri untuk **Foto Opsional**, Kontak, Keahlian, Sertifikasi, dan Bahasa yang Dikuasai; `66%` kolom utama kanan untuk Header Nama, Ringkasan, Pengalaman, Pendidikan, Proyek, dan Pelatihan).

### 2.10 Template 10: "The Swiss International" (`swiss`)
* **Target Industri**: Arsitek, Desainer Produk, Tech Lead, Konsultan Strategi.
* **Layout**: Grid tipografi Swiss dengan penomoran seksi (`01 / ...` hingga `08 / ...`), garis timeline vertikal (`border-l-2`), dan gutter kiri (`w-[26%] text-right`) untuk tanggal/institusi/label.

### 2.11 Template 11: "The Bold Header" (`bold`)
* **Target Industri**: Eksekutif Muda, Business Development, Tech Manager, atau pelamar yang mengutamakan kesan pertama kuat + pas foto opsional.
* **Layout**: Banner header modern (`rounded-xl bg-neutral-50/70` dengan top-border aksen 4px), chip kontak individual, indikator kotak aksen (`w-2.5 h-3.5`) di tiap judul seksi, dan pill badge tanggal/skor di kanan.

### 2.12 Template 12: "The Editorial / Modern Creative" (`editorial`)
* **Target Industri**: Creative Director, Editorial/Media, Brand Lead, Senior Designer, Tech Strategist.
* **Layout**: Masthead bergaya majalah kontemporer (*CURRICULUM VITAE / PROFESSIONAL DOSSIER*), pas foto opsional, strip kontak double-hairline, penomoran dossier (`01 / ...` – `08 / ...`) disertai sub-label italic berbahasa Inggris.

---

## 3. Pilihan Font Terkurasi (7 Font ATS-Safe)
Dikonfigurasi di `resources/css/app.css` dan `getFontFamily()` di `resources/js/app.js`:

### A. Kategori Sans-Serif
1. **Inter** *(Default)*
2. **Roboto**
3. **Plus Jakarta Sans** (`jakarta`)
4. **Arial**

### B. Kategori Serif
5. **Merriweather**
6. **Georgia**
7. **Garamond** (`EB Garamond`)

*(Catatan: Elemen ber-class `.font-mono` mempertahankan `JetBrains Mono` untuk aksen tanggal/kode teknis.)*

---

## 4. Kustomisasi Ukuran & Warna Dokumen
1. **Ukuran Font Dokumen**:
   - `10pt` (`doc-size-sm` — CSS `9.5pt`, line-height `1.35`)
   - `11pt` (`doc-size-base` — Default, CSS `10.5pt`, line-height `1.45`)
   - `12pt` (`doc-size-lg` — CSS `11.5pt`, line-height `1.55`)
2. **4 Aksen Warna ATS-Safe** (`cv-editor.blade.php`):
   - **Hitam** (`#111827`) *(Default)*
   - **Navy** (`#1e3a8a`)
   - **Charcoal** (`#334155`)
   - **Forest** (`#14532d`)
