<?php

include_once 'database.php';

// Function create
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $jeniskategori = filter_input(INPUT_POST, 'jeniskategori', FILTER_SANITIZE_STRING);
  $keterangan = filter_input(INPUT_POST, 'keterangan', FILTER_SANITIZE_STRING);
  $biaya = filter_input(INPUT_POST, 'biaya', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

  if (!empty($jeniskategori) && !empty($keterangan) && !empty($biaya)) {
    $tanggal = date('Y-m-d');
    $jenis = "Pemasukan";
    
    $query = "INSERT INTO income (kategori, keterangan, total, tanggal, jenis) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdss", $jeniskategori, $keterangan, $biaya, $tanggal, $jenis);
    
    if ($stmt->execute()) {
      echo '<script>alert("Data berhasil disimpan");window.location.href="../input-income.php";</script>';
      exit;
    } else {
      echo '<script>alert("Gagal menyimpan data");window.location.href="../input-income.php";</script>';
      exit;
    }
  } else {
    echo '<script>alert("Data tidak valid");window.location.href="../input-income.php";</script>';
    exit;
  }
}

// Function delete
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

  $query = "DELETE FROM income WHERE id=?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    echo '<script>alert("Data berhasil dihapus");window.location.href="../input-income.php";</script>';
    exit;
  } else {
    echo '<script>alert("Gagal menghapus data");window.location.href="../input-income.php";</script>';
    exit;
  }
}
