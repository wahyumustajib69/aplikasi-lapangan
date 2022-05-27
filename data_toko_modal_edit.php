<link rel="stylesheet" type="text/css" href="assets/sweet-alert/sweetalert.css">
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/sweet-alert/sweetalert.js"></script>
<script src="assets/sweet-alert/sweetalert.min.js"></script>
<?php
include "koneksi.php";
$kode	= $_GET["id"];
$query = mysqli_query($konek, "SELECT * FROM tbl_toko WHERE kode_toko='$kode'");
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
						<h4 class="modal-title"><i class="fa fa-bank"></i> EDIT DATA TOKO</h4>
					</div>
                    <form action="" name="modal_popup" enctype="multipart/form-data" method="post" id="update">
					<div class="modal-body">
							<div class="form-group">
                            	<div class="row">
                                	<div class="col-sm-6">
                                    	<label>TIPE TOKO</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-home"></i>
                                            </div>
                                            <input name="tipe" type="text" class="form-control" value="<?php echo $r["tipe_toko"]; ?>" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    	<label>KODE TOKO</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                            <input name="kode" type="text" class="form-control" value="<?php echo $r["kode_toko"]; ?>" readonly/>
                                        </div>
                                    </div>
                                </div>
							</div>

							<div class="form-group">
                            	<div class="row">
                                	<div class="col-sm-6">
                                        <label>NAMA TOKO</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-home"></i>
                                            </div>
                                            <input name="nama" class="form-control" value="<?php echo $r["nama_toko"]; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                  		<label>PROVINSI</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-globe"></i>
                                            </div>
                                            <input name="prov" type="text" class="form-control" value="<?php echo $r["provinsi"]; ?>"/>
                                        </div>  
                                    </div>
                                </div>
								
							</div>
                            <div class="form-group">
                            	<div class="row">
                                    <div class="col-sm-6">
                                        <label>KOTA</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                            <input name="kota" class="form-control" value="<?php echo $r["kota"]; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>TGL PEMASANGAN</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input name="tgl" class="form-control" value="<?php echo $r["tgl_pasang"]; ?>" />
                                        </div>
                                    </div>
                                </div>
							</div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>SN ROUTER</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-shield"></i>
                                            </div>
                                            <input name="sn_rou" class="form-control" value="<?php echo $r["sn_router"]; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>SN MODEM</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-shield"></i>
                                            </div>
                                            <input name="sn_mod" class="form-control" value="<?php echo $r["sn_modem"]; ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>SN MODEM REPLACE</label>
                                        <div class="input-group">
                                            <i class="input-group-addon">
                                                <i class="fa fa-retweet"></i>
                                            </i>
                                            <input name="sn_mod_r" class="form-control" value="<?php echo $r["modem_replace"]; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>NOMOR KARTU</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-credit-card"></i>
                                            </div>
                                            <input type="text" name="card" class="form-control" value="<?php echo $r["no_kartu"]; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>NO. HP TOKO</label>
                                        <div class="input-group">
                                            <i class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </i>
                                            <input name="hp_toko" class="form-control" value="<?php echo $r["no_toko"]; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>ALAMAT</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-bank"></i>
                                            </div>
                                            <textarea name="almt" class="form-control"><?php echo $r["alamat"]; ?></textarea>
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
                  url:'data_toko_edit.php',
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
                        window.location.href = "data_toko.php";
                      }
                    }); }, 200);
                  }
                });
                e.preventDefault();
            });
        });
</script>