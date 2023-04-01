<?php

include 'database.php';

// function create
if (isset($_POST['namakategoriincome'])) {
  $namakategoriincome = trim($_POST['namakategoriincome']);

  // cek apakah nama kategori sudah ada di database
  $stmt = mysqli_prepare($conn, "SELECT * FROM catincome WHERE nama = ?");
  mysqli_stmt_bind_param($stmt, "s", $namakategoriincome);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) > 0) {
    // jika sudah ada, kembali ke halaman kategori-income.php dengan pesan error
    echo '<script>alert("Nama kategori sudah ada");window.location.href="../kategori-income.php";</script>';
    exit();
  }

  // jika belum ada, simpan data ke database
  $stmt = mysqli_prepare($conn, "INSERT INTO catincome (nama) VALUES (?)");
  mysqli_stmt_bind_param($stmt, "s", $namakategoriincome);

  if (mysqli_stmt_execute($stmt)) {
    // jika berhasil, kembali ke halaman kategori-income.php dengan pesan sukses
    echo '<script>alert("Kategori berhasil dibuat");window.location.href="../kategori-income.php";</script>';
    exit();
  } else {
    // jika gagal, kembali ke halaman kategori-income.php dengan pesan error
    echo '<script>alert("Gagal menyimpan kategori");window.location.href="../kategori-income.php";</script>';
    exit();
  }
}

// function delete
if (isset($_GET['id'])) {
  $id = (int)$_GET['id'];

  // hapus data dari database
  $stmt = mysqli_prepare($conn, "DELETE FROM catincome WHERE id = ?");
  mysqli_stmt_bind_param($stmt, "i", $id);

  if (mysqli_stmt_execute($stmt)) {
    // jika berhasil, kembali ke halaman kategori-income.php dengan pesan sukses
    echo '<script>alert("Kategori berhasil dihapus");window.location.href="../kategori-income.php";</script>';
    exit();
  } else {
    // jika gagal, kembali ke halaman kategori-income.php dengan pesan error
    echo '<script>alert("Gagal menghapus kategori");window.location.href="../kategori-income.php";</script>';
    exit();
  }
}

?>
