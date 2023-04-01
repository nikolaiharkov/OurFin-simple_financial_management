<?php
include 'database.php';

function showMessage($message, $location) {
  echo "<script>alert('$message');window.location.href='$location';</script>";
}

function createCategory($conn, $categoryName) {
  $query = "SELECT * FROM catoutcome WHERE nama = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "s", $categoryName);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  
  if (mysqli_num_rows($result) > 0) {
    showMessage("Nama kategori sudah ada", "../kategori-outcome.php");
  } else {
    $query = "INSERT INTO catoutcome (nama) VALUES (?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $categoryName);
    if (mysqli_stmt_execute($stmt)) {
      showMessage("Kategori berhasil dibuat", "../kategori-outcome.php");
    } else {
      showMessage("Gagal menyimpan kategori", "../kategori-outcome.php");
    }
  }
}

function deleteCategory($conn, $id) {
  $query = "DELETE FROM catoutcome WHERE id = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "i", $id);
  if (mysqli_stmt_execute($stmt)) {
    showMessage("Kategori berhasil dihapus", "../kategori-outcome.php");
  } else {
    showMessage("Gagal menghapus kategori", "../kategori-outcome.php");
  }
}

if (isset($_POST['namakategorioutcome'])) {
  $categoryName = $_POST['namakategorioutcome'];

  // Validasi input
  if (empty($categoryName)) {
    showMessage("Nama kategori tidak boleh kosong", "../kategori-outcome.php");
  } else {
    createCategory($conn, $categoryName);
  }
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Validasi input
  if (!is_numeric($id)) {
    showMessage("ID kategori harus angka", "../kategori-outcome.php");
  } else {
    deleteCategory($conn, $id);
  }
}
?>
