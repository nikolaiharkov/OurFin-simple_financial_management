<?php

include 'database.php';

// Function create
if (isset($_POST['jeniskategori']) && isset($_POST['keterangan']) && isset($_POST['biaya'])) {
  $jeniskategori = $_POST['jeniskategori'];
  $keterangan = $_POST['keterangan'];
  $biaya = $_POST['biaya'];

  date_default_timezone_set('Asia/Jakarta');
  $tanggal = date('Y-m-d');

  $jenis = "Pengeluaran";

  if (empty($jeniskategori) || empty($keterangan) || empty($biaya)) {
    echo '<script>alert("Data tidak valid");window.location.href="../input-outcome.php";</script>';
  } else {
    $query = "INSERT INTO income (kategori, keterangan, total, tanggal, jenis) VALUES ('$jeniskategori', '$keterangan', '$biaya', '$tanggal', '$jenis')";
    if (mysqli_query($conn, $query)) {
      echo '<script>alert("Data berhasil disimpan");window.location.href="../input-outcome.php";</script>';
    } else {
      echo '<script>alert("Gagal menyimpan data");window.location.href="../input-outcome.php";</script>';
    }
  }
}

// Function delete
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM income WHERE id=$id";
  if (mysqli_query($conn, $query)) {
    echo '<script>alert("Data berhasil dihapus");window.location.href="../input-outcome.php";</script>';
  } else {
    echo '<script>alert("Gagal menghapus data");window.location.href="../input-outcome.php";</script>';
  }
}

?>
