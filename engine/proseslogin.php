<?php
include 'database.php';

// Ambil data dari form login
$username = $_POST['username'];
$password = hash('sha256', $_POST['password']);

// Cek username dan password pada tabel member
$query = "SELECT * FROM member WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

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
