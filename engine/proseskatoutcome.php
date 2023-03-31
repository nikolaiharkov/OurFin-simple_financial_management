<?php

include 'database.php';

// function create
if (isset($_POST['namakategorioutcome'])) {
  $namakategorioutcome = $_POST['namakategorioutcome'];

  // cek apakah nama kategori sudah ada di database
  $query = "SELECT * FROM catoutcome WHERE nama='$namakategorioutcome'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    // jika sudah ada, kembali ke halaman kategori-outcome.php dengan pesan error
    echo '<script>alert("Nama kategori sudah ada");window.location.href="../kategori-outcome.php";</script>';
  } else {
    // jika belum ada, simpan data ke database
    $query = "INSERT INTO catoutcome (nama) VALUES ('$namakategorioutcome')";
    if (mysqli_query($conn, $query)) {
      // jika berhasil, kembali ke halaman kategori-outcome.php dengan pesan sukses
      echo '<script>alert("Kategori berhasil dibuat");window.location.href="../kategori-outcome.php";</script>';
    } else {
      // jika gagal, kembali ke halaman kategori-outcome.php dengan pesan error
      echo '<script>alert("Gagal menyimpan kategori");window.location.href="../kategori-outcome.php";</script>';
    }
  }
}

// function delete
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // hapus data dari database
  $query = "DELETE FROM catoutcome WHERE id=$id";
  if (mysqli_query($conn, $query)) {
    // jika berhasil, kembali ke halaman kategori-outcome.php dengan pesan sukses
    echo '<script>alert("Kategori berhasil dihapus");window.location.href="../kategori-outcome.php";</script>';
  } else {
    // jika gagal, kembali ke halaman kategori-outcome.php dengan pesan error
    echo '<script>alert("Gagal menghapus kategori");window.location.href="../kategori-outcome.php";</script>';
  }
}

?>
