<?php
include_once "koneksi.php";

$tgl	= date('Y-m-d');
$msk	= $_POST['masuk'];
$plg	= '0:0:0';
$ket	= $_POST['ket'];

$sql  = mysqli_query($konek,"INSERT INTO tbl_absensi (jam_masuk,jam_pulang,tanggal,keterangan) VALUES('$msk','$plg','$tgl','$ket')");
?>