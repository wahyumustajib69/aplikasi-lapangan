<link rel="stylesheet" type="text/css" href="assets/sweet-alert/sweetalert.css">
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/sweet-alert/sweetalert.js"></script>
<script src="assets/sweet-alert/sweetalert.min.js"></script>
<?php
include "koneksi.php";
$id	= $_GET["id"];
$query = mysqli_query($konek, "SELECT * FROM tbl_kerusakan WHERE id='$id'");
if($query == false){
	die ("Terjadi Kesalahan : ". mysqli_error($konek));
}
while($r = mysqli_fetch_array($query)){

?>
	
<!-- Modal Popup edit data toko -->
			<div class="modal-dialog modal-lg" style="margin-top: -1px">
				<div class="modal-content">
					<div class="modal-header bg-primary" style="border-top-right-radius: 5px; border-top-left-radius: 5px;">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
						<h4 class="modal-title"><i class="fa fa-calendar"></i> EDIT DATA KUNJUNGAN</h4>
					</div>
                    <form id="update" enctype="multipart/form-data" method="post">
					<div class="modal-body">
                        <input type="hidden" name="id" value="<?php echo $r["id"] ?>">
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
                                        <label>TANGGAL KERUSAKAN</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input name="tgl_kr" type="date" class="form-control" value="<?php echo $r["tgl_rusak"]; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>TANGGAL SELESAI</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input name="tgl_pb" type="date" class="form-control" value="<?php echo $r["tgl_prb"]; ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

							<div class="form-group">
                            	<div class="row">
                                	<div class="col-sm-6">
                                        <label>JENIS KERUSAKAN</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-wrench"></i>
                                            </div>
                                            <input name="jenis" class="form-control" value="<?php echo $r["jenis_kerusakan"]; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                  		<label>STATUS</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-globe"></i>
                                            </div>
                                            <select name="stts" class="form-control">
<option value="NO ACTION"<?php if($r['status']=='NO ACTION'){echo 'SELECTED';} ?>>NO ACTION</option>
<option value="PERBAIKAN"<?php if($r['status']=='PERBAIKAN'){echo 'SELECTED';} ?>>PERBAIKAN</option>
<option value="SELESAI"<?php if($r['status']=='SELESAI'){echo 'SELECTED';}?>>SELESAI</option>
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
                  url:'data_kerusakan_edit.php',
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
                        window.location.href = "data_kerusakan?tgl=ALL-DATA";
                      }
                    }); }, 200);
                  }
                });
                e.preventDefault();
            });
        });
</script>