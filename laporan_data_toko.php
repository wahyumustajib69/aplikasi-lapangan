<?php
session_start();
if(!isset($_SESSION['username'])){
  header("location:login");
}
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header(){
    // Logo
    $this->Image('fpdf/logodmm.jpg',10,8,24);
    // Arial bold 12
    $this->SetFont('Arial','B',12);
    // Geser Ke Kanan 30mm
    $this->Cell(30);
    // Judul
    $this->Cell(30,5,'LAPORAN REKAPITULASI DATA TOKO',0,1,'L');
    $this->Cell(30);
    $this->Cell(30,5,'PT. DIGITAL MEDIATAMA MAXIMA CABANG BANJARMASIN',0,1,'L');
    $this->Cell(30);
    $this->Cell(30,5,'PERIODE '.tgl_indo(date('Y-m-d')),0,1,'L');
    $this->Cell(30);
    $this->SetFont('Arial','',11);
    $this->Cell(30,5,'Jl. A. Yani KM. 11, Karang Mekar, Kertak Hanyar, Kab. Banjar 70654',0,1,'L');
    // Garis Bawah Double
    $this->SetLineWidth(1);
    $this->Line(10,31,342,31);
    $this->SetLineWidth(0);
    $this->Line(10,32,342,32);
    // Line break 5mm
    $this->Ln(6);
}


// Page footer
function Footer(){
    // Posisi 15 cm dari bawah
    $this->SetY(-15);
    

    // Arial italic 8
    $this->SetFont('Arial','',8);
    

    // Page number
    $this->Cell(0,10,'Halaman '.$this->PageNo().' / {nb}',0,0,'R');
}
}

//Membuat file PDF
$pdf = new PDF('L','mm','Legal');

//Alias total halaman dengan default {nb} (berhubungan dengan PageNo())
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

//Mencetak kalimat dengan perulangan
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(6,6,'NO',1,0,'C',0);
$pdf->Cell(25,6,'TIPE TOKO',1,0,'C',0);
$pdf->Cell(14,6,'KODE',1,0,'C',0);
$pdf->Cell(70,6,'NAMA TOKO',1,0,'C',0);
$pdf->Cell(95,6,'ALAMAT',1,0,'C',0);
$pdf->Cell(32,6,'SN ROUTER',1,0,'C',0);
$pdf->Cell(33,6,'SN MODEM',1,0,'C',0);
$pdf->Cell(29,6,'NO. KARTU',1,0,'C',0);
$pdf->Cell(29,6,'TELP. TOKO',1,1,'C',0);

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
$data = mysqli_query($konek,"SELECT*FROM tbl_toko");
$no =1;
while($hasil=mysqli_fetch_array($data)){
  $pdf->SetFont('Arial','',9);

  $cellWidth=95; //lebar sel
  $cellHeight=6; //tinggi sel satu baris normal
  
  //periksa apakah teksnya melibihi kolom?
  if($pdf->GetStringWidth($hasil['alamat']) < $cellWidth){
    //jika tidak, maka tidak melakukan apa-apa
    $line=1;
  }else{
    //jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
    //dengan memisahkan teks agar sesuai dengan lebar sel
    //lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel
    
    $textLength=strlen($hasil['alamat']);  //total panjang teks
    $errMargin=5;   //margin kesalahan lebar sel, untuk jaga-jaga
    $startChar=0;   //posisi awal karakter untuk setiap baris
    $maxChar=0;     //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
    $textArray=array(); //untuk menampung data untuk setiap baris
    $tmpString="";    //untuk menampung teks untuk setiap baris (sementara)
    
    while($startChar < $textLength){ //perulangan sampai akhir teks
      //perulangan sampai karakter maksimum tercapai
      while( 
      $pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
      ($startChar+$maxChar) < $textLength ) {
        $maxChar++;
        $tmpString=substr($hasil['alamat'],$startChar,$maxChar);
      }
      //pindahkan ke baris berikutnya
      $startChar=$startChar+$maxChar;
      //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
      array_push($textArray,$tmpString);
      //reset variabel penampung
      $maxChar=0;
      $tmpString='';
      
    }
    //dapatkan jumlah baris
    $line=count($textArray);
  }
  
  //tulis selnya
  $pdf->SetFont('Arial','',9);
  $pdf->Cell(6,($line * $cellHeight),$no++,1,0,'C',true);
  $pdf->Cell(25,($line * $cellHeight),$hasil['tipe_toko'],1,0,'C',0);
  $pdf->Cell(14,($line * $cellHeight),$hasil['kode_toko'],1,0,'C',0);
  $pdf->Cell(70,($line * $cellHeight),$hasil['nama_toko'],1,0,'L',0);
  //memanfaatkan MultiCell sebagai ganti Cell
  //atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
  //ingat posisi x dan y sebelum menulis MultiCell
  $xPos=$pdf->GetX();
  $yPos=$pdf->GetY();

  $pdf->MultiCell($cellWidth,$cellHeight,$hasil['alamat'],1);
  
  //kembalikan posisi untuk sel berikutnya di samping MultiCell 
    //dan offset x dengan lebar MultiCell
  $pdf->SetXY($xPos + $cellWidth , $yPos);
  
  $pdf->Cell(32,($line * $cellHeight),$hasil['sn_router'],1,0,'L',0);
  $pdf->Cell(33,($line * $cellHeight),$hasil['sn_modem'],1,0,'L',0);
  $pdf->Cell(29,($line * $cellHeight),$hasil['no_kartu'],1,0,'R',0);
  $pdf->Cell(29,($line * $cellHeight),$hasil['no_toko'],1,1,'R',0);
  //$pdf->Cell(29,($line * $cellHeight),$hasil['sn_router'],1,1,'L',0); //sesuaikan ketinggian dengan jumlah garis
}

//Menutup dokumen dan dikirim ke browser
$pdf->Output();
?>
