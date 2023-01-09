<?php

session_start();

include "../include/connect.php";

if (isset($_POST['simpan'])) {

    if (empty($_POST["nim"]) || empty($_POST["nama"]) || empty($_POST["tujuan"])) {
        $gagal = "Tidak ada isian yang boleh kosong!!";
    } else {

        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $tujuan = $_POST['tujuan'];

        date_default_timezone_set('Asia/Jakarta');
        $waktu_kedatangan = date("Y-m-d H:i:s");

        $query = mysqli_query($koneksi, "insert into tamu (nim, nama, waktu_kedatangan, tujuan) VALUES('$nim', '$nama', '$waktu_kedatangan','$tujuan')");
        if ($query) {
            $berhasil = "Data Kedatangan Anda Telah Disimpan!!";
        } else {
            $gagal = "Data Kedatangan Anda Gagal Disimpan!!";
        }
    }
}

date_default_timezone_set('Asia/Jakarta');

$hari = date('l');
// $hari = 'Monday';
// $tgl = "2022-03-21";
$h = array('Monday' => '1', 'Tuesday' => '2', 'Wednesday' => '3', 'Thursday' => '4', 'Friday' => '5', 'Saturday' => '6', 'Sunday' => '7');

$hari_kemaren = $h[$hari];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/icon_ldkom.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Buku Tamu
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

    <link rel="stylesheet" href="kalender.css" />
</head>

<body class="user-profile" style="background-image: url('../assets/img/bg.jpg');" onload="setInterval('displayTime()', 1000);">
    <div class="container">
        <div class="content mt-5">
            <div class="row">
                <div class="col-md-2">
                    <a href="../autentikasi/login.php"><button type="button" class="btn btn-outline-light">Log In Asisten</button></a>
                </div>
                <div class="col-md-6">
                    <div class="card card-user">
                        <div class="image">
                            <img src="../assets/img/bgunand.jpg" alt="..." style="width: 110%;">
                        </div>
                        <div class="card-body">
                            <div class="author">

                                <img class="avatar border-gray" src="../assets/img/logo_ldkom.png" alt="...">
                                <h5 class="title" style="color: maroon;">Buku Tamu LDKOM</h5>

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
                                if (isset($berhasil)) {
                                ?>
                                    <p class="text-success pull-middle"><?php echo $berhasil; ?></p>
                                <?php
                                }
                                ?>
                            </center>
                            <form action="buku_tamu.php" method="POST">
                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label style="color: black;">NIM/Nomor Indentitas Lain (NIP, NIK)</label>
                                            <input type="text" class="form-control" name="nim">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label style="color: black;">Nama</label>
                                            <input type="text" class="form-control" name="nama">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label style="color: black;">Keperluan</label>
                                            <input type="text" class="form-control" list="cars" name="tujuan" />
                                            <datalist id="cars">
                                                <option value="Belajar">Belajar</option>
                                                <option value="Kelas Praktikum">Kelas Praktikum</option>
                                                <option value="Membaca Buku">Membaca Buku</option>
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-3">
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <input type="submit" class="form-control" name="simpan" value="Simpan" onclick="nowuiDashboard.showNotification('top','center')">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pe-5">
                    <div class="card">
                        <div class="card-header">
                            <div id="idx-calendar">
                                <div id="calendar-control">
                                    <div id="monthNow">Januari 2014</div>
                                    <div id="nextMonth"></div>
                                    <div id="prevMonth"></div>
                                </div>
                                <div id="dayNames">
                                    <ul style="font-size: 10px;">
                                        <li>Minggu</li>
                                        <li>Senin</li>
                                        <li>Selasa</li>
                                        <li>Rabu</li>
                                        <li>Kamis</li>
                                        <li>Jum'at</li>
                                        <li>Sabtu</li>
                                    </ul>
                                </div>
                                <div id="daysNum">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 id="jam" class="text-center mt-3"></h5>
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

        <script type="text/javascript" src="kalender.js"></script>
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
</body>

</html>