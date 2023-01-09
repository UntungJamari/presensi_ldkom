<?php

include "../include/connect.php";
$password = "Admin123";
$password = password_hash($password, PASSWORD_DEFAULT);
$query = mysqli_query($koneksi, "update user set password='$password' where no_anggota='01'");
