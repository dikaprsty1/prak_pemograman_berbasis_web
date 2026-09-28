<?php
// biodata.php

function statusKelulusan(float $ipk): string
{
    if ($ipk >= 3.50) return 'Sangat Memuaskan';
    if ($ipk >= 3.00) return 'Memuaskan';
    return 'Perlu Peningkatan';
}

$mahasiswa = [
    'nim' => '4524210013',
    'nama' => 'Andika Prasetyo',
    'prodi' => 'Teknik Informatika',
    'semester' => 5,
    'ipk' => 3.69
    
];
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Biodata</title>
</head>

<body>
    <h1>Biodata Mahasiswa</h1>

    <ul>
        <?php foreach ($mahasiswa as $kunci => $nilai): ?>
            <li>
                <?= ucfirst($kunci) ?>:
                <?= htmlspecialchars((string)$nilai) ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <p>
        Predikat:
        <?= statusKelulusan($mahasiswa['ipk']) ?>
    </p>

</body>

</html>