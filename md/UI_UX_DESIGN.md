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

### 2.1 Palet Warna Web Application
* **Canvas Background**: `bg-slate-50` / `bg-neutral-100` (memberikan kontras bersih agar lembar CV A4 putih terlihat melayang elegan seperti kertas asli di atas meja kerja).
* **Primary Brand Accent**: `Indigo-600` (`#4f46e5`) ke `Violet-600` (`#7c3aed`) untuk tombol aksi utama (*Download PDF* & *Pilih Template*).
* **Success Indicator**: `Emerald-500` (`#10b981`) untuk status autosave (*"Draft tersimpan"*) dan skor ATS tinggi.
* **Text Hierarchy**: Slate-900 (`#0f172a`) untuk judul utama, Slate-600 (`#475569`) untuk label/penjelasan, dan Slate-400 untuk placeholder.

### 2.2 Tipografi
* **UI Website**: Menggunakan font modern **Plus Jakarta Sans** atau **Inter** dari Google Fonts (terkenal sangat nyaman dibaca di layar retina).
* **Dokumen CV**: Menggunakan font khusus ATS yang dapat diganti per template (Inter, Georgia, Garamond, JetBrains Mono).

---

## 3. Komponen Antarmuka & Tata Letak

### 3.1 Top Navigation Bar (Header Modern)
* **Kiri**: Logo BikinCV dengan badge status *"ATS-Ready v1.0"*.
* **Tengah**: 
  - Status Autosave: Indikator titik hijau berkedip halus + teks *"Tersimpan di browser"*.
  - Template Quick Switcher: Dropdown bergaya pills untuk mengganti template seketika.
* **Kanan**:
  - Tombol **"Isi Contoh Data"** (ikon magic wand): Mengisi form dengan data profesional 1-klik bagi pemula.
  - Widget **"Skor ATS"** mini (badge persentase interaktif yang dapat diklik untuk melihat saran perbaikan).
  - Tombol Utama **"Download PDF (A4)"**: Tombol kontras dengan efek hover glow dan ikon printer.

### 3.2 Panel Kiri: Form Editor Interaktif
* **Accordion Rapi per Bagian**:
  1. 👤 Data Pribadi & Kontak (Nama, Email, WhatsApp, LinkedIn, Domisili).
  2. 📝 Ringkasan Profil (dengan counter karakter & tips kalimat pembuka).
  3. 💼 Pengalaman Kerja (Bisa tambah banyak pekerjaan, tombol hapus, dan bullet point per pekerjaan).
  4. 🎓 Pendidikan (Instansi, Gelar, Tahun Lulus, IPK).
  5. ⚡ Keahlian / Skills (Input tag interaktif: ketik + tekan Enter).
  6. 🏆 Sertifikasi & Proyek (Opsional).
* **Fitur Kemudahan**:
  - Tombol *Add More* yang jelas dengan animasi halus.
  - Helper tooltip ramah pemula (misal di bawah field Summary: *"💡 Tips ATS: Sebutkan jabatan impian dan pencapaian terbesarmu dalam 2-3 kalimat"*).

### 3.3 Panel Kanan: Canvas Dokumen A4 Realistis
* Lembar putih A4 (`210mm x 297mm`) diletakkan di tengah viewport dengan bayangan realistis (*drop shadow deep*: `shadow-2xl ring-1 ring-slate-900/5`).
* Floating Floating Zoom Controls di sudut bawah (+ Zoom In, - Zoom Out, Fit Page).
* Indikator garis pembatas halaman jika teks pengguna mulai meluap (*page break indicator*).

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
