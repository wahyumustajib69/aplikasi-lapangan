<?php
function tgl_indo($tanggal){
                $bulan = array(
                    1 => 'JANUARI',
                        'FEBRUARI',
                        'MARET',
                        'APRIL',
                        'MEI',
                        'JUNI',
                        'JULI',
                        'AGUSTUS',
                        'SEPTEMBER',
                        'OKTOBER',
                        'NOVEMBER',
                        'DESEMBER'
                );
                $pecah = explode('-', $tanggal);
                return $pecah[2].' '.$bulan[(int)$pecah[1]].' '.$pecah[0];
            }
include "koneksi.php";
$id	= $_GET["id"];
$query = mysqli_query($konek, "SELECT * FROM tbl_kunjungan WHERE id='$id'");
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
						<h4 class="modal-title"><i class="fa fa-bank"></i> DETAIL DATA KUNJUNGAN</h4>
					</div>
                    <!--<form action="data_toko_edit.php" name="modal_popup" enctype="multipart/form-data" method="post">-->
					<div class="modal-body">
                        <div class="row">
                        <div class="col-md-6">
    						<table class="table table-responsive table-striped table-condensed">
                                <thead>
                                    <th>DATA</th>
                                    <th>DETAIL</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>TANGGAL KUNJUNGAN</td>
                                        <td><?php echo tgl_indo($r['tgl_kunjungan']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>KODE TOKO</td>
                                        <td><?php echo $r['kode_toko'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>NAMA TOKO</td>
                                        <td><?php echo $r['nama_toko'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>STATUS</td>
                                        <td><?php echo $r['status'] ?></td>
                                    </tr>
                                </tbody>                  
                            </table>
                        </div>
                        <div class="col-md-6 text-center">
                            <?php
                            $foto = $r['foto'];
                            if($foto==''){
                            ?>
                            <img src="fpdf/logodmm.jpg">
                            <?php
                            }else{
                            ?>
                            <img src="img/<?php echo $r['foto']; ?>" width='200' height='300'>
                            <?php } ?>
                        </div>
                        </div>
					</div>
                    <div class="modal-footer">
                        <!--<button class="btn btn-success" type="submit" name="simpan">
                            <i class="fa fa-floppy-o"></i> SIMPAN
                        </button>-->
                        <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                            <i class="fa fa-times"></i> TUTUP
                        </button>
                    </div>
                    </form>
				</div>
			</div>
		<?php } ?>