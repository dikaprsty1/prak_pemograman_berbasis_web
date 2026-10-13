
-- Praktikum PBW - Pertemuan 3
-- Modifikasi database akademik
-- Database dibuat terpisah dari database lain.

CREATE DATABASE IF NOT EXISTS akademik_pertemuan3
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE akademik_pertemuan3;

-- 1. Tabel dosen
CREATE TABLE IF NOT EXISTS dosen (
    nidn VARCHAR(20) NOT NULL PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(120) UNIQUE
) ENGINE=InnoDB;

-- 2. Tabel mahasiswa
CREATE TABLE IF NOT EXISTS mahasiswa (
    nim VARCHAR(15) NOT NULL PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    prodi VARCHAR(80) NOT NULL,
    angkatan YEAR NOT NULL,
    ipk DECIMAL(3,2) DEFAULT NULL,
    CHECK (ipk BETWEEN 0.00 AND 4.00)
) ENGINE=InnoDB;

-- 3. Tabel mata kuliah
CREATE TABLE IF NOT EXISTS mata_kuliah (
    kode_mk VARCHAR(12) NOT NULL PRIMARY KEY,
    nama_mk VARCHAR(100) NOT NULL,
    sks TINYINT UNSIGNED NOT NULL,
    nidn VARCHAR(20) DEFAULT NULL,
    INDEX fk_mk_dosen (nidn),
    CONSTRAINT fk_mk_dosen
        FOREIGN KEY (nidn)
        REFERENCES dosen(nidn)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- 4. Tabel KRS
CREATE TABLE IF NOT EXISTS krs (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(15) NOT NULL,
    kode_mk VARCHAR(12) NOT NULL,
    semester TINYINT UNSIGNED NOT NULL,
    tahun_ajaran VARCHAR(9) NOT NULL,
    nilai_huruf CHAR(2) DEFAULT NULL,
    UNIQUE KEY uq_krs (nim, kode_mk, semester, tahun_ajaran),
    INDEX fk_krs_mk (kode_mk),
    CONSTRAINT fk_krs_mahasiswa
        FOREIGN KEY (nim)
        REFERENCES mahasiswa(nim)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_krs_mk
        FOREIGN KEY (kode_mk)
        REFERENCES mata_kuliah(kode_mk)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- MODIFIKASI 1:
-- Menambahkan kolom status mahasiswa
ALTER TABLE mahasiswa
ADD COLUMN status_mahasiswa
ENUM('Aktif', 'Cuti', 'Lulus')
NOT NULL DEFAULT 'Aktif';

-- Data dosen
INSERT INTO dosen (nidn, nama, email) VALUES
('001', 'Dr. Budi Santoso', 'budi@kampus.ac.id'),
('002', 'Siti Aminah, M.Kom.', 'siti@kampus.ac.id');

-- Data mahasiswa
INSERT INTO mahasiswa
(nim, nama, email, prodi, angkatan, ipk, status_mahasiswa)
VALUES
('2026001', 'Andi Pratama', 'andi@kampus.ac.id',
 'Teknik Informatika', 2026, 3.75, 'Aktif'),
('2026002', 'Siti Rahma', 'rahma@kampus.ac.id',
 'Sistem Informasi', 2026, 3.82, 'Aktif'),
('2025001', 'Dika Saputra', 'dika@kampus.ac.id',
 'Teknik Informatika', 2025, 3.50, 'Cuti');

-- Data mata kuliah
INSERT INTO mata_kuliah (kode_mk, nama_mk, sks, nidn) VALUES
('MK001', 'Basis Data', 3, '001'),
('MK002', 'Pemrograman Web', 3, '002'),
('MK003', 'Struktur Data', 3, '001');

-- Data KRS
INSERT INTO krs
(nim, kode_mk, semester, tahun_ajaran, nilai_huruf)
VALUES
('2026001', 'MK001', 1, '2026/2027', 'A'),
('2026001', 'MK002', 1, '2026/2027', 'A'),
('2026002', 'MK001', 1, '2026/2027', 'B'),
('2025001', 'MK003', 3, '2026/2027', 'A');

-- MODIFIKASI 2:
-- Menampilkan data akademik dengan JOIN
SELECT
    m.nim,
    m.nama AS nama_mahasiswa,
    m.prodi,
    m.status_mahasiswa,
    mk.nama_mk AS mata_kuliah,
    mk.sks,
    d.nama AS dosen_pengampu,
    k.semester,
    k.tahun_ajaran,
    k.nilai_huruf
FROM mahasiswa AS m
JOIN krs AS k
    ON m.nim = k.nim
JOIN mata_kuliah AS mk
    ON k.kode_mk = mk.kode_mk
LEFT JOIN dosen AS d
    ON mk.nidn = d.nidn
ORDER BY m.nim, mk.nama_mk;

-- Query tambahan: mahasiswa aktif saja
SELECT nim, nama, prodi, ipk, status_mahasiswa
FROM mahasiswa
WHERE status_mahasiswa = 'Aktif'
ORDER BY ipk DESC;