<?php

session_start();

include "../include/connect.php";

if (isset($_POST['login'])) {

    if (empty($_POST["no_anggota"]) || empty($_POST["password"])) {
        $gagal = "Nomor Anggota dan Password tidak boleh kosong!!";
    } else {

        $no_anggota = mysqli_real_escape_string($koneksi, $_POST["no_anggota"]);
        $password = mysqli_real_escape_string($koneksi, $_POST["password"]);

        $query = mysqli_query($koneksi, "select * from user WHERE no_anggota = '$no_anggota'");
        if (mysqli_affected_rows($koneksi) == 0) {
            $gagal = "Log In Gagal";
        } else {
            $result = mysqli_fetch_assoc($query);

            if (password_verify($password, $result["password"])) {
                if ($result['role'] == "Admin") {
                    $_SESSION['no_anggota'] = $no_anggota;
                    $_SESSION['role'] = "Admin";
                    $_SESSION['nama'] = $result["nama"];
                    $_SESSION['foto'] = $result["foto"];
                    header("location:../Admin/home_admin.php");
                } else if ($result['role'] == "Asisten") {
                    $_SESSION['no_anggota'] = $no_anggota;
                    $_SESSION['role'] = "Asisten";
                    $_SESSION['nama'] = $result["nama"];
                    $_SESSION['foto'] = $result["foto"];
                    header("location:../Asisten/home_asisten.php");
                } else {
                    $gagal = "Anda Harus Log In Terlebih Dahulu";
                }
            } else {
                $gagal = "Log In Gagal";
            }
        }
    }
}

date_default_timezone_set('Asia/Jakarta');

$hari = date('l');
// $hari = 'Monday';
// $tgl = "2022-03-21";
$h = array('Monday' => '1', 'Tuesday' => '2', 'Wednesday' => '3', 'Thursday' => '4', 'Friday' => '5', 'Friday' => '5', 'Saturday' => '6', 'Sunday' => '7');

$hari_kemaren = $h[$hari];

if ($hari_kemaren == '1') {
    $hari_kemaren = '5';
    $tgl_kemarin = date('Y-m-d', strtotime("-3 day", strtotime(date("Y-m-d"))));
} else {
    $hari_kemaren = $hari_kemaren - 1;
    $tgl_kemarin = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));
}

$query = mysqli_query($koneksi, "select * from jadwal_user where kode_hari = '$hari_kemaren'");
while ($tampil = mysqli_fetch_array($query)) {
    $no_anggota = $tampil['no_anggota'];

    $query2 = mysqli_query($koneksi, "select * from absen where no_anggota = '$no_anggota' and tanggal = '$tgl_kemarin'");
    if (mysqli_affected_rows($koneksi) == 0) {
        $query3 = mysqli_query($koneksi, "insert into absen (tanggal, no_anggota, status_absen) values ('$tgl_kemarin', '$no_anggota', 'Tidak Hadir')");
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
        Log In
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

<body class="user-profile" style="background-image: url('../assets/img/bg.jpg');">
    <div class="container">
        <div class="content mt-5">
            <div class="row">
                <div class="col-md-3">
                    <a href="../tamu/buku_tamu.php"><button type="button" class="btn btn-outline-light">Buku Tamu</button></a>
                </div>
                <div class="col-md-6">
                    <div class="card card-user">
                        <div class="image">
                            <img src="../assets/img/bgunand.jpg" alt="..." style="width: 110%;">
                        </div>
                        <div class="card-body">
                            <div class="author">

                                <img class="avatar border-gray" src="../assets/img/logo_ldkom.png" alt="...">
                                <h5 class="title" style="color: maroon;">Presensi Piket Asisten LDKOM</h5>

                            </div>
                            <center class="mt-5">
                                <?php
                                if (isset($gagal)) {
                                ?>
                                    <p class="text-danger pull-middle"><?php echo $gagal; ?></p>
                                <?php
                                }
                                if (isset($_GET['pesan'])) {
                                ?>
                                    <p class="text-info pull-middle"><?php echo "Silakan Log In Terlebih Dahulu!"; ?></p>
                                <?php
                                }
                                ?>
                            </center>
                            <form action="login.php" method="POST">
                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label style="color: black;">Nomor Anggota</label>
                                            <input type="text" class="form-control" name="no_anggota">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label style="color: black;">Password</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-3">
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <input type="submit" class="form-control" name="login" value="Log In">
                                        </div>
                                    </div>
                                </div>
                            </form>
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