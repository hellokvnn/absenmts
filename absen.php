<?php
include "connect.php";
session_start();
if($_SESSION["role"] != 'Admin') { 
    header("Location: login.php");
}
$result = mysqli_query($koneksi, "SELECT * FROM tb_absen INNER JOIN tb_karyawan ON tb_absen.nik = tb_karyawan.nik");
$i = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. Megah Tata Seruni</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <div class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon">
                    <i class="far fa-smile"></i>
                </div>
                <div class="sidebar-brand-text mx-2">Admin</div>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="daftar.php">
                    <i class="fas fa-user"></i>
                    <span>Karyawan</span></a>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="absen.php">
                    <i class="fas fa-user-clock"></i>
                    <span>Absen</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="izin.php">
                    <i class="fas fa-user-clock"></i>
                    <span>Izin</span></a>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Absen Karyawan</h1>
                    <h1 class="h5 text-gray-800 text-right"><?php echo $tgl=date('M Y') ?></h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="export.php" target="_blank">
                                <button type="submit" class="btn btn-secondary">Export PDF</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-striped">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nama</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    while ($jam = mysqli_fetch_array($result)) {
                                        echo "<tr class='text-center'>";
                                        echo "<td>" . $i++ . "</td>";
                                        echo "<td>" . $jam['tanggal'] . "</td>";
                                        echo "<td>" . $jam['nama'] . "</td>";
                                        echo "<td>" . $jam['start'] . "</td>";
                                        echo "<td>" . $jam['finish'] . "</td>";
                                        echo "<td>" . $jam['keterangan'] . "</td>";
                                        echo "<td>
                                        <a href='absen-edit.php?id=$jam[id]'>Edit</a>
                                        </td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    <?php
                                        $result3 = mysqli_query($koneksi, "SELECT COUNT(keterangan) FROM tb_absen WHERE keterangan='✓'");
                                        $hasil = mysqli_fetch_array($result3);

                                        echo "<center><ul>Karyawan yang Masuk : <strong>$hasil[0]</strong></ul></center>";
                                    ?>
                                    <?php
                                        $result4 = mysqli_query($koneksi, "SELECT COUNT(keterangan) FROM tb_absen WHERE keterangan='Izin'");
                                        $hasil1 = mysqli_fetch_array($result4);

                                        echo "<center><ul>Karyawan yang Izin : <strong>$hasil1[0]</strong></ul></center>";
                                    ?>
                                    <?php
                                        $result5 = mysqli_query($koneksi, "SELECT COUNT(keterangan) FROM tb_absen WHERE keterangan='Sakit'");
                                        $hasil2 = mysqli_fetch_array($result5);

                                        echo "<center><ul>Karyawan yang Sakit : <strong>$hasil2[0]</strong></ul></center>";
                                    ?>
                                    <?php
                                        $result6 = mysqli_query($koneksi, "SELECT COUNT(keterangan) FROM tb_absen WHERE keterangan='Telat'");
                                        $hasil3 = mysqli_fetch_array($result6);

                                        echo "<center><ul>Karyawan yang Telat : <strong>$hasil3[0]</strong></ul></center>";
                                    ?>
                                </table>
                            </div>   
                        </div>    
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Kevin 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>\

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>