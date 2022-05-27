<?php
include "koneksi.php";

//deklarasi variabel
$id 	= $_POST['id'];
$kode	= $_POST['kode'];
$nama	= strtoupper($_POST['nama']);
$jns	= $_POST['jenis'];
$stts	= $_POST['stts'];
$tgl_k  = $_POST['tgl_kr'];
$tgl_p	= $_POST['tgl_pb'];

$sql = "UPDATE tbl_kerusakan SET tgl_rusak='$tgl_k',tgl_prb='$tgl_p',kode_toko='$kode',nama_toko='$nama',jenis_kerusakan='$jns', status='$stts' WHERE id='$id'";
mysqli_query($konek,$sql) or die("Database Tidak Terhubung".mysqli_errno());
?>


