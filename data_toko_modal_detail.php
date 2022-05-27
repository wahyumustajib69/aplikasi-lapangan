<?php
include "koneksi.php";
$kode	= $_GET["id"];
$query = mysqli_query($konek, "SELECT * FROM tbl_toko WHERE kode_toko='$kode'");
if($query == false){
	die ("Terjadi Kesalahan : ". mysqli_error($konek));
}
while($r = mysqli_fetch_array($query)){

?>
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
            ?>
<!-- Modal Popup edit data toko -->
			<div class="modal-dialog modal-lg" style="margin-top: -1px">
				<div class="modal-content">
					<div class="modal-header bg-primary" style="border-top-right-radius: 5px; border-top-left-radius: 5px;">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
						<h4 class="modal-title"><i class="fa fa-bank"></i> DETAIL DATA TOKO</h4>
					</div>
                    <!--<form action="data_toko_edit.php" name="modal_popup" enctype="multipart/form-data" method="post">-->
					<div class="modal-body">
						<table class="table table-responsive table-striped table-condensed">
                            <thead>
                                <th>DATA</th>
                                <th>DETAIL</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>TIPE TOKO</td>
                                    <td><?php echo $r['tipe_toko'] ?></td>
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
                                    <td>ALAMAT</td>
                                    <td><?php echo $r['alamat'] ?></td>
                                </tr>
                                <tr>
                                    <td>TELEPON</td>
                                    <td><?php echo $r['no_toko'] ?></td>
                                </tr>
                                <tr>
                                    <td>TANGGAL PEMASANGAN</td>
                                    <td><?php echo tgl_indo($r['tgl_pasang']); ?></td>
                                </tr>
                                <tr>
                                    <td>SERIAL NUMBER ROUTER</td>
                                    <td><?php echo $r['sn_router'] ?></td>
                                </tr>
                                <tr>
                                    <td>SERIAL NUMBER MODEM</td>
                                    <td><?php echo $r['sn_modem'] ?></td>
                                </tr>
                                <tr>
                                    <td>SN MODEM BARU</td>
                                    <td><?php echo $r['modem_replace'] ?></td>
                                </tr>
                                <tr>
                                    <td>SIM CARD NO.</td>
                                    <td><?php echo $r['no_kartu'] ?></td>
                                </tr>
                            </tbody>                  
                        </table>
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
			
			
<?php
			}

?>