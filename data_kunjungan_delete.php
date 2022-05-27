<?php
include "koneksi.php";

$kode  = $_GET['id'];


if($sql = mysqli_query($konek,"DELETE FROM tbl_kunjungan WHERE id='$kode'")){
	?>
	<script type="text/javascript">
	window.location.href = "data_kunjungan?tgl=<?php echo date('Y-m-d'); ?>";
	</script>
	<?php
}
?>