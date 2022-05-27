<?php
session_start();
include "koneksi.php";

//deklarasi variabel
$tipe = $_POST['tipe'];
$kode = strtoupper($_POST['kode']);
$nmtk = strtoupper($_POST['nama']);
$prov = $_POST['provinsi'];
$kota = $_POST['kota'];
$tgl  = $_POST['tgl_pasang'];
$rout = $_POST['sn_rou'];
$mode = $_POST['sn_mo'];
$card = $_POST['no_card'];
$telp = $_POST['telp'];
$rep  = $_POST['sn_mo_r'];
$almt = $_POST['almt'];

mysqli_query($konek,"UPDATE tbl_hardware SET qty=(qty-1)");
$sql = "INSERT INTO tbl_toko VALUES ('$tipe','$kota','$prov','$kode','$nmtk','$almt','$tgl','$rout','$mode','$rep','$card','$telp')";	
mysqli_query($konek,$sql) or die("Database Tidak Terhubung".mysqli_errno());
?>
