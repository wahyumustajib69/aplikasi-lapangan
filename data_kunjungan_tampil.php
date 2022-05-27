<?php
require_once('koneksi.php');
$action = $_REQUEST['action'];
if($action == "semua"){
	// jika selected produk get all product
	$stmt=$db->prepare('SELECT * FROM tbl_kunjungan');
	$stmt->execute();
}
else{
	// else ambil data berdasarkan merk_id
	$stmt=$db->prepare('SELECT * FROM tbl_kunjungan WHERE tgl_kunjungan=:tgl');
	$stmt->execute([
		':tgl'=>$action
		]);
}
?>

<div class="row">
<?php if($stmt->rowCount() > 0): ?>
	<!-- Jika jumblah row lebih besar dari 0 artinya datanya ada, loop -->
	<?php while($row=$stmt->fetch(PDO::FETCH_ASSOC)): ?>
		<?php extract($row); ?>
		<div class="col-sm-6 col-md-4">
          <div class="thumbnail">
            <img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTipL--hVFrGvdAYKcSIzLFrdTP1wnuWaPBcxLrQ7LsTMcA_X2J" alt="...">
            <div class="caption">
              <h3><?php echo $nama_product; ?></h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
              <p><a href="#" class="btn btn-primary" role="button">Buy</a> <a href="#" class="btn btn-default" role="button">Detail</a></p>
            </div>
          </div>
        </div>
	<?php endwhile; ?>
<?php else: ?>
	<!-- else, jika tidak maka tampilkan bahwa data kosong -->
    <div class="col-sm-6 col-md-4">
      <center>
      	<h1>
      		Product Habis
      	</h1>
      </center>
    </div>
<?php endif; ?>
</div>