<?php
include "koneksi.php";

//deklarasi variabel
$tipe	= $_POST['tipe'];
$kode	= $_POST['kode'];
$nama	= strtoupper($_POST['nama']);
$prov	= $_POST['prov'];
$kota	= $_POST['kota'];
$tgl	= $_POST['tgl'];
$sn_r	= $_POST['sn_rou'];
$sn_mo	= $_POST['sn_mod'];
$sn_mr	= $_POST['sn_mod_r'];
$no_cr	= $_POST['card'];
$hp_tk	= $_POST['hp_toko'];
$alm	= $_POST['almt'];

$sql = "UPDATE tbl_toko SET tipe_toko='$tipe',kota='$kota',provinsi='$prov',nama_toko='$nama',alamat='$alm',tgl_pasang='$tgl',sn_router='$sn_r',sn_modem='$sn_mo',modem_replace='$sn_mr',no_kartu='$no_cr',no_toko='$hp_tk' WHERE kode_toko='$kode'";
mysqli_query($konek,$sql) or die("Database Tidak Terhubung".mysqli_errno());
header('location:data_toko.php?page=edit');
?>