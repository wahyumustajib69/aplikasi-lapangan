<?php
include "koneksi.php";

//deklarasi variabel
$id 	= $_POST['id_r'];
$kode	= $_POST['kode'];
$nama	= strtoupper($_POST['nama']);
$tgl	= $_POST['tgl'];
$stts	= $_POST['stts'];

$sql = "UPDATE tbl_kunjungan SET tgl_kunjungan='$tgl', kode_toko='$kode', nama_toko='$nama', status='$stts' WHERE id='$id'";
mysqli_query($konek,$sql) or die("Database Tidak Terhubung".mysqli_errno());
?>


