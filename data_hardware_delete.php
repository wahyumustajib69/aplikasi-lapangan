<?php
include "koneksi.php";

$id  = $_GET['id'];

if($sql = mysqli_query($konek,"DELETE FROM tbl_hardware WHERE id='$id'")){
	?>
	<script type="text/javascript">
		window.location.href= "data_hardware";
	</script>
	<?php
}
?>