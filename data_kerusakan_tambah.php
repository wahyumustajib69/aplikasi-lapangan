<?php 
session_start();
include_once "koneksi.php";

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$jns  = $_POST['jns_ker'];
$stt  = $_POST['status'];
$tgl_k  = $_POST['tgl_kr'];
$tgl_p	= $_POST['tgl_pb'];

$sql = "INSERT INTO tbl_kerusakan VALUES ('','$tgl_k','$tgl_p','$kode','$nama','$jns','$stt')";	
mysqli_query($konek,$sql) or die("Database Tidak Terhubung".mysqli_errno());
?>