# Praktikum Pemrograman Berbasis Web (PBW)

## Pertemuan 3 — Modifikasi Database Akademik

### 1. Deskripsi

Praktikum ini membahas pembuatan dan modifikasi database akademik menggunakan MySQL/MariaDB melalui phpMyAdmin pada XAMPP.

Database yang digunakan adalah `akademik_pertemuan3`, dengan tabel:

* `dosen`
* `mahasiswa`
* `mata_kuliah`
* `krs`

### 2. Tujuan Praktikum

1. Membuat database dan tabel yang saling berhubungan.
2. Memahami penggunaan primary key dan foreign key.
3. Melakukan modifikasi struktur tabel.
4. Menggabungkan data beberapa tabel menggunakan query JOIN.

### 3. Modifikasi Program

**Modifikasi 1 — Menambahkan status mahasiswa**

Menambahkan kolom `status_mahasiswa` pada tabel `mahasiswa`, dengan pilihan status Aktif, Cuti, dan Lulus. Nilai default yang digunakan adalah Aktif.

**Modifikasi 2 — Query JOIN**

Menggabungkan tabel mahasiswa, KRS, mata kuliah, dan dosen untuk menampilkan informasi akademik, seperti nama mahasiswa, program studi, mata kuliah, dosen pengampu, semester, dan nilai.

### 4. Lima Bagian Kode Penting

1. `CREATE DATABASE`: membuat database akademik.
2. `CREATE TABLE`: membuat tabel untuk menyimpan data.
3. `PRIMARY KEY`: menentukan identitas unik setiap data.
4. `FOREIGN KEY`: menghubungkan tabel yang saling berkaitan.
5. `JOIN`: menggabungkan data dari beberapa tabel berdasarkan relasi antartabel.

### 5. Error dan Perbaikan

**Error:** `#1060 - Duplicate column name 'status_mahasiswa'`

**Penyebab:** Kolom `status_mahasiswa` sudah ditambahkan sebelumnya, tetapi perintah `ALTER TABLE` dijalankan kembali.

**Perbaikan:** Memeriksa struktur tabel terlebih dahulu dan memastikan kolom tidak ditambahkan berulang kali.

Error lain yang sempat muncul adalah `#1046 - No database selected`. Error ini terjadi karena query dijalankan tanpa memilih database. Perbaikannya adalah memilih database `akademik_pertemuan3` terlebih dahulu atau menjalankan perintah `USE akademik_pertemuan3;`.

### 6. Screenshot Hasil Praktikum

Screenshot hasil praktikum disimpan di folder `screenshot`:

* `1_tabel_sebelum.png`
* `2_tabel_sesudah.png`
* `3_hasil_query_join.png`

### 7. Cara Menjalankan

1. Jalankan Apache dan MySQL melalui XAMPP.
2. Buka phpMyAdmin melalui `http://localhost/phpmyadmin`.
3. Jalankan file `Pertemuan3_awal.sql` untuk membuat database dan tabel awal.
4. Jalankan `Pertemuan3_modifikasi.sql` untuk menerapkan modifikasi.
5. Periksa struktur tabel dan hasil query JOIN.

### 8. Kesimpulan

Praktikum ini memberikan pemahaman tentang pembuatan database relasional, penggunaan primary key dan foreign key, modifikasi tabel, serta penggabungan data menggunakan JOIN.
