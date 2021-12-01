<?php
require_once __DIR__ . '/pdf/vendor/autoload.php';

include "connect.php";
$result = mysqli_query($koneksi, "SELECT * FROM tb_absen INNER JOIN tb_karyawan ON tb_absen.nik = tb_karyawan.nik");

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Absensi</title>
</head>
<body>
    <h1>Daftar Absensi</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Keterangan</th>
            </tr>
        </thead>';

        $i = 1;
        while ($jam = mysqli_fetch_array($result)) {
            $html .= '<tr>
                <td>'. $i++ .'</td>
                <td>'. $jam["tanggal"] .'</td>
                <td>'. $jam["nama"] .'</td>
                <td>'. $jam["start"] .'</td>
                <td>'. $jam["finish"] .'</td>
                <td>'. $jam["keterangan"] .'</td>
            <tr>';
        }

$html .= '</table>
</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output('daftar-absensi.pdf', \Mpdf\Output\Destination::INLINE);
?>
