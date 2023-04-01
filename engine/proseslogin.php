<?php
include 'database.php';

// Ambil data dari form login dan sanitasi nilai input pengguna
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$password = hash('sha256', $password); // Menggunakan fungsi hash yang lebih kuat

// Buat prepared statement untuk query ke database
$stmt = mysqli_prepare($conn, "SELECT * FROM member WHERE username=? AND password=?");
mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 1) {
    // Jika login berhasil, buat session dan redirect ke halaman utama
    session_start();
    $_SESSION['username'] = $username;
    header('location: ../index.php');
    exit();
} else {
    // Jika login gagal, kembali ke halaman login dengan pesan error
    echo "<script>alert('Maaf, akses anda ditolak. Pastikan username dan password benar.');</script>";
    header('location: ../login.php');
    exit();
}
?>
