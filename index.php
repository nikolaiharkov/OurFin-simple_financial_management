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
        <title>OurFin -  Dashboard</title>
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
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Pemasukan Bulanan:</div>
                                    <?php
include 'engine/database.php';

// Ambil data dari database untuk rentang waktu tertentu
date_default_timezone_set('Asia/Jakarta');
$bulan_sekarang = date('m');
$tahun_sekarang = date('Y');

$query = "SELECT SUM(total) as total_pemasukan FROM income WHERE jenis='Pemasukan' AND MONTH(tanggal) = $bulan_sekarang AND YEAR(tanggal) = $tahun_sekarang";
$result = mysqli_query($conn, $query);
$total_pemasukan = mysqli_fetch_assoc($result)['total_pemasukan'];
?>

<div class="card-footer d-flex align-items-center justify-content-between">
    <span class="small text-white stretched-link">
        Rp <?php echo number_format($total_pemasukan, 0, ",", "."); ?>
    </span>
</div>

                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Pengeluaran Bulanan:</div>
                                    <?php
                                    include 'engine/database.php';

                                    // Ambil data dari database
                                    $query = "SELECT SUM(total) AS total_pengeluaran FROM income WHERE jenis='Pengeluaran' AND MONTH(tanggal) = MONTH(NOW()) AND YEAR(tanggal) = YEAR(NOW())";
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_pengeluaran = number_format($row['total_pengeluaran'], 0, ",", ".");
                                    
                                    echo "<div class='card-footer d-flex align-items-center justify-content-between'>";
                                    //gunakan <span class="small text-white stretched-link">
                                    echo "<span class='small text-white stretched-link'>Rp. $total_pengeluaran</span>";
                                    
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Pemasukan Total:</div>
                                    <?php
include 'engine/database.php';

// Menghitung total Pengeluaran
$query_pengeluaran = "SELECT SUM(total) as total_pengeluaran FROM income WHERE jenis='Pengeluaran'";
$result_pengeluaran = mysqli_query($conn, $query_pengeluaran);
$row_pengeluaran = mysqli_fetch_assoc($result_pengeluaran);
$total_pengeluaran = $row_pengeluaran['total_pengeluaran'];

// Menghitung total Pemasukan
$query_pemasukan = "SELECT SUM(total) as total_pemasukan FROM income WHERE jenis='Pemasukan'";
$result_pemasukan = mysqli_query($conn, $query_pemasukan);
$row_pemasukan = mysqli_fetch_assoc($result_pemasukan);
$total_pemasukan = $row_pemasukan['total_pemasukan'];

// Menghitung selisih antara Pemasukan dan Pengeluaran
$total_selisih = $total_pemasukan - $total_pengeluaran;

?>

<div class="card-footer d-flex align-items-center justify-content-between">
<span class="small text-white stretched-link">
    Rp. <?php echo number_format($total_selisih, 0, ",", "."); ?>
    </span>
</div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Rincian Pengeluaran dan Pemasukan
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
        </tr>
    </thead>
    <tbody>
        <?php
        include 'engine/database.php';
        // Ambil data dari database
        $query = "SELECT * FROM income ORDER BY tanggal DESC";
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
                <?php
                //if Pemasukan put green color, if Pengeluaran put red color
                if ($jenis == "Pemasukan") {
                    echo "<td><span class='badge bg-success'>$jenis</span></td>";
                } else {
                    echo "<td><span class='badge bg-danger'>$jenis</span></td>";
                }
                ?>
                <td><?php echo $kategori; ?></td>
                <td><?php echo $keterangan; ?></td>
                <td>Rp. <?php echo $total; ?></td>
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
