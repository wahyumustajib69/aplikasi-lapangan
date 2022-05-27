<?php
include "koneksi.php";

$kode  = $_GET['id'];
mysqli_query($konek,"UPDATE tbl_hardware SET qty=(qty+1)");
if($sql = mysqli_query($konek,"DELETE FROM tbl_toko WHERE kode_toko='$kode'")){
	?>
	<script type="text/javascript">
		window.location.href="data_toko";
	</script>
	<?php
}
?>