<?php 
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
   <style>
            body {
                font-family: 'Roboto', Arial, Sans-serif;
                font-size: 15px;
                font-weight: 400;
            }
            .container {
                left: 50%;
                position: absolute;
                top: 7.5%;
                transform: translate(-50%, -7.5%);
            }
            input[type=text] {
                border: 1px solid #bdbdbd;
                font-family: 'Roboto', Arial, Sans-serif;
                font-size: 15px;
                font-weight: 400;
                padding: .5em .75em;
                width: 300px;
            }
            input[type=text]:focus {
                outline: none;
            }
            .autocomplete-suggestions {
                border: 1px solid #999;
                background: #FFF;
                overflow: auto;
            }
            .autocomplete-suggestion {
                padding: 2px 5px;
                white-space: nowrap;
                overflow: hidden;
            }
            .autocomplete-selected {
                background: #F0F0F0;
                cursor: pointer;
            }
            .autocomplete-suggestions strong {
                font-weight: bold;
                color: red;
            }
            .autocomplete-group {
                padding: 2px 5px;
            }
            .autocomplete-group strong {
                display: block;
                border-bottom: 1px solid #000;
            }
        </style>
</head>
<body>
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
                        <a  href="data_hardware"><i class="fa fa-hdd-o fa-2x"></i> <b>Data Hardware</b></a>
                    </li>   
                    <li  >
                        <a class="active-menu"  href="data_kunjungan?tgl=<?php echo date('Y-m-d'); ?>"><i class="fa fa-bus fa-2x"></i> <b>Kunjungan Harian</b></a>
                    </li>                  
                    <li>
                        <?php
                        $date = date('Y-m-d');
                        $pc = explode('-', $date);
                        $bl = $pc['0'].'-'.$pc['1'];
                        ?>
                        <a  href="data_absensi?bln=<?php echo $bl; ?>"><i class="fa fa-calendar fa-2x"></i> <b>Absensi</b></a>
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
                                <h2><i class="fa fa-bus"></i> DATA KUNJUNGAN</h2>           
                            </div>
                            <div class="col-md-4 text-center">
                                <small>Tampilkan Pertanggal</small>
                                <div class="row">
                                    <div class="col-md-8">
                                <form method="get">
                                <select name="tgl" class="form-control pull-left" onchange="this.form.submit();">
                                    <option disabled="disabled" selected="">-PILIH-</option>
                                    <?php 
                                    $sql = mysqli_query($konek,"SELECT*FROM tbl_kunjungan GROUP BY tgl_kunjungan ORDER BY tgl_kunjungan DESC");
                                    while($a=mysqli_fetch_assoc($sql)){
                                        ?>
<option value="<?php echo $a['tgl_kunjungan']; ?>"><?php echo tgl_indo($a['tgl_kunjungan']); ?></option>
                                    <?php } ?>
                                </select>
                                </form>        
                                    </div>
                                    <div class="col-md-4">
                                        <a href="laporan_data_kunjungan?tgl=<?php echo $_GET['tgl'] ?>" target="blank" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak Pdf</a>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <small></small><br>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#ModalTambah">
                        <i class="fa fa-plus"></i> Tambah    
                        </button>
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
                            Data Kunjungan
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table  id="dataTables-example" class="table table-striped table-bordered table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>TANGGAL</th>
                                            <th>KODE TOKO</th>
                                            <th>NAMA TOKO</th>
                                            <th>STATUS</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $no =1;
                                        if (isset($_GET['tgl'])){
                                            $tgl = $_GET['tgl'];
$sql = mysqli_query($konek, "SELECT*FROM tbl_kunjungan WHERE tgl_kunjungan='$tgl'");
                                        }else{
$sql = mysqli_query($konek, "SELECT*FROM tbl_kunjungan ORDER BY id DESC");
                                        }
                        
                                        while($a= mysqli_fetch_assoc($sql)){
                                        ?>
                                        <tr style="font-size: 12px">
                                            <td><?php echo $no++;?></td>
                                            <td><?php echo tgl_indo($a['tgl_kunjungan']); ?></td>
                                            <td><?php echo $a['kode_toko']; ?></td>
                                            <td><?php echo $a['nama_toko']; ?></td>
                                            <td>
                                                <?php 
                                                if($a['status']=='COMPLETE'){
                                                    echo "<span class='label label-success'>".$a['status']."</span>";
                                                }else if($a['status']=='PERBAIKAN'){
                                                    echo "<span class='label label-primary'>".$a['status']."</span>";
                                                }else{
                                                    echo "<span class='label label-danger'>".$a['status']."</span>";
                                                } 
                                                ?>    
                                            </td>
                                            <td>
<a class="btn btn-xs btn-primary modal_detail" href="#" id='<?php echo $a['id'];?>'><i class="fa fa-question-circle"></i></a>
<a class="btn btn-xs btn-success modal_edit" href="#" id='<?php echo $a['id'];?>'><i class="fa fa-edit"></i></a>
<a class="btn btn-xs btn-danger" onclick="confirm_delete('data_kunjungan_delete.php?id=<?php echo $a['id'];?>')"><i class="fa fa-trash"></i></a>
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
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-history"></i> TAMBAH DATA KUNJUNGAN</h4>
                    </div>
                    <form action="data_kunjungan_tambah.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>KODE TOKO</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-home"></i>
                                                </div>
                                            <input type="text" name="kode" id="kode" class="form-control" value="" autocomplete="off" readonly placeholder="Otomatis Terisi">       
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>NAMA TOKO</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-search"></i>
                                                </div>
                                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Cari Nama Toko" value="" required autocomplete="off" autofocus="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>TANGGAL KUNJUNGAN</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            <input type="date" name="tgl" class="form-control"required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>STATUS</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-wrench"></i>
                                                </div>
                                            <select class="form-control" name="status" required>
                                                <option value="">-PILIH-</option>
                                                <option value="COMPLETE">COMPLETE</option>
                                                <option value="PERBAIKAN">PERBAIKAN</option>
                                                <option value="PENDING">PENDING</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>FOTO</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-image"></i>
                                                </div>
                                <input type="file" name="foto" class="form-control" required>
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
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/sweet-alert/sweetalert.js"></script>
    <script src="assets/sweet-alert/sweetalert.min.js"></script>
    <!--Alert Simpan Data-->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tambah').on('submit',function(e) { 
                $.ajax({
                  url:'data_kunjungan_tambah.php',
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
                        window.location.href = "data_kunjungan?tgl=<?php echo date('Y-m-d'); ?>";
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
    <script type="text/javascript">
        $(document).ready(function() {
                // Selector input yang akan menampilkan autocomplete.
            $( "#nama" ).autocomplete({
                serviceUrl: "data_toko_cari.php",   // Kode php untuk prosesing data.
                dataType: "JSON",  // Tipe data JSON.
                onSelect: function (suggestion) {
                $( "#nama" ).val("" + suggestion.nama);
                $( "#kode" ).val("" + suggestion.kode);
                }
            });
        })
    </script>
    <!--javascript datail data-->
    <script>
        $(document).ready(function () {
        $(".modal_detail").click(function(e) {
            var n = $(this).attr("id");
                $.ajax({
                    url: "data_kunjungan_modal_detail.php",
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
                    url: "data_kunjungan_modal_edit.php",
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