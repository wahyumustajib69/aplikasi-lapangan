<?php
include "koneksi.php";

$id  = $_GET['id'];

if($sql = mysqli_query($konek,"DELETE FROM tbl_kerusakan WHERE id='$id'")){
	?>
	<script type="text/javascript">
		window.location.href = "data_kerusakan";
	</script>
	<?php
}
?>