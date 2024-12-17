<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->execute([$username, $password, $role]);

    echo "Pendaftaran berhasil! Silakan login.";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Daftar</title>
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
    <h1>Daftar Pengguna Baru</h1>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="pembeli">Pembeli</option>
            <option value="karyawan">Karyawan</option>
        </select><br>

        <input type="submit" value="Daftar">
    </form>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Rumah Makan Kami. Semua hak dilindungi.</p>
    </footer>
</body>
</html>