<?php
include "koneksi.php";

$npm = $_GET['npm'];

$query = mysqli_query(
    $koneksi,
    "DELETE FROM mahasiswa
    WHERE npm='$npm'"
);

if ($query) {
    echo "<script>
        alert('Data mahasiswa berhasil dihapus');
        window.location.href = 'index.php';
        </script>";
} else {
    echo "<script>
        alert('Data gagal dihapus');
        window.history.back();
        </script>";
}
?>