<?php 
session_start();
include_once "koneksi.php";

$nama = strtoupper($_POST['nama']);
$tipe = strtoupper($_POST['tipe']);
$tgl  = $_POST['tgl'];
$kon  = $_POST['kondisi'];
$jml  = $_POST['qty'];
$ket  = $_POST['ket'];


$sql = "INSERT INTO tbl_hardware (nama,tipe,tgl_terima,kondisi,qty,keterangan) VALUES ('$nama','$tipe','$tgl','$kon','$jml','$ket')";	
mysqli_query($konek,$sql) or die("Database Tidak Terhubung".mysqli_errno());
?>