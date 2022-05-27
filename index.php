<?php include "header.php"; ?> 
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center">
                    <img src="assets/img/logodmm.jpg" class="user-image img-responsive"/>
                    </li>
                    <li>
                        <a class="active-menu"  href="index"><i class="fa fa-dashboard fa-2x"></i> <b>Dashboard</b></a>
                    </li>
                     <li>
                        <a  href="data_toko"><i class="fa fa-home fa-2x"></i> <b>Data Toko</b></a>
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
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2><i class="fa fa-dashboard"></i> DASHBOARD</h2>   
                        <h5 class="alert alert-success">Selamat Datang <b><?php echo strtoupper($_SESSION['username']); ?></b>. </h5>
                    </div>
                </div>              
                <hr />
                <div class="row">
                    <a href="data_toko" class="text-danger">
                    <div class="col-md-3 col-sm-6 col-xs-6">           
            			<div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-green set-icon">
                                <i class="fa fa-home"></i>
                            </span>
                            <div class="text-box" >
                                <?php
                                $sql = mysqli_query($konek,"SELECT*FROM tbl_toko");
                                $a = mysqli_num_rows($sql);
                                ?>
                                <p class="main-text"><?php echo $a ?> Toko</p>
                                <p class="text-muted">Total Toko</p>
                            </div>
                         </div>
    		        </div>
                    </a>
                    <a href="data_kerusakan" class="text-danger">
                        <div class="col-md-3 col-sm-6 col-xs-6">           
                			<div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-red set-icon">
                                    <i class="fa fa-exclamation-triangle"></i>
                                </span>
                                <div class="text-box" >
                                <?php
                                $sql = mysqli_query($konek,"SELECT*FROM tbl_kerusakan");
                                $a = mysqli_num_rows($sql);
                                ?>
                                    <p class="main-text"><?php echo $a ?> Unit</p>
                                    <p class="text-muted">Kerusakan</p>
                                </div>
                            </div>
    		            </div>
                    </a>
                    <a href="data_kunjungan" class="text-danger">
                        <div class="col-md-3 col-sm-6 col-xs-6">           
                			<div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-blue set-icon">
                                    <i class="fa fa-wrench"></i>
                                </span>
                                <div class="text-box" >
                                    <?php
                                        $tg = date('Y-m-d');
                                        $sql = mysqli_query($konek,"SELECT*FROM tbl_kunjungan WHERE tgl_kunjungan ='$tg'");
                                        $h = mysqli_num_rows($sql);
                                    ?>
                                    <p class="main-text"><?php echo $h.' Toko'; ?></p>
                                    <p class="text-muted">Daily Check</p>
                                </div>
                             </div>
        		        </div>
                    </a>
                    <a href="data_hardware" class="text-danger">
                        <div class="col-md-3 col-sm-6 col-xs-6">           
                			<div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-brown set-icon">
                                    <i class="fa fa-hdd-o"></i>
                                </span>
                                <div class="text-box" >
                                    <?php
                                        $sql = mysqli_query($konek,"SELECT*FROM tbl_hardware");
                                        $g = mysqli_num_rows($sql);
                                    ?>
                                    <p class="main-text"><?php echo $g.' Mcm'; ?></p>
                                    <p class="text-muted"><span class="small">Hrd. Variant</span></p>
                                </div>
                             </div>
                		</div>
                    </a>
    			</div>                      
            </div>
        </div>
        <button onclick="topFunction()" id="myBtn" title="Atas"><i class="fa fa-chevron-up"></i></button>
<?php include "footer.php"; ?>