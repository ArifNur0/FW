<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM reservasi WHERE user_id = ?");
$stmt->execute([$user_id]);
$reservasi = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Daftar Reservasi</title>
</head>
<body>
<nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="reservasi.php">Buat Reservasi</a></li>
                <li><a href="view_reservasi.php">Lihat Reservasi</a></li>
                <?php if ($_SESSION['role'] === 'karyawan'): ?>
                    <li><a href="manage.php">Kelola Reservasi</a></li>
                <?php endif; ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Daftar</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <h1>Daftar Reservasi</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Jumlah Orang</th>
        </tr>
        <?php foreach ($reservasi as $row): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['tanggal']; ?></td>
            <td><?php echo $row['jam']; ?></td>
            <td><?php echo $row['jumlah_orang']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h2><a href="reservasi.php">Buat Reservasi Baru</a></h2>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Rumah Makan Kami. Semua hak dilindungi.</p>
    </footer>
</body>
</html>