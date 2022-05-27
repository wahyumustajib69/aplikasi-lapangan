<?php 
error_reporting(0);
session_start();
if(!isset($_SESSION['username'])){
  header("location:login");
}
include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LAPORAN DATA LAPANGAN</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link rel="stylesheet" type="text/css" href="assets/sweet-alert/sweetalert.css">
   <link rel="icon" href="assets/img/logodmm.jpg">
   <style type="text/css">
    #myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 10px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: red;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#myBtn:hover {
  background-color: #000;
}

   </style>
   <script type="text/javascript">
       window.setTimeout("waktu()",1000);
       function waktu(){
        var tanggal = new Date();
        setTimeout("waktu()",1000);
        document.getElementById("jam").innerHTML = tanggal.getHours();
        document.getElementById("menit").innerHTML = tanggal.getMinutes();
        document.getElementById("detik").innerHTML = tanggal.getSeconds();
       }
   </script>
</head>
<body onload="waktu()">
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">PT. DMM<br>
                    <span class="h6"><b>Cabang Banjarmasin</b></span> 
                </a>
            </div>
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
            <?php
            function SelisihWaktu($masuk,$pulang){
                    $sec = 0;
                    $det = 0;
                    $sel = 0;
                    if(strtotime($masuk)>strtotime($pulang)){
                        $mulai = $pulang;$akhir=$masuk;
                    }else{
                        $mulai = $masuk; $akhir = $pulang;
                    }
                    list($g,$i,$s) = explode(":", $mulai);
                    $sec +=$g*3600;
                    $sec +=$i*60;
                    $sec +=$s;
                    $newSec = $sec;

                    list($g,$i,$s) = explode(":", $akhir);
                    $det +=$g*3600;
                    $det +=$i*60;
                    $det +=$s;
                    $newDet = $det;

                    $selis = $newDet -$newSec;
                    $jam = floor($selis/3600);
                    $selis -= $jam*3600;
                    $menit = floor($selis/60);
                    $selis -= $menit*60;
                    if($jam<10){$jam=''.$jam;}
                    if($menit<10){$menit=''.$menit;}
                    if($selis<10){$selis=''.$selis;}
                    return "{$jam}:{$menit}:{$selis}";
                }
            ?>
<div style="color: white;padding: 15px 50px 5px 50px;float: right;font-size: 16px;"> 
    Tanggal :&nbsp;<?php echo $thn = tgl_indo(date('Y-m-d'));?>  &nbsp; <a href="logout" class="btn btn-danger" onclick="return confirm('APAKAH ANDA YAKIN?')"><i class="fa fa-sign-out"></i> Logout</a> 
</div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center">
                    <img src="assets/img/logodmm.jpg" class="user-image img-responsive"/>
                    </li>
                
                    
                    <li>
                        <a href="index"><i class="fa fa-dashboard fa-2x"></i> <b>Dashboard</b></a>
                    </li>
                     <li>
                        <a  class="" href="data_toko"><i class="fa fa-home fa-2x"></i> <b>Data Toko</b></a>
                    </li>
                    <li>
                        <a  href="data_kerusakan?tgl=ALL-DATA"><i class="fa fa-history fa-2x"></i> <b>Data Kerusakan</b></a>
                    </li>
                             <li  >
                        <a   href="data_hardware"><i class="fa fa-hdd-o fa-2x"></i> <b>Data Hardware</b></a>
                    </li>   
                    <li  >
                        <a  href="data_kunjungan?tgl=<?php echo date('Y-m-d'); ?>"><i class="fa fa-bus fa-2x"></i> <b>Kunjungan Harian</b></a>
                    </li>                  
                    <li>
                        <?php
                        $date = date('Y-m-d');
                        $pc = explode('-', $date);
                        $bl = $pc['0'].'-'.$pc['1'];
                        ?>
                        <a class="active-menu"  href="data_absensi?bln=<?php echo $bl; ?>"><i class="fa fa-calendar fa-2x"></i> <b>Absensi</b></a>
                    </li>                  
                    <li>
                        <a href="#"><i class="fa fa-book fa-2x"></i> <b>Laporan</b><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="laporan_data_toko" target="_blank">Laporan Data Toko</a>
                            </li>
                            <li>
                                <a href="laporan_data_kerusakan" target="_blank">Laporan Data Kerusakan</a>
                            </li>
                            <li>
                                <a href="laporan_data_hardware" target="_blank">Laporan Data Hardware</a>
                            </li>
                        </ul>
                      </li>     
                </ul>
            </div>    
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <h2><i class="fa fa-calendar"></i> DATA ABSENSI</h2>           
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="col-md-6">
                                    <form method="get">
                                        <select name="bln" class="form-control pull-right" onchange="this.form.submit();">
                                            <option>-PILIH-</option>
                                            <?php 
                                                $sql = mysqli_query($konek,"SELECT tanggal FROM tbl_absensi GROUP BY month(tanggal) ORDER BY tanggal DESC");
                                                while($tp=mysqli_fetch_assoc($sql)){
                                                    $date = explode('-', $tp['tanggal']);
                                                    $bln = $date[0].'-'.$date[1];
                                            ?>
                                            <option value="<?php echo $bln;?>"><?php echo tgl_indo($bln);?></option>
                                            <?php } ?> 
                                        </select>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <a href="laporan_data_absensi?bln=<?php echo $_GET['bln'] ?>" target="blank" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak Pdf</a>  
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <?php 
                                    $sql = mysqli_query($konek, "SELECT*FROM tbl_absensi ORDER BY id DESC");
                                    $x = mysqli_fetch_assoc($sql);
                                    $plg = $x['jam_pulang'];
                                    if($plg=="0:0:0"){
                                        ?>
                                        <a class="btn btn-success modal_edit pulang" href="#" id="<?php echo $x["id"];?>"><i class="fa fa-home"></i> PULANG</a>
                                        <?php
                                    }else{
                                        ?>
                                        <button id="tombol" class="btn btn-primary" data-toggle="modal" data-target="#ModalTambah">
                                        <i class="fa fa-sign-in"></i> MASUK
                                        </button>
                                        <?php
                                    }
                                ?>                                
                            </div>
                        </div>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                             Data Absensi
                             <div class="col-md-6" id="jam-masuk"><span class="label label-success" id="jam"></span>:<span class="label label-warning" id="menit"></span>:<span class="label label-danger" id="detik"></span>
                                </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table  id="dataTables-example" class="table table-striped table-bordered table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>HARI / TANGGAL</th>
                                            <th>JAM MASUK</th>
                                            <th>JAM PULANG</th>
                                            <th>JAM KERJA</th>
                                            <th>KETERANGAN</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $no =1;
                                        if(isset($_GET['bln'])){
                                            $bln = explode('-', $_GET['bln']);
                                            $th=$bln[0];
                                            $bl=$bln[1];
$sql = mysqli_query($konek,"SELECT*FROM tbl_absensi WHERE month(tanggal)='$bl' AND year(tanggal)='$th' ORDER BY tanggal DESC");
                                        }else{
                                            $sql = mysqli_query($konek, "SELECT*FROM tbl_absensi ORDER BY tanggal DESC");    
                                        }
                                        
                                        while($a= mysqli_fetch_assoc($sql)){
                                        ?>
                                        <tr style="font-size: 12px">
                                            <td><?php echo $no++;?></td>
                                            <td><?php echo tgl_indo($a['tanggal']); ?></td>
                                            <td><?php echo $a['jam_masuk']; ?></td>
                                            <td><?php echo $a['jam_pulang']; ?></td>
                                            <td>
                                            <?php
                                            $masuk = $a['jam_masuk'];
                                            $pulang = $a['jam_pulang'];
                                            echo $wk = SelisihWaktu($pulang,$masuk);
                                            ?>  
                                            </td>
                                            <td><small class="label label-success"><?php echo $a['keterangan']; ?></small></td>
                                            <td>
                                                <?php
                                                    if($a['jam_pulang']=="0:0:0"){
                                                ?>
<small class="label label-danger">JAM KERJA</small><?php }else{  ?>
<small>JAM KERJA SELESAI</small><?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Modal Popup untuk delete--> 
        <div class="modal modal-xs fade" id="modal-delete">
            <div class="modal-dialog">
                <div class="modal-content" style="margin-top:150px;">
                    <div class="modal-header bg-primary" style="border-top-right-radius: 5px; border-top-left-radius: 5px;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                        <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> KONFIRMASI</h4>
                    </div> 
                    <div class="modal-body" align="center">Apakah Anda Yakin??<br>Hapus data <i class="fa fa-trash"></i></div>   
                    <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                        <a href="#" class="btn btn-danger" id="delete-link"><i class="fa fa-check"></i> Hapus</a>
                        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                    </div>
                </div>
            </div>
        </div>              
                            <!--Modal detail Data-->
                            <div class="modal fade" id="modal-detail"></div>
                            <!--Modal edit Data-->
                            <div class="modal fade" id="modal-edit"></div>
                            <!--Modal Tambah Data-->
                            <div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary"  style="border-top-right-radius: 5px;border-top-left-radius: 5px;">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar"></i> ABSENSI KEDATANGAN</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" id="tambah">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>TANGGAL</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-home"></i>
                                            </div>
                                            <input type="text" name="tgl" class="form-control" value="<?php echo tgl_indo(date('Y-m-d'));?>" autocomplete="off" readonly>       
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>JAM MASUK</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-search"></i>
                                            </div>
                                            <input type="text" name="masuk" id="masuk" class="form-control" value="" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>JAM PULANG</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-globe"></i>
                                            </div>
                                            <input type="text" name="pulang" class="form-control" autocomplete="off" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>KETERANGAN</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-pencil"></i>
                                            </div>
                                            <select class="form-control" name="ket" required>
                                                <option value="">-PILIH-</option>
                                                <option value="KERJA">JAM KERJA</option>
                                                <option value="LEMBUR">LEMBUR</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success" name="simpan"><i class="fa fa-floppy-o"></i> SIMPAN</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> TUTUP</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>                    
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
        <button onclick="topFunction()" id="myBtn" title="Atas"><i class="fa fa-chevron-up"></i></button>

     <!-- /. WRAPPER  -->
    <!--Tombol back to top-->
    <script>
    //deklarasi 
    var mybutton = document.getElementById("myBtn");

    //ketika halaman discroll ke bawah sebanyak 100px
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
      if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        mybutton.style.display = "block";
      } else {
        mybutton.style.display = "none";
      }
    }
    //ketika tombol diclick
    function topFunction() {
       $("html, body").animate({scrollTop: 0}, 500);
    }
    </script>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tombol').click(function(){
                var nilai = $('#jam-masuk').text();
                document.getElementById("masuk").value = nilai;
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.pulang').click(function(){
                var nilai = $('#jam-masuk').text();
                document.getElementById("pulang");
            });
        });
    </script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/sweet-alert/sweetalert.js"></script>
    <script src="assets/sweet-alert/sweetalert.min.js"></script>
    <!--Alert Simpan Data-->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tambah').on('submit',function(e) { 
                $.ajax({
                  url:'data_absensi_tambah.php',
                  data:$(this).serialize(),
                  type:'POST',
                  success:function(data){
                    setTimeout(function () { 
                    swal({
                      title: "Berhasil!",
                      text: "Data Berhasil Disimpan!",
                      type: "success",
                      confirmButtonText: "OK"
                    },
                    function(isConfirm){
                      if (isConfirm) {
                        window.location.href = "data_absensi?bln=<?php echo date('Y-m');?>";
                      }
                    }); }, 500);
                  }
                });
                e.preventDefault();
            });
        });
    </script>
    <script src="assets/js/jquery.autocomplete.min.js"></script>
    <!--Script autocomplete-->
    <!--<script type="text/javascript">
        $(document).ready(function() {
                // Selector input yang akan menampilkan autocomplete.
            $( "#nama" ).autocomplete({
                serviceUrl: "data_toko_cari.php",   // Kode php untuk prosesing data.
                dataType: "JSON",           // Tipe data JSON.
                onSelect: function (suggestion) {
                $( "#nama" ).val("" + suggestion.nama);
                $( "#kode" ).val("" + suggestion.kode);
                }
            });
        })
    </script>-->
    <!--javascript datail data-->
    <script>
        $(document).ready(function () {
        $(".modal_detail").click(function(e) {
            var n = $(this).attr("id");
                $.ajax({
                    url: "data_toko_modal_detail.php",
                    type: "GET",
                    data : {id: n,},
                    success: function (ajaxData){
                        $("#modal-detail").html(ajaxData);
                        $("#modal-detail").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
    </script>
    <!--javascript edit data-->
    <script>
        $(document).ready(function () {
        $(".modal_edit").click(function(e) {
            var m = $(this).attr("id");
                $.ajax({
                    url: "data_absensi_pulang.php",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        $("#modal-edit").html(ajaxData);
                        $("#modal-edit").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
    </script>
    <!-- Javascript hapus data-->
    <script>
        function confirm_delete(delete_url){
            $("#modal-delete").modal('show', {backdrop: 'static'});
            document.getElementById('delete-link').setAttribute('href', delete_url);
        }
    </script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>

         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>