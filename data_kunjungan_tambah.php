<?php 
session_start();
include_once "koneksi.php";

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$tgl  = $_POST['tgl'];
$stt  = $_POST['status'];
$img  = $_FILES['foto']['name'];

$fot = $kode.$img;

$sql = "INSERT INTO tbl_kunjungan (tgl_kunjungan,kode_toko,nama_toko,status,foto) 
		VALUES ('$tgl','$kode','$nama','$stt','$fot')";	

mysqli_query($konek,$sql) or die("Database Tidak Terhubung".mysqli_errno());
$pindah = move_uploaded_file($_FILES['foto']['tmp_name'], 'img/'.$fot);

if($pindah){
	$date = date('Y-m-d');
	if($sql){
		header("location:data_kunjungan?tgl=$date");
	}
}else{
	echo 'Gagal Upload Gambar';
	echo $fot;
}
?>