<?php

session_start();

include "../include/connect.php";

date_default_timezone_set('Asia/Jakarta');

$hari = date('l');
// $hari = 'Monday';
$waktu = date("H:i:s");
// $waktu = strtotime("16:00:00");
$tanggal = date("Y-m-d");
// $tanggal = date("Y-m-d", strtotime("2021-08-16"));

if ($_SESSION['role'] != "Admin") {
    header("location:../autentikasi/login.php?pesan=logindulu");
}

if (isset($_GET['set_tidak_hadir'])) {
    $no_anggota = $_GET['no_anggota'];

    $query = mysqli_query($koneksi, "insert into absen (no_anggota, tanggal, status_absen) value ('$no_anggota','$tanggal','Tidak Hadir')");
    if ($query) {
        $berhasil = "Data Berhasil Ditambahkan";
    } else {
        $gagal = "Data Gagal Ditambahkan";
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
        Piket Asisten
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
    <script type="text/javascript">
        function displayTime() {
            var clientTime = new Date();
            var time = new Date(clientTime.getTime());
            var sh = time.getHours().toString();
            var sm = time.getMinutes().toString();
            var ss = time.getSeconds().toString();
            document.getElementById("jam").innerHTML = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" + sm : sm) + ":" + (ss.length == 1 ? "0" + ss : ss);
            document.getElementById("jaminput").value = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" + sm : sm) + ":" + (ss.length == 1 ? "0" + ss : ss);
        }
    </script>
</head>

<body class="" onload="setInterval('displayTime()', 1000);">
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
                        <a class="navbar-brand" href="#pablo">Piket</a>
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="jadwal_piket.php"><button type="button" class="btn btn-outline-primary">Jadwal Piket</button></a>
                                        <a href="presensi_piket.php"><button type="button" class="btn btn-outline-primary">Presensi Piket</button></a>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="text-center">
                                            <?php
                                            $h = array('Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu');

                                            $hari_ini = $h[$hari];

                                            $tgl = date("d-m-Y");
                                            echo $hari_ini . ", " . $tgl;

                                            ?>
                                        </h4>
                                        <h5 id="jam" class="text-center"></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="card-title"> Piket Hari Ini</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                            <th>
                                                Nomor Anggota
                                            </th>
                                            <th>
                                                Nama
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
                                        </thead>
                                        <tbody>
                                            <?php

                                            $harii = array('Monday' => '1', 'Tuesday' => '2', 'Wednesday' => '3', 'Thursday' => '4', 'Friday' => '5', 'Saturday' => '6', 'Sunday' => '7');

                                            $kode_hari = $harii[$hari];

                                            $query = mysqli_query($koneksi, "select * from jadwal_user where kode_hari = '$kode_hari' order by no_anggota");
                                            while ($tampil = mysqli_fetch_array($query)) {

                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $tampil['no_anggota']; ?>
                                                    </td>
                                                    <?php

                                                    $no_anggota = $tampil['no_anggota'];

                                                    ?>
                                                    <td>
                                                        <?php

                                                        $query2 = mysqli_query($koneksi, "select * from user where no_anggota = '$no_anggota'");
                                                        $tampil2 = mysqli_fetch_array($query2);
                                                        echo $tampil2['nama'];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php

                                                            $query3 = mysqli_query($koneksi, "select * from absen where no_anggota = '$no_anggota' and tanggal = '$tanggal'");
                                                            $tampil3 = mysqli_fetch_array($query3);

                                                            if ($tampil3 == null) {
                                                                $tampil3['jam_masuk'] = '-';
                                                                $tampil3['jam_keluar'] = '-';
                                                                $tampil3['status_absen'] = '-';
                                                                $tampil3['keterangan'] = '-';
                                                            }

                                                            echo $tampil3['jam_masuk'];

                                                            ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php
                                                            echo $tampil3['jam_keluar'];
                                                            ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php

                                                            if (mysqli_affected_rows($koneksi) == 0) {
                                                            ?>
                                                                <a href="home_admin.php?set_tidak_hadir&no_anggota=<?php echo $no_anggota; ?>"><button type="button" class="btn btn-outline-danger btn-sm">Set Tidak Hadir</button></a>
                                                            <?php
                                                            } else {
                                                                echo $tampil3['status_absen'];
                                                            }

                                                            ?>
                                                        </center>
                                                    </td>
                                                    <td>

                                                        <?php
                                                        echo $tampil3['keterangan'];
                                                        ?>

                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?> </tr>
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
</body>

</html>