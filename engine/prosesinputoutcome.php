<?php

include 'database.php';

// Function create
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $jeniskategori = filter_input(INPUT_POST, 'jeniskategori', FILTER_SANITIZE_STRING);
  $keterangan = filter_input(INPUT_POST, 'keterangan', FILTER_SANITIZE_STRING);
  $biaya = filter_input(INPUT_POST, 'biaya', FILTER_SANITIZE_NUMBER_INT);

  if (!empty($jeniskategori) && !empty($keterangan) && !empty($biaya)) {
    $query = "INSERT INTO income (kategori, keterangan, total, tanggal, jenis) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    $tanggal = date('Y-m-d');
    $jenis = "Pengeluaran";
    mysqli_stmt_bind_param($stmt, "ssiss", $jeniskategori, $keterangan, $biaya, $tanggal, $jenis);
    if (mysqli_stmt_execute($stmt)) {
      echo '<script>alert("Data berhasil disimpan");window.location.href="../input-outcome.php";</script>';
      exit;
    } else {
      echo '<script>alert("Gagal menyimpan data");window.location.href="../input-outcome.php";</script>';
      exit;
    }
  } else {
    echo '<script>alert("Data tidak valid");window.location.href="../input-outcome.php";</script>';
    exit;
  }
}

// Function delete
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $query = "DELETE FROM income WHERE id=?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "i", $id);
  if (mysqli_stmt_execute($stmt)) {
    echo '<script>alert("Data berhasil dihapus");window.location.href="../input-outcome.php";</script>';
    exit;
  } else {
    echo '<script>alert("Gagal menghapus data");window.location.href="../input-outcome.php";</script>';
    exit;
  }
}

?>
