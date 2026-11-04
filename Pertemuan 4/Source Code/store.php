<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $prodi = $_POST['prodi'];
    $angkatan = $_POST['angkatan'];
    $ipk = $_POST['ipk'];

    $query = mysqli_query($koneksi,
    "INSERT INTO mahasiswa
    (npm, nama, email, prodi, angkatan, ipk)
    VALUES
    ('$npm', '$nama', '$email', '$prodi', '$angkatan', '$ipk')"
    );

    if ($query) {
        echo "<script>
        alert('Data berhasil disimpan.');
            window.location.href = 'index.php'; </script>";
    } else {
        echo "<script>
        alert('Data gagal disimpan.');
        window.history.back(); </script>";
    }
}
?>