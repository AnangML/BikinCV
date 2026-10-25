# Enterprise Coding Standards & Architecture Guidelines
## Project: BikinCV (Laravel 12 + Tailwind CSS)

Dokumen ini memuat standar penulisan kode standar korporasi/enterprise untuk memastikan basis kode tetap bersih, mudah dibaca, mudah diuji, aman, dan berkinerja tinggi.

---

## 1. Prinsip Desain: Single Responsibility (SRP)

### 1.1 Larangan Keras: Universal / God Class
* **DILARANG** membuat "Universal Controller" (contoh: `MainController`, `AppController`, `UtilityController`).
* **DILARANG** membuat "Universal Service" (contoh: `CommonService`, `HelperService`, `GeneralService`, `DataService`).
* Setiap controller dan service harus memiliki **satu tanggung jawab spesifik (Single Responsibility Principle)**.

### 1.2 Pola Action Classes & Single-Action Controllers
* Gunakan pola **Action Class** untuk logika bisnis domain yang terisolasi.
* Controller disarankan berupa **Single-Action Invokable Controller** (`__invoke`) atau Resource Controller standar RESTful yang ramping.

```
app/
├── Actions/
│   └── Cv/
│       ├── CreateCvAction.php
│       ├── UpdateCvAction.php
│       ├── DuplicateCvAction.php
│       └── ExportCvToPdfAction.php
├── Http/
│   ├── Controllers/
│   │   └── Cv/
│   │       ├── ListUserCvsController.php
│   │       ├── ShowCvEditorController.php
│   │       ├── StoreCvController.php
│   │       └── ExportPdfController.php
│   └── Requests/
│       └── Cv/
│           ├── StoreCvRequest.php
│           └── UpdateCvRequest.php
└── Services/
    └── Ats/
        ├── KeywordMatcherService.php
        └── AtsScoreCalculatorService.php
```

---

## 2. Standar Query Database: Efisien & Bebas N+1

Untuk menjaga performa aplikasi tetap cepat dan tidak membebani database:

### 2.1 Pencegahan N+1 Query (Wajib Eager Loading)
* Wajib menggunakan `with()` saat memanggil relasi Eloquent.
* Aktifkan strict mode di `AppServiceProvider`:
  ```php
  Model::preventLazyLoading(! app()->isProduction());
  Model::preventSilentlyDiscardingAttributes(! app()->isProduction());
  ```

### 2.2 Proyeksi Kolom (Pilih Kolom yang Dibutuhkan)
* **DILARANG** melakukan `select *` pada query yang membaca banyak baris data.
* Selalu tentukan kolom yang diambil:
  ```php
  // BENAR
  $cvs = Cv::query()
      ->where('user_id', $userId)
      ->select(['id', 'title', 'slug', 'updated_at', 'ats_score'])
      ->orderByDesc('updated_at')
      ->paginate(10);

  // SALAH
  $cvs = Cv::where('user_id', $userId)->get();
  ```

### 2.3 Strategi Penyimpanan Data CV: Hybrid JSON
* Struktur CV sangat dinamis (bisa ada 10 pengalaman kerja, 5 pendidikan, list skill tak terbatas).
* Menormalkan setiap section ke 8 tabel relasi terpisah membuat query read/write membutuhkan banyak *JOIN* dan transaksi rumit.
* **Standar Enterprise untuk CV**: Gunakan pendekatan **Hybrid Data**:
  - Kolom relasional/indeks utama: `id`, `user_id`, `title`, `slug`, `template_id`, `ats_score`, `created_at`, `updated_at`.
  - Kolom payload dinamis: `content` tipe data `JSONB`/`JSON` untuk seluruh struktur bagian CV.
  - Dengan cara ini, membuka editor CV hanya memerlukan **1 query single-row lookup by ID** (`SELECT * FROM cvs WHERE id = ?`).

### 2.4 Paginasi & Batasan Data
* Jangan pernah menggunakan `->get()` tanpa batasan `->take()` atau `->paginate()` untuk data koleksi pengguna.

---

## 3. Gaya Kode, Tipetitas & Dokumentasi

### 3.1 Strict Types & Tipe Data Eksplisit
* Setiap file PHP **wajib** mencantumkan deklarasi strict types:
  ```php
  <?php

  declare(strict_types=1);

  namespace App\Actions\Cv;
  ```
* Semua parameter fungsi, variabel, dan return type **wajib memiliki tipe data eksplisit** (`string`, `int`, `array`, `?Cv`, `void`, dll).

### 3.2 Dokumentasi (DocBlocks & Clean Code)
* Kode harus *self-documenting*: penamaan variabel dan fungsi menggunakan bahasa Inggris yang deskriptif. Hindari singkatan ambigu seperti `$d`, `$tmp`, `$res`, `$dt`.
* Setiap method publik wajib memiliki PHPDoc singkat jika menerima array terstruktur atau melempar exception:
  ```php
  /**
   * Menghitung skor kelayakan ATS berdasarkan kelengkapan section dan format kata kunci.
   *
   * @param array<string, mixed> $cvContent
   * @return AtsScoreResult
   * @throws AtsCalculationException
   */
  public function calculate(array $cvContent): AtsScoreResult
  ```

### 3.3 Standar Formatting (Laravel Pint)
* Gunakan aturan Laravel Pint berbasis PSR-12.
* Jalankan pembersihan kode secara berkala:
  ```bash
  ./vendor/bin/pint
  ```

---

## 4. Validasi & Penanganan Error

### 4.1 Form Request untuk Seluruh Validasi HTTP
* **DILARANG** melakukan `$request->validate([...])` langsung di dalam controller.
* Semua validasi harus dibuat di kelas `FormRequest` tersendiri dengan pesan error yang ramah pengguna.

### 4.2 Error Handling & Logging Terstruktur
* Jangan pernah menyembunyikan error dengan `catch (\Exception $e) {}` kosong.
* Gunakan logging berkonteks terstruktur:
  ```php
  Log::error('Gagal mengekspor PDF CV', [
      'cv_id' => $cvId,
      'user_id' => auth()->id(),
      'error' => $e->getMessage(),
  ]);
  ```

### 4.3 Database Transactions untuk Operasi Jamak
* Semua operasi mutasi yang melibatkan lebih dari satu proses simpan wajib dibungkus `DB::transaction()`:
  ```php
  return DB::transaction(function () use ($dto): Cv {
      // Logic mutasi aman
  });
  ```

---

## 5. Ringkasan Checklist Sebelum Commit
1. [ ] Apakah ada controller/service "universal"? (Harus dipisah jika ada).
2. [ ] Apakah query bebas N+1 dan membatasi kolom yang diambil?
3. [ ] Apakah file sudah memiliki `declare(strict_types=1);` dan type hints?
4. [ ] Apakah validasi request berada di `FormRequest`?
5. [ ] Apakah kode sudah diformat dengan Laravel Pint?
