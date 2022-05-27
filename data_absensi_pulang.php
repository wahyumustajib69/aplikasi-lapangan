<link rel="stylesheet" type="text/css" href="assets/sweet-alert/sweetalert.css">
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/sweet-alert/sweetalert.js"></script>
<script src="assets/sweet-alert/sweetalert.min.js"></script>
<?php
include "koneksi.php";
$id	= $_GET["id"];
$query = mysqli_query($konek, "SELECT * FROM tbl_absensi WHERE id='$id'");
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
						<h4 class="modal-title"><i class="fa fa-calendar"></i> ABSENSI PULANG</h4>
					</div>
                    <form id="update" enctype="multipart/form-data" method="post">
					<div class="modal-body">
                        <input type="hidden" name="id" value="<?php echo $r["id"]; ?>">
							<div class="form-group">
                            	<div class="row">
                                	<div class="col-sm-6">
                                    	<label>TANGGAL</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                            <input name="tgl" type="text" class="form-control" value="<?php echo $r["tanggal"]; ?>" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    	<label>JAM MASUK</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <input name="masuk" type="text" class="form-control" value="<?php echo $r["jam_masuk"]; ?>" readonly/>
                                        </div>
                                    </div>
                                </div>
							</div>

							<div class="form-group">
                            	<div class="row">
                                	<div class="col-sm-6">
                                        <label>JAM PULANG</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <?php
                                            date_default_timezone_set('Asia/Makassar');
                                            $jam_s = date("H:i:s"); 
                                            ?>
                                            <input name="pulang" id="pulang" value="<?php echo $jam_s; ?>" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                  		<label>KETERANGAN</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-globe"></i>
                                            </div>
                                            <select name="ket" class="form-control">
<option value="JAM KERJA"<?php if($r['keterangan']=='JAM KERJA'){echo 'SELECTED';} ?>>JAM KERJA</option>
<option value="LEMBUR"<?php if($r['keterangan']=='LEMBUR'){echo 'SELECTED';} ?>>LEMBUR</option>
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
    </script>
<script type="text/javascript">
        $(document).ready(function(){
            $('#update').on('submit',function(e) { 
                $.ajax({
                  url:'data_absensi_pulang_update.php',
                  data:$(this).serialize(),
                  type:'POST',
                  success:function(data){
                    setTimeout(function () { 
                    swal({
                      title: "Berhasil!",
                      text: "Absensi Anda Berhasil!",
                      type: "success",
                      confirmButtonText: "OK"
                    },
                    function(isConfirm){
                      if (isConfirm) {
                        window.location.href = "data_absensi?bln=<?php echo date('Y-m') ?>";
                      }
                    }); }, 200);
                  }
                });
                e.preventDefault();
            });
        });
</script>