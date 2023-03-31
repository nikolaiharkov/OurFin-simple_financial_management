<?php
session_start();

// cek apakah user sudah login atau belum
if(!isset($_SESSION['username'])) {
    header("Location: login.php"); // redirect ke halaman login
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>OurFin -  Input Data Income</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="#">OurFin ❤</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Pengaturan Income
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="kategori-income.php">Input Kategori</a>
                                    <a class="nav-link" href="input-income.php">Input Data Income</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Pengaturan Outcome
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="kategori-outcome.php">Input Kategori</a>
                                    <a class="nav-link" href="input-outcome.php">Input Data Outcome</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="member.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Member Area
                            </a>
                    </div>
                    
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Input Data Income</h1>
                        <ol class="breadcrumb mb-4">
                        </ol>
                        <div class="row">
                        <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-pie me-1"></i>
                                        Input Data Income
                                    </div>
                                    <div class="card-body">
  <form action="engine/prosesinputincome.php?function=create" method="POST">
  <div class="form-group">
  <label for="order">Jenis Kategori</label>
  <br>
  <select class="form-control" id="order" name="jeniskategori">
    <?php
    include 'engine/database.php';

    $query = "SELECT * FROM catincome";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
      echo '<option value="' . $row['nama'] . '">' . $row['nama'] . '</option>';
    }
    ?>
  </select>
</div>

    <br>
    <div class="form-group">
      <label for="keterangan">Keterangan:</label>
      <input type="text" class="form-control" id="keterangan" name="keterangan">
    </div>
    <br>
    <div class="form-group">
      <label for="biaya">Total Biaya:</label>
      <input type="number" class="form-control" id="biaya" name="biaya">
    </div>
    <br>
    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Submit</button>
  </form>
</div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                List Data Income
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                            <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Jenis</th>
                                            <th>Kategori</th>
                                            <th>Keterangan</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
include 'engine/database.php';

// Ambil data dari database
$query = "SELECT * FROM income WHERE jenis = 'Pemasukan'";
$result = mysqli_query($conn, $query);

// Inisialisasi nomor urut
$no = 1;

// Tampilkan data pada tabel
while ($row = mysqli_fetch_assoc($result)) {
    $tanggal = date("d/m/Y", strtotime($row['tanggal']));
    $jenis = $row['jenis'];
    $kategori = $row['kategori'];
    $keterangan = $row['keterangan'];
    $total = number_format($row['total'], 0, ",", ".");
?>

<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $tanggal; ?></td>
    <td><?php echo $jenis; ?></td>
    <td><?php echo $kategori; ?></td>
    <td><?php echo $keterangan; ?></td>
    <td>Rp. <?php echo $total; ?></td>
    <td>
    <a href="engine/prosesinputincome.php?id=<?php echo $row['id']; ?>&aksi=delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
    </td>
</tr>

<?php
}
?>

                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Create with ❤ by HarkovNet</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
