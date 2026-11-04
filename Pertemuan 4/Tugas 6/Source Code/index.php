<?php
include "koneksi.php";

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

if (!empty($keyword)) {
    $keyword_safe = mysqli_real_escape_string($koneksi, $keyword);
    $query_sql = "SELECT * FROM mahasiswa WHERE npm LIKE '%$keyword_safe%' OR nama LIKE '%$keyword_safe%' OR prodi LIKE '%$keyword_safe%'";
} else {
    $query_sql = "SELECT * FROM mahasiswa";
}

$query = mysqli_query($koneksi, $query_sql);

function e($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Data Mahasiswa</title>
</head>
<body class="bg-gray-50 p-6 font-sans text-gray-800">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Data Mahasiswa</h2>
        
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 gap-3">
            <a href="create.php"
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded text-center">
            + Tambah Mahasiswa
            </a>

            <form method="GET" action="" class="flex gap-2">
                <input type="text" name="keyword" value="<?= e($keyword); ?>" placeholder="Cari NPM / Nama / Prodi..." 
                class="border border-gray-300 p-2 rounded w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded text-sm font-semibold hover:bg-gray-900">
                Cari
                </button>
                <?php if (!empty($keyword)): ?>
                    <a href="index.php" class="bg-gray-200 text-gray-700 px-3 py-2 rounded text-sm hover:bg-gray-300 flex items-center">
                    Reset
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-200 p-3 font-semibold">NPM</th>
                        <th class="border border-gray-200 p-3 font-semibold">Nama</th>
                        <th class="border border-gray-200 p-3 font-semibold">Email</th>
                        <th class="border border-gray-200 p-3 font-semibold">Prodi</th>
                        <th class="border border-gray-200 p-3 font-semibold">Angkatan</th>
                        <th class="border border-gray-200 p-3 font-semibold">IPK</th>
                        <th class="border border-gray-200 p-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (mysqli_num_rows($query) > 0): ?>
                        <?php while ($data = mysqli_fetch_assoc($query)) { ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border border-gray-200 p-3"><?= e($data['npm']); ?></td>
                            <td class="border border-gray-200 p-3"><?= e($data['nama']); ?></td>
                            <td class="border border-gray-200 p-3"><?= e($data['email']); ?></td>
                            <td class="border border-gray-200 p-3"><?= e($data['prodi']); ?></td>
                            <td class="border border-gray-200 p-3"><?= e($data['angkatan']); ?></td>
                            <td class="border border-gray-200 p-3"><?= e($data['ipk']); ?></td>
                            <td class="border border-gray-200 p-3 text-center">
                                <a href="edit.php?npm=<?= urlencode($data['npm']); ?>"
                                class="text-blue-600 hover:text-blue-800 hover:underline font-medium">
                                Edit
                                </a>
                                <span class="mx-1 text-gray-300">|</span>
                                <a href="delete.php?npm=<?= urlencode($data['npm']); ?>"
                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                class="text-red-600 hover:text-red-800 hover:underline font-medium">
                                Hapus
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center p-4 text-gray-500 font-medium">
                                Data mahasiswa tidak ditemukan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
mysqli_free_result($query);
mysqli_close($koneksi);
?>