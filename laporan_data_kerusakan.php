<?php
session_start();
if(!isset($_SESSION['username'])){
  header("location:login");
}
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('fpdf/logodmm.jpg',10,8,24);
    // Arial bold 12
    $this->SetFont('Arial','B',12);
    // Geser Ke Kanan 30mm
    $this->Cell(30);
    // Judul
    $this->Cell(30,5,'LAPORAN REKAPITULASI DATA KERUSAKAN',0,1,'L');
    $this->Cell(30);
    $this->Cell(30,5,'PT. DIGITAL MEDIATAMA MAXIMA CABANG BANJARMASIN',0,1,'L');
    $this->Cell(30);
    $this->Cell(30,5,'PERIODE '.tgl_indo(date('Y-m-d')),0,1,'L');
    $this->Cell(30);
    $this->SetFont('Arial','',11);
    $this->Cell(30,5,'Jl. A. Yani KM. 11, Karang Mekar, Kertak Hanyar, Kab. Banjar 70654',0,1,'L');
    // Garis Bawah Double
    $this->SetLineWidth(1);
    $this->Line(10,31,278,31);
    $this->SetLineWidth(0);
    $this->Line(10,32,278,32);
    // Line break 5mm
    $this->Ln(6);
}

// Page footer
function Footer()
{
    // Posisi 15 cm dari bawah
    $this->SetY(-15);
    

    // Arial italic 8
    $this->SetFont('Arial','I',8);
    

    // Page number
    $this->Cell(0,10,'Halaman '.$this->PageNo().' / {nb}',0,0,'R');
}
}

//Membuat file PDF
$pdf = new PDF('L','mm','A4');

//Alias total halaman dengan default {nb} (berhubungan dengan PageNo())
$pdf->AliasNbPages();

$pdf->AddPage();
$pdf->SetFont('Times','',12);

//Mencetak kalimat dengan perulangan
$pdf->SetFillColor(24,224,23);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(7,6,'NO',1,0,'C',0);
$pdf->Cell(35,6,'KODE TOKO',1,0,'C',0);
$pdf->Cell(85,6,'NAMA TOKO',1,0,'C',0);
$pdf->Cell(40,6,'NAMA KERUSAKAN',1,0,'C',0);
$pdf->Cell(25,6,'STATUS',1,0,'C',0);
$pdf->Cell(38,6,'TANGGAL RUSAK',1,0,'C',0);
$pdf->Cell(38,6,'TANGGAL SELESAI',1,1,'C',0);
 
$pdf->SetFont('Arial','',10);

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
 
include 'koneksi.php';

if(isset($_GET['tgl'])){
    $tg = explode('-', $_GET['tgl']);
    $th=$tg[0];
    $bl=$tg[1];
    if($_GET['tgl']=='ALL-DATA'){
        $sql = mysqli_query($konek, "SELECT*FROM tbl_kerusakan ORDER BY tgl_rusak DESC");    
    }else{
        $sql = mysqli_query($konek,"SELECT*FROM tbl_kerusakan WHERE month(tgl_rusak)='$bl' AND year(tgl_rusak)='$th' ORDER BY tgl_rusak DESC");
    }
}else{
    $sql = mysqli_query($konek, "SELECT*FROM tbl_kerusakan ORDER BY tgl_rusak DESC");    
}

$no =1;
while($row = mysqli_fetch_array($sql)){
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(7,6,$no,1,0,'C',0);
    $pdf->Cell(35,6,$row['kode_toko'],1,0,'C',0);
    $pdf->Cell(85,6,$row['nama_toko'],1,0,'L',0);
    $pdf->Cell(40,6,$row['jenis_kerusakan'],1,0,'C',0);
    $pdf->Cell(25,6,$row['status'],1,0,'C',0);
    $pdf->Cell(38,6,tgl_indo($row['tgl_rusak']),1,0,'L',0);
    $tg = $row['tgl_prb'];
    if($tg=='0000-00-00'){
        $c='-';
    }else{
        $c=tgl_indo($tg);
    }
    $pdf->Cell(38,6,$c,1,1,'L',0); 
    $no++;
}
$pdf->Ln(6);
$pdf->Cell(262,6,'Pekerja Lapangan',0,1,'R');
$pdf->Ln(15);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(263,6,'WAHYU MUSTAJIB',0,1,'R');
//Menutup dokumen dan dikirim ke browser
$pdf->Output();
?>
