<?php

session_start();

include "../include/connect.php";

if ($_SESSION['role'] != "Admin") {
    header("location:../autentikasi/login.php?pesan=logindulu");
}

if (isset($_GET['no_anggota']) && isset($_GET['tanggal'])) {

    $no_anggota = $_GET['no_anggota'];
    $tanggal = $_GET['tanggal'];
    $tanggal = date("Y-m-d", strtotime($tanggal));

    $query = mysqli_query($koneksi, "delete from absen where no_anggota='$no_anggota' and tanggal='$tanggal'");
    if ($query) {
        $berhasil = "Data Berhasil Dihapus";
    } else {
        $gagal = "Data Gagal Dihapus";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/icon_ldkom.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Presensi Piket
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="red">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
            <div class="logo">
                <a href="#" class="simple-text logo-mini">
                    <img src="../assets/img/logo_ldkom.png" alt="" style="border-radius: 30px;">
                </a>
                <a href="#" class="simple-text logo-normal">
                    LDKOM
                </a>
            </div>
            <div class="sidebar-wrapper" id="sidebar-wrapper">
                <ul class="nav">
                    <li class="active ">
                        <a href="home_admin.php">
                            <i class="now-ui-icons business_briefcase-24"></i>
                            <p>Piket</p>
                        </a>
                    </li>
                    <li>
                        <a href="asisten.php">
                            <i class="now-ui-icons users_single-02"></i>
                            <p>Asisten</p>
                        </a>
                    </li>
                    <li>
                        <a href="tamu.php">
                            <i class="now-ui-icons education_hat"></i>
                            <p>Tamu</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel" id="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="home_admin.php">Piket</a>
                        <p>></p>
                        <p style="font-size: 12px;">&nbsp&nbsp&nbsp&nbspPRESENSI PIKET</p>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">

                                </a>
                            </li>
                            <li class="nav-item dropdown pull-left">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img style="border-radius: 30px; width: 20px;" src="../assets/img/<?php echo $_SESSION['foto']; ?>" alt="">
                                    <?php echo $_SESSION['nama']; ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="ganti_foto.php">Ganti Foto</a>
                                    <a class="dropdown-item" href="ganti_password.php">Ganti Password</a>
                                    <a class="dropdown-item" href="../autentikasi/logout.php" onclick="return confirm('Apakah Anda Ingin Log Out?')">Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="panel-header panel-header-sm" style="background-image: url('../assets/img/bg.jpg');">
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Presensi Piket</h4>
                                <a href="tambah_presensi.php"><button type="button" class="btn btn-outline-primary">Tambah Presensi</button></a>
                            </div>
                            <div class="card-body">
                                <center>
                                    <?php
                                    if (isset($gagal)) {
                                    ?>
                                        <p class="text-danger pull-middle"><?php echo $gagal; ?></p>
                                    <?php
                                    }
                                    if (isset($berhasil)) {
                                    ?>
                                        <p class="text-success pull-middle"><?php echo $berhasil; ?></p>
                                    <?php
                                    }
                                    ?>
                                </center>
                                <div class="table-responsive">
                                    <table class="table" id="example">
                                        <thead class=" text-primary" style="font-size: 12px;">
                                            <th>
                                                Nama
                                            </th>
                                            <th>
                                                Hari
                                            </th>
                                            <th class="text-center">
                                                Tanggal
                                            </th>
                                            <th class="text-center">
                                                Jam Masuk
                                            </th>
                                            <th class="text-center">
                                                Jam Keluar
                                            </th>
                                            <th>
                                                <center>
                                                    Status
                                                </center>
                                            </th>
                                            <th>
                                                Keterangan
                                            </th>
                                            <th>
                                                <center>
                                                    Aksi
                                                </center>
                                            </th>
                                        </thead>
                                        <tbody style="font-size: 12px;">
                                            <?php

                                            $query = mysqli_query($koneksi, "select * from absen");
                                            while ($tampil = mysqli_fetch_array($query)) {


                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        $no_anggota = $tampil['no_anggota'];
                                                        $query2 = mysqli_query($koneksi, "select * from user where no_anggota = '$no_anggota'");
                                                        $tampil2 = mysqli_fetch_array($query2);
                                                        echo $tampil2['nama'];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $hari = date('l', strtotime($tampil['tanggal']));

                                                        $h = array('Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu');

                                                        $har = $h[$hari];

                                                        echo $har;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <center>

                                                            <?php

                                                            $tanggal = date("d-m-Y", strtotime($tampil['tanggal']));
                                                            echo $tanggal;
                                                            ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php echo $tampil['jam_masuk']; ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php echo $tampil['jam_keluar']; ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php echo $tampil['status_absen']; ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php echo $tampil['keterangan']; ?>
                                                        </center>
                                                    </td>

                                                    <td class="text-center">
                                                        <div class="row">
                                                            <a href="edit_presensi.php?no_anggota=<?php echo $tampil['no_anggota']; ?>&tanggal=<?php echo $tanggal; ?>"><button type="button" class="btn btn-outline-warning btn-sm" style="font-size: 10px;">Edit</button></a>
                                                            <a href="presensi_piket.php?no_anggota=<?php echo $tampil['no_anggota']; ?>&tanggal=<?php echo $tanggal; ?>" onclick="return confirm('Apakah Anda yakin menghapus data ini? semua data yang berkaitan akan hilang!!')"><button type="button" class="btn btn-outline-danger btn-sm" style="font-size: 10px;">Hapus</button></a>
                                                        </div>
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
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <script src="../assets/demo/demo.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>