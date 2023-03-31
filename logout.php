<?php
session_start(); // memulai session
session_unset(); // menghapus semua data session
session_destroy(); // menghapus session
header("Location: login.php"); // redirect ke halaman login
exit(); // keluar dari script
?>
