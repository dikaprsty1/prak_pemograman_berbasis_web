# TUGAS 6 Andika Prasetyo - 4524210013
`index.php` (Before)
![index.php (Before)](https://github.com/d3wnzo/Prak-Pemrograman-Berbasis-Web-B/blob/929065de4dabc28718348834e2a18991d458a98c/4/Tugas%206/Screenshots/Before/index.png)

`index.php` (After)
![index.php (After)](https://github.com/d3wnzo/Prak-Pemrograman-Berbasis-Web-B/blob/929065de4dabc28718348834e2a18991d458a98c/4/Tugas%206/Screenshots/After/index.png)

### 1. Fitur Pencarian Dinamis (Backend Search & Filter)
* **Deskripsi:** Menambahkan penanganan kueri pencarian melalui method HTTP `GET` (`$_GET['keyword']`).
* **Implementasi:** 
  - Menggunakan kueri SQL dengan klausa `LIKE` untuk memfilter data mahasiswa berdasarkan **NPM**, **Nama**, atau **Program Studi**.
  - Mengamankan input pencarian dari serangan SQL Injection dasar menggunakan `mysqli_real_escape_string()`.
  - Menyediakan tombol *Reset* untuk mengembalikan daftar ke seluruh data mahasiswa.
  - Kode yang ditambahkan:
    ```php
    $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
    
    if (!empty($keyword)) {
      $keyword_safe = mysqli_real_escape_string($koneksi, $keyword);
      $query_sql = "SELECT * FROM mahasiswa WHERE npm LIKE '%$keyword_safe%' OR nama LIKE '%$keyword_safe%' OR prodi LIKE '%$keyword_safe%'";
    } else {
      $query_sql = "SELECT * FROM mahasiswa";
    }
    
      $query = mysqli_query($koneksi, $query_sql);
    ```

---

### 2. Keamanan Output Anti-XSS (Cross-Site Scripting)
* **Deskripsi:** Mengamankan rendering data ke layar agar tidak rentan terhadap celah keamanan XSS.
* **Implementasi:** 
  - Membuat fungsi pembantu (*helper function*) `e()` berbasis `htmlspecialchars()`.
  - Membungkus seluruh pelepasan variabel data (`$data['nama']`, dll.) dengan fungsi ini agar karakter khusus HTML ter-escape dengan aman.
  - Menambahkan `urlencode()` pada parameter URL di tautan *Edit* dan *Hapus* untuk mencegah manipulasi karakter unik pada NPM.
  - Kode yang ditambahkan:
    ```php
    function e($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
    }
    ```
    
---

### 3. Penanganan State Data Kosong (Empty State Feedback)
* **Deskripsi:** Memberikan umpan balik visual (*feedback*) yang jelas kepada pengguna apabila data yang dicari tidak ada dalam database.
* **Implementasi:** 
  - Menggunakan fungsi `mysqli_num_rows($query)` untuk memeriksa jumlah baris data yang dihasilkan.
  - Jika hasil kueri bernilai `0`, sistem menampilkan pesan *"Data mahasiswa tidak ditemukan"* di dalam baris tabel secara rapi.
  - Kode yang ditambahkan:
    ```php
    <?php if (mysqli_num_rows($query) > 0): ?>
    <?php else: ?>
    <tr>
        <td colspan="7" class="text-center p-4 text-gray-500 font-medium">
            Data mahasiswa tidak ditemukan.
        </td>
    </tr>
    <?php endif; ?>
    ```
    
---

### 4. Pembersihan Resource Server (Memory Cleanup)
* **Deskripsi:** Menerapkan *best practice* manajemen memori dan koneksi database pada PHP.
* **Implementasi:** 
  - Memanggil `mysqli_free_result($query)` di akhir baris eksekusi untuk membebaskan memori yang digunakan oleh *result set*.
  - Memanggil `mysqli_close($koneksi)` secara eksplisit untuk menutup koneksi database MySQL setelah seluruh proses penyiapan halaman selesai.
  - Kode yang ditambahkan:
    ```php
    <?php
    mysqli_free_result($query);
    mysqli_close($koneksi);
    ?>
