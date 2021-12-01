<?php
include "connect.php";
$id = $_GET['id'];
$result = mysqli_query($koneksi, "DELETE FROM tb_karyawan WHERE id=$id");
header("Location:daftar.php");
?>