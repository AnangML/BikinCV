# Product Requirements Document (PRD)
## Project: BikinCV - ATS-Friendly Resume Builder

---

## 1. Executive Summary & Problem Statement
### 1.1 Latar Belakang
Sebagian besar pelamar kerja di Indonesia dan global menggunakan template visual (seperti Canva) dengan grafik, tabel kompleks, dan format dua kolom yang tidak ramah mesin pencari pelamar kerja (**Applicant Tracking System / ATS**). Akibatnya, CV mereka tereliminasi di tahap seleksi otomatis sebelum dibaca oleh HRD.

### 1.2 Tujuan Produk
Membangun platform pembuat CV modern yang:
1. Menjamin output dokumen 100% terbaca oleh ATS (*plain text vector layer extraction*).
2. Memberikan pengalaman pembuatan CV instan (*real-time split screen preview*) yang super ringan menggunakan **Laravel Blade + Alpine.js**.
3. Mendukung alur **Guest-First**: pengguna dapat langsung menyusun CV dan mengunduh PDF secara instan tanpa hambatan registrasi.
4. Memberikan audit kelengkapan dan skor ATS (*ATS Score Checker*).
5. Menghasilkan file PDF berstandar A4 yang rapi dan konsisten via browser print native.

---

## 2. Target Pengguna (User Persona)
* **Fresh Graduate**: Butuh panduan struktur CV yang benar, rekomendasi aksi kata kerja (*action verbs*), dan template gratis tanpa watermark.
* **Mid-level Professional**: Butuh kustomisasi section, kemampuan membuat beberapa versi CV untuk posisi pekerjaan berbeda, serta pencocokan keyword loker.
* **Career Switcher**: Butuh penekanan pada *skills* dan *transferable projects* dengan format ATS yang bersih.

---

## 3. Fitur Utama & Ruang Lingkup (Scope)

### 3.1 Fase 1: MVP (Minimum Viable Product)
| ID | Fitur | Deskripsi | Prioritas |
| :--- | :--- | :--- | :--- |
| **F-01** | **Split-Screen Editor (Blade + Alpine.js)** | Form input di sisi kiri dan preview dokumen A4 di sisi kanan dengan sinkronisasi instan (*two-way binding via Alpine.js*). | P0 (Must Have) |
| **F-02** | **Guest-First Experience** | Pengguna langsung diarahkan ke editor CV tanpa wajib login/register. Data tersimpan di `localStorage`. | P0 (Must Have) |
| **F-03** | **Dynamic Section Management** | Tambah/hapus/atur urutan untuk Pengalaman Kerja, Pendidikan, Organisasi/Proyek, Sertifikasi, dan Skill. | P0 (Must Have) |
| **F-04** | **5 ATS Standard Templates** | Tersedia 5 template ATS standar industri (The Classic Executive, Modern Minimalist, Tech & Engineering, Compact One-Pager, Academic) dengan pilihan ukuran font dan aksen warna aman ATS. Detail lengkap di `md/TEMPLATES.md`. | P0 (Must Have) |
| **F-05** | **Client-Side Native PDF Print** | Cetak/unduh PDF menggunakan CSS `@media print` ukuran A4 murni (`210mm x 297mm`) tanpa watermark dan nol beban CPU server. | P0 (Must Have) |
| **F-06** | **Pre-fill Demo Data** | Tombol 1-klik untuk mengisi contoh data CV berkualitas tinggi agar user langsung melihat hasil render. | P1 (Should Have) |

### 3.2 Fase 2: ATS Intelligence & Enhancement
| ID | Fitur | Deskripsi | Prioritas |
| :--- | :--- | :--- | :--- |
| **F-07** | **ATS Score Engine (Client-Side)** | Indikator skor 0–100% yang mengecek kontak, panjang ringkasan, penggunaan angka/metrik, dan action verbs. | P1 (Should Have) |
| **F-08** | **Action Verb Recommender** | Rekomendasi kata kerja kuat berdasarkan kategori (Manajerial, Teknis, Analitis, dsb). | P1 (Should Have) |
| **F-09** | **Job Description Keyword Matcher** | User memasukkan teks loker, sistem mendeteksi kecocokan kata kunci dan memberi saran kata yang kurang. | P2 (Nice to Have) |
| **F-10** | **AI Bullet Point Enhancer** | Menulis ulang kalimat biasa menjadi formula Google XYZ (*Accomplished X, measured by Y, by doing Z*). | P2 (Nice to Have) |

### 3.3 Fase 3: User Accounts & Multi-CV (Optional Save to Cloud)
| ID | Fitur | Deskripsi | Prioritas |
| :--- | :--- | :--- | :--- |
| **F-11** | **Save Draft to Cloud (Auth)** | Pengguna guest dapat melakukan sign up/login untuk menyimpan CV ke database akun permanen. | P1 (Should Have) |
| **F-12** | **Multi-Version CV Dashboard** | Mengelola banyak CV (misal: "CV Frontend Dev", "CV Product Manager") dan fitur duplikasi 1-klik. | P1 (Should Have) |
| **F-13** | **Import / Export JSON** | Pengguna dapat backup dan restore data CV dalam bentuk file JSON secara offline. | P2 (Nice to Have) |

---

## 4. Kriteria Non-Fungsional (Non-Functional Requirements)
1. **Performa**:
   - Reaktivitas pengetikan form ke preview dokumen < 16ms (60 FPS via Alpine.js di client).
   - Ukuran bundle JavaScript sangat minim (Blade + Alpine.js CDN / npm bundle < 50KB).
2. **Kesesuaian ATS**:
   - Dokumen PDF wajib memiliki layer teks ASCII/UTF-8 yang dapat diseleksi dan di-copy-paste.
   - Tidak menggunakan tabel visual rumit atau floating elements yang merusak alur pembacaan (reading flow order).
3. **Responsivitas**:
   - Desktop: Split screen (50% Form, 50% Preview A4).
   - Mobile: Tab toggle (Form <-> Preview) dengan floating action button untuk beralih mode dan mencetak.
4. **Estetika & Kemudahan Pengguna (UI/UX)**:
   - Desain modern bergaya SaaS premium (palet slate bersih, aksen indigo/emerald, efek bayangan kertas A4 realistis, mikro-animasi halus).
   - Pendekatan edukatif dan ramah pemula dengan tips kontekstual dan fitur 1-klik isi data demo. Detail lengkap di `md/UI_UX_DESIGN.md`.
