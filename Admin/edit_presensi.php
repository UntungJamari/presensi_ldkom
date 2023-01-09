<?php

session_start();

include "../include/connect.php";

if ($_SESSION['role'] != "Admin") {
    header("location:../autentikasi/login.php?pesan=logindulu");
}

if (isset($_POST['simpan'])) {
    $no_anggota = $_POST['no_anggota'];
    $tanggal = $_POST['tanggal'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_masuk = date("H:i", strtotime($jam_masuk));
    $jam_keluar = $_POST['jam_keluar'];
    $jam_keluar = date("H:i", strtotime($jam_keluar));
    $status_absen = $_POST['status_absen'];
    $keterangan = $_POST['keterangan'];

    $query = mysqli_query($koneksi, "update absen set jam_masuk = '$jam_masuk', jam_keluar = '$jam_keluar', status_absen = '$status_absen', keterangan = '$keterangan' where no_anggota = '$no_anggota' and tanggal = '$tanggal'");

    if ($query) {
        $berhasil = "Data Berhasil Diubah";
    } else {
        $gagal = "Data Gagal Diubah";
    }

    $_GET['no_anggota'] = $no_anggota;
    $_GET['tanggal'] = $tanggal;
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
        Edit Presensi Piket
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
                        <a class="navbar-brand" href="presensi_piket.php">&nbsp&nbsp&nbsp&nbspPresensi Piket</a>
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
                                <h4 class="card-title">Edit Presensi Piket</h4>
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
                                <form action="edit_presensi.php" method="POST">
                                    <?php

                                    $no_anggota = $_GET['no_anggota'];
                                    $tanggal = $_GET['tanggal'];
                                    $tanggal = date("Y-m-d", strtotime($tanggal));
                                    $query = mysqli_query($koneksi, "select * from absen where no_anggota = '$no_anggota' and tanggal='$tanggal'");
                                    $tampil = mysqli_fetch_assoc($query);

                                    ?>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Nomor Anggota</label>
                                                <input type="text" class="form-control" value="<?php echo $tampil['no_anggota']; ?>" disabled>
                                                <input type="hidden" name="no_anggota" value="<?php echo $tampil['no_anggota']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <input type="text" class="form-control" disabled value="<?php
                                                                                                        $tanggal = date("d-m-Y", strtotime($tampil['tanggal']));
                                                                                                        echo $tanggal;
                                                                                                        ?>">
                                                <input type="hidden" name='tanggal' value="<?php echo $tampil['tanggal']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Jam Masuk</label>
                                                <input type="time" class="form-control" value="<?php echo $tampil['jam_masuk']; ?>" name="jam_masuk">
                                            </div>
                                        </div>
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Jam Keluar</label>
                                                <input type="time" class="form-control" value="<?php echo $tampil['jam_keluar']; ?>" name="jam_keluar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Status Kehadiran</label><br>
                                                <select class="form-control" aria-label="Default select example" name="status_absen">
                                                    <option value="" selected>--------Status Kehadiran--------</option>
                                                    <?php

                                                    $status = ['Hadir', 'Izin', 'Sakit', 'Tidak Hadir'];

                                                    foreach ($status as $stat) {
                                                        if ($stat == $tampil['status_absen']) {
                                                    ?>
                                                            <option value="<?php echo $stat; ?>" selected><?php echo $stat; ?></option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value="<?php echo $stat; ?>"><?php echo $stat; ?></option>
                                                    <?php
                                                        }
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <textarea rows="4" class="form-control" name="keterangan"><?php echo $tampil['keterangan']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 mb-3">
                                        <div class="col-md-5">
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="submit" class="form-control" name="simpan" value="Simpan">
                                            </div>
                                        </div>
                                    </div>
                                </form>
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