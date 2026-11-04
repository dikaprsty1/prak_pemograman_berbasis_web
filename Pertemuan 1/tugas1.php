<?php
$hasil = null;
$pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = (float) ($_POST['a'] ?? 0);
    $b = (float) ($_POST['b'] ?? 0);
    $operator = $_POST['operator'] ?? '+';

    switch($operator) {
        case '+':
            $hasil = $a + $b;
            break;
        case '-':
            $hasil = $a - $b;
            break;
        case '*':
            $hasil = $a * $b;
            break;
        case '/':
            if ($b == 0) {
            $pesan = 'Pembagian dengan nol tidak diperbolehkan.';
            } else {
            $hasil = $a / $b;
            }
            break;
        // Modifikasi 1: Penambahan operator Pangkat (^) dan Modulo (%)
        case '^':
            $hasil = pow($a, $b);
            break;
        case '%':
            if ($b == 0) {
                $pesan = 'Modulo dengan nol tidak diperbolehkan.';
            } else {
                $hasil = fmod($a, $b);
            }
            break;
        default:
            $pesan = 'Operator tidak valid.';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Sederhana</title>
</head>
<body>
    <h1>Kalkulator Sederhana</h1>
    <form method="post">
        <input type="number" step="any" name="a" value="<?= htmlspecialchars($_POST['a'] ?? '') ?>" required>
        
        <!-- Modifikasi 1: Opsi dropdown baru -->
        <select name="operator">
            <option value="+" <?= ($_POST['operator'] ?? '') === '+' ? 'selected' : '' ?>>+</option>
            <option value="-" <?= ($_POST['operator'] ?? '') === '-' ? 'selected' : '' ?>>-</option>
            <option value="*" <?= ($_POST['operator'] ?? '') === '*' ? 'selected' : '' ?>>*</option>
            <option value="/" <?= ($_POST['operator'] ?? '') === '/' ? 'selected' : '' ?>>/</option>
            <option value="^" <?= ($_POST['operator'] ?? '') === '^' ? 'selected' : '' ?>>^ (Pangkat)</option>
            <option value="%" <?= ($_POST['operator'] ?? '') === '%' ? 'selected' : '' ?>>% (Modulo)</option>
        </select>
        
        <input type="number" step="any" name="b" value="<?= htmlspecialchars($_POST['b'] ?? '') ?>" required>
        
        <button type="submit">Hitung</button>
        <!-- Modifikasi 2: Tombol Reset Form -->
        <a href="<?= $_SERVER['PHP_SELF'] ?>"><button type="button">Reset</button></a>
    </form>

    <?php if ($pesan): ?>
        <p><?= htmlspecialchars($pesan) ?></p>
    <?php elseif ($hasil !== null): ?>
        <p>Hasil: <?= htmlspecialchars((string)$hasil) ?></p>
    <?php endif; ?>
</body>
</html>