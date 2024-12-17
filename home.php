<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Rumah Makan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Selamat Datang di Rumah Makan Kami!</h1>
        <p>Temukan pengalaman kuliner yang tak terlupakan dengan berbagai pilihan menu lezat.</p>
    </header>

    <!-- Navbar -->
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

    <main>
        <?php if (isset($_SESSION['user_id'])): ?>
            <h2>Halo, <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>!</h2>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Rumah Makan Kami. Semua hak dilindungi.</p>
    </footer>
</body>
</html>