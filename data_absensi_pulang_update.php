<?php
include_once "koneksi.php";

$id 	= $_POST['id'];
$tgl	= $_POST['tgl'];
$msk	= $_POST['masuk'];
$plg	= $_POST['pulang'];
$ket	= $_POST['ket'];

$sql  = mysqli_query($konek,"UPDATE tbl_absensi SET jam_masuk='$msk',jam_pulang='$plg',tanggal='$tgl' WHERE id='$id'");
?>