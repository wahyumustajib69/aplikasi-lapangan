<?php
include "koneksi.php";

//deklarasi variabel
$id  = $_POST['id'];
$nam = $_POST['nama'];
$tipe = $_POST['tipe'];
$tgl = $_POST['tgl'];
$kon = $_POST['kondisi'];
$qty = $_POST['qty'];
$ket = $_POST['ket'];

$sql = "UPDATE tbl_hardware SET nama='$nam', tipe='$tipe', tgl_terima='$tgl',kondisi='$kon',qty='$qty',keterangan='$ket' WHERE id='$id'";
mysqli_query($konek,$sql) or die("Database Tidak Terhubung".mysqli_errno());
?>