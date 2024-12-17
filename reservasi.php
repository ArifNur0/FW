<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $jumlah_orang = $_POST['jumlah_orang'];

    // Cek jumlah reservasi yang sudah ada untuk tanggal dan jam yang sama
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM reservasi WHERE tanggal = ? AND jam = ?");
    $stmt->execute([$tanggal, $jam]);
    $count = $stmt->fetchColumn();

    if ($count >= 8) {
        echo "Maaf, sudah ada 8 reservasi untuk waktu ini. Silakan pilih waktu lain.";
    } else {
        // Jika jumlah reservasi kurang dari 8, simpan reservasi
        $stmt = $pdo->prepare("INSERT INTO reservasi (user_id, tanggal, jam, jumlah_orang) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $tanggal, $jam, $jumlah_orang]);

        $reservasi_id = $pdo->lastInsertId();
        $stmt = $pdo->prepare("INSERT INTO riwayat_reservasi (reservasi_id) VALUES (?)");
        $stmt->execute([$reservasi_id]);

        echo "Reservasi berhasil dibuat!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Reservasi</title>
    <link rel="stylesheet" href="style.css"> <!-- Link ke file CSS -->
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
    <h1>Buat Reservasi</h1>
    <form method="POST" action="">
        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" required><br>

        <label for="jam">Jam:</label>
        <input type="time" id="jam" name="jam" required><br>

        <label for="jumlah_orang">Jumlah Orang:</label>
        <input type="number" id="jumlah_orang" name="jumlah_orang" required><br>

        <input type="submit" value="Buat Reservasi">
    </form>

    <h2><a href="view_reservasi.php">Lihat Reservasi</a></h2>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Rumah Makan Kami. Semua hak dilindungi.</p>
    </footer>
</body>
</html>