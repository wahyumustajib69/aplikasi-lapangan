<?php
//session_start();
//if(!isset($_SESSION['username'])){
  //header("location:login");
//}
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
    $this->Cell(30,5,'LAPORAN REKAPITULASI DATA HARDWARE',0,1,'L');
    $this->Cell(30);
    $this->Cell(30,5,'PT. DIGITAL MEDIATAMA MAXIMA CABANG BANJARMASIN',0,1,'L');
    $this->Cell(30);
    $this->Cell(30,5,'PERIODE '.tgl_indo(date('Y-m-d')),0,1,'L');
    $this->Cell(30);
    $this->SetFont('Arial','',11);
    $this->Cell(30,5,'Jl. A. Yani KM. 11, Karang Mekar, Kertak Hanyar, Kab. Banjar 70654',0,1,'L');
    // Garis Bawah Double
    $this->SetLineWidth(1);
    $this->Line(10,31,198,31);
    $this->SetLineWidth(0);
    $this->Line(10,32,198,32);
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
    $this->Cell(0,10,'Halaman '.$this->PageNo().' / {nb}',0,0,'C');
}
}

//Membuat file PDF
$pdf = new PDF('P','mm','A4');

//Alias total halaman dengan default {nb} (berhubungan dengan PageNo())
$pdf->AliasNbPages();

$pdf->AddPage();
$pdf->SetFont('Times','',12);

//Mencetak kalimat dengan perulangan
$pdf->SetFillColor(24,224,23);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(6,6,'NO',1,0,'C',0);
$pdf->Cell(30,6,'NAMA',1,0,'C',0);
$pdf->Cell(25,6,'MERK / TIPE',1,0,'C',0);
$pdf->Cell(44,6,'TANGGAL TERIMA',1,0,'C',0);
$pdf->Cell(25,6,'KONDISI',1,0,'C',0);
$pdf->Cell(25,6,'JUMLAH',1,0,'C',0);
$pdf->Cell(33,6,'KETERANGAN',1,1,'C',0);
 
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

$sql = mysqli_query($konek,"SELECT*FROM tbl_hardware");
$no =1;
while($row = mysqli_fetch_array($sql)){
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(6,6,$no,1,0,'C',0);
    $pdf->Cell(30,6,$row['nama'],1,0,'L',0);
    $pdf->Cell(25,6,$row['tipe'],1,0,'L',0);
    $pdf->Cell(44,6,tgl_indo($row['tgl_terima']),1,0,'C',0);
    if($row['kondisi']=="NORMAL"){
        $pdf->Cell(25,6,$row['kondisi'],1,0,'C',0); 
    }else{
        $pdf->SetFont('Arial','I',8);
        $pdf->SetTextColor(220,50,50);
        $pdf->Cell(25,6,$row['kondisi'],1,0,'C',0); 
        $pdf->SetTextColor(0,0,0);
    }
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(25,6,$row['qty'],1,0,'C',0); 
    $pdf->Cell(33,6,$row['keterangan'],1,1,'L',0); 
    $no++;
}

//Menutup dokumen dan dikirim ke browser
$pdf->Output();
?>
