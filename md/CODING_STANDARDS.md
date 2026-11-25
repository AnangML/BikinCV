# Coding Standards & Architecture Guidelines
## Project: BikinCV (Laravel 13 + PHP 8.3 + Tailwind CSS v4)

Dokumen ini memuat standar penulisan kode proyek BikinCV untuk menjaga basis kode tetap bersih, mudah dibaca, mudah diuji, dan konsisten.

---

## 1. Prinsip Desain: Single Responsibility (SRP)

### 1.1 Larangan Universal / God Class
* Hindari membuat "Universal Controller" (contoh: `MainController`, `UtilityController`) atau "Universal Service" (`CommonService`, `GeneralService`).
* Setiap controller dan action class harus memiliki **satu tanggung jawab spesifik**.

### 1.2 Pola Action Classes & Single-Action Controllers
* Gunakan **Single-Action Invokable Controller** (`__invoke`) untuk setiap endpoint HTTP.
* Gunakan **Action Class** terisolasi di `app/Actions/` untuk logika bisnis domain yang kompleks.

```text
app/
├── Actions/
│   └── Cv/
│       ├── SaveCvAction.php
│       ├── DuplicateCvAction.php
│       └── DeleteCvAction.php
├── Http/
│   ├── Controllers/
│   │   ├── Auth/
│   │   │   ├── AuthenticateController.php
│   │   │   ├── LogoutController.php
│   │   │   ├── RegisterUserController.php
│   │   │   ├── ShowLoginController.php
│   │   │   └── ShowRegisterController.php
│   │   └── Cv/
│   │       ├── AiTranslateCvController.php
│   │       ├── ShowCvEditorController.php
│   │       ├── SaveCvController.php
│   │       ├── DeleteCvController.php
│   │       ├── DuplicateCvController.php
│   │       └── ListUserCvsController.php
│   └── Requests/
│       ├── Auth/
│       │   ├── LoginRequest.php
│       │   └── RegisterRequest.php
│       └── Cv/
│           └── SaveCvRequest.php
└── Models/
    ├── Cv.php
    └── User.php
```

---

## 2. Standar Query Database & Penyimpanan JSON

### 2.1 Pencegahan N+1 & Proyeksi Kolom
* Gunakan `with()` jika memuat relasi Eloquent agar terhindar dari N+1 query.
* Tentukan kolom spesifik dengan `->select([...])` dan gunakan paginasi atau scope terindeks (`Cv::scopeForUser()` menggunakan index komposit `['user_id', 'updated_at']`) untuk daftar koleksi.

### 2.2 Strategi Penyimpanan Data CV: Hybrid JSON
* Struktur CV sangat dinamis (banyak pengalaman kerja, pendidikan, keahlian, proyek, sertifikasi, pelatihan, bahasa).
* Tabel `cvs` menggabungkan kolom metadata terindeks (`id`, `user_id`, `title`, `slug`, `template_id`, `selected_font`, `doc_font_size`, `accent_color`, `ats_score`, `is_public`) dengan kolom `content` bertipe `JSON` (di-cast sebagai `array` di `App\Models\Cv`).

---

## 3. Gaya Kode, Strict Types & Dokumentasi

### 3.1 Strict Types & Tipe Data Eksplisit
* Setiap file PHP baru/aktif mencantumkan deklarasi strict types serta `final class` bila tidak diturunkan:
  ```php
  <?php

  declare(strict_types=1);

  namespace App\Http\Controllers\Cv;
  ```
* Semua parameter method dan return type wajib memiliki type hint eksplisit (termasuk `: void`, `: JsonResponse`, `: View`, serta PHPDoc array shape bila memproses array terstruktur).
* Selalu gunakan kurung kurawal `{ }` untuk seluruh blok kontrol (`if`, `foreach`, `for`), termasuk satu baris.

### 3.2 Standar Formatting (Laravel Pint)
* Seluruh perubahan file PHP wajib diformat dengan Laravel Pint sebelum finalisasi:
  ```bash
  vendor/bin/pint --dirty --format agent
  ```

---

## 4. Validasi, Error Handling & Keamanan Endpoint AI

### 4.1 Validasi Request & Rate Limiting
* Untuk endpoint mutasi kompleks, gunakan `FormRequest` (contoh: `SaveCvRequest`, `LoginRequest`, `RegisterRequest`). Untuk endpoint proxy payload JSON ringan seperti `AiTranslateCvController`, pastikan validasi input eksplisit (`nullable|array`, `nullable|string|max:5000`) dan route dilindungi rate limiter (`throttle:30,1`).

### 4.2 Penanganan Error API Eksternal
* Jangan pernah membungkam exception dengan `catch` kosong.
* Pada pemanggilan eksternal (Google Gemini API di `AiTranslateCvController`), gunakan HTTP timeout eksplisit, catat peringatan via `Log::warning(...)`, dan kembalikan respons JSON terstruktur (`fallback: true`) agar frontend bisa beralih ke mode fallback dengan mulus tanpa memutus pengalaman pengguna.

---

## 5. Ringkasan Checklist Sebelum Commit
1. [ ] Apakah perubahan PHP sudah memakai `declare(strict_types=1);` dan type hints eksplisit?
2. [ ] Apakah sudah dijalankan `vendor/bin/pint --dirty --format agent`?
3. [ ] Jika mengubah JS/CSS di `resources/`, apakah sudah dijalankan `npm run build`?
4. [ ] Apakah seluruh test (`php artisan test --compact`) lolos tanpa error?
