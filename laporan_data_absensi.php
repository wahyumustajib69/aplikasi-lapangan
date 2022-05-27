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
    $this->Cell(30,5,'LAPORAN REKAPITULASI DATA ABSENSI KARYAWAN',0,1,'L');
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
$pdf->Cell(35,6,'TANGGAL',1,0,'C',0);
$pdf->Cell(30,6,'JAM MASUK',1,0,'C',0);
$pdf->Cell(30,6,'JAM PULANG',1,0,'C',0);
$pdf->Cell(57,6,'JAM KERJA PERHARI',1,0,'C',0);
$pdf->Cell(30,6,'KETERANGAN',1,1,'C',0);
 
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
    return "{$jam} Jam {$menit} Menit {$selis} Detik";
}

include 'koneksi.php';
$bln = explode('-', $_GET['bln']);
$th=$bln[0];
$bl=$bln[1];
$sql = mysqli_query($konek,"SELECT*FROM tbl_absensi WHERE month(tanggal)='$bl' AND year(tanggal)='$th' ORDER BY tanggal DESC");
$no =1;
while($row = mysqli_fetch_array($sql)){
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(6,6,$no,1,0,'C',0);
    $pdf->Cell(35,6,tgl_indo($row['tanggal']),1,0,'L',0);
    $pdf->Cell(30,6,$row['jam_masuk'],1,0,'C',0);
    $pdf->Cell(30,6,$row['jam_pulang'],1,0,'C',0);
    //mencari total jam kerja
    $a = $row['jam_masuk'];
    $b = $row['jam_pulang'];
    $sel_waktu = SelisihWaktu($b,$a);
    $pdf->Cell(57,6,$sel_waktu,1,0,'C',0); 
    $pdf->Cell(30,6,$row['keterangan'],1,1,'C',0); 
    $no++;
}
//Menutup dokumen dan dikirim ke browser
$pdf->Output();
?>
