<?php 
include "connect.php";

$id = $_POST['id'];
$nik = $_POST['nik'];
$keterangan = $_POST['keterangan'];

$result = mysqli_query($koneksi, "UPDATE tb_izin SET status='1' WHERE id='$id'");
if($result){
    $tanggal = date("Y-m-d");
    $jam_absen = date("H:i:s");
    $result2 = mysqli_query($koneksi, "INSERT INTO tb_absen(nik, tanggal, start, finish, keterangan) VALUES('$nik','$tanggal', '-','-', '$keterangan')");
    if($result2){
        header("Location: izin.php");
    }
}