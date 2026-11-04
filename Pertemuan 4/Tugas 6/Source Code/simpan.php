<?php
include 'koneksi.php';

$npm = $_POST['npm'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$prodi = $_POST['prodi'];
$angkatan = $_POST['angkatan'];
$ipk = $_POST['ipk'];

$query = mysqli_query (
    $koneksi,
    "INSERT INTO mahasiswa
    (npm, nama, email, prodi, angkatan, ipk)
    VALUES
    ('$npm', '$nama', '$email', '$prodi', '$angkatan', '$ipk')"
    );

    if ($query) {
        echo "Data berhasil disimpan.";
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
?>