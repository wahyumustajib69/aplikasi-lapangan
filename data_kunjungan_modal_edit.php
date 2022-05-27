<link rel="stylesheet" type="text/css" href="assets/sweet-alert/sweetalert.css">
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/sweet-alert/sweetalert.js"></script>
<script src="assets/sweet-alert/sweetalert.min.js"></script>
<?php
include "koneksi.php";
$kode	= $_GET["id"];
$query = mysqli_query($konek, "SELECT * FROM tbl_kunjungan WHERE id='$kode'");
if($query == false){
	die ("Terjadi Kesalahan : ". mysqli_error($konek));
}
while($r = mysqli_fetch_array($query)){

?>
	
<!-- Modal Popup edit data toko -->
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header bg-primary" style="border-top-right-radius: 5px; border-top-left-radius: 5px;">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
						<h4 class="modal-title"><i class="fa fa-history"></i> EDIT DATA KERUSAKAN</h4>
					</div>
                    <form id="update" enctype="multipart/form-data" method="post">
					<div class="modal-body">
                        <input type="hidden" name="id_r" value="<?php echo $r["id"]; ?>">
							<div class="form-group">
                            	<div class="row">
                                	<div class="col-sm-6">
                                    	<label>KODE TOKO</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                            <input name="kode" type="text" class="form-control" value="<?php echo $r["kode_toko"]; ?>" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    	<label>NAMA TOKO</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-home"></i>
                                            </div>
                                            <input name="nama" type="text" class="form-control" value="<?php echo $r["nama_toko"]; ?>" readonly/>
                                        </div>
                                    </div>
                                </div>
							</div>

							<div class="form-group">
                            	<div class="row">
                                	<div class="col-sm-6">
                                        <label>TANGGAL KUNJUNGAN</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" name="tgl" class="form-control" value="<?php echo $r["tgl_kunjungan"]; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                  		<label>STATUS</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-globe"></i>
                                            </div>
                                            <select name="stts" class="form-control">
<option value="COMPLETE"<?php if($r['status']=='COMPLETE'){echo 'SELECTED';} ?>>COMPLETE</option>
<option value="PERBAIKAN"<?php if($r['status']=='PERBAIKAN'){echo 'SELECTED';} ?>>PERBAIKAN</option>
<option value="PENDING"<?php if($r['status']=='PENDING'){echo 'SELECTED';}?>>PENDING</option>
                                            </select>
                                        </div>  
                                    </div>
                                </div>	
							</div>
					</div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit" name="simpan">
                            <i class="fa fa-floppy-o"></i> SIMPAN
                        </button>
                        <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                            <i class="fa fa-times"></i> BATAL
                        </button>
                    </div>
                    </form>
				</div>
			</div>
			
			
<?php } ?>
<script type="text/javascript">
        $(document).ready(function(){
            $('#update').on('submit',function(e) { 
                $.ajax({
                  url:'data_kunjungan_edit.php',
                  data:$(this).serialize(),
                  type:'POST',
                  success:function(data){
                    setTimeout(function () { 
                    swal({
                      title: "Berhasil!",
                      text: "Update Data Berhasil!",
                      type: "success",
                      confirmButtonText: "OK"
                    },
                    function(isConfirm){
                      if (isConfirm) {
                        window.location.href = "data_kunjungan?tgl=<?php echo date('Y-m-d'); ?>";
                      }
                    }); }, 50);
                  }
                });
                e.preventDefault();
            });
        });
</script>