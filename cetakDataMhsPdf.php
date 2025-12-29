<?php
require_once __DIR__ . '/fpdf186/fpdf.php';
require_once __DIR__ . '/koneksi.php';

/* ================= FORMAT TANGGAL INDONESIA ================= */
function tglIndo($tanggal) {
    $bulan = [
        1 => 'Januari','Februari','Maret','April','Mei','Juni',
        'Juli','Agustus','September','Oktober','November','Desember'
    ];
    $pecah = explode('-', $tanggal);
    return $pecah[2].' '.$bulan[(int)$pecah[1]].' '.$pecah[0];
}

/* ================= CLASS PDF ================= */
class PDF extends FPDF {
    function Header() {
        // Logo
        if (file_exists('logo.png')) {
            $this->Image('logo.png',10,8,25);
        }

        // Judul
        $this->SetFont('Arial','B',16);
        $this->Cell(0,10,'LAPORAN DATA MAHASISWA',0,1,'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'ADINDA SALSA SETEVANI | NIM: A12.2024.07276 | Halaman '.$this->PageNo(),0,0,'C');
    }
}

/* ================= FILTER SEARCH ================= */
$where = "";
if (!empty($_GET['keyword'])) {
    $key = mysqli_real_escape_string($GLOBALS['koneksi'], $_GET['keyword']);
    $where = "WHERE nim LIKE '%$key%' OR nama LIKE '%$key%' OR kota LIKE '%$key%'";
}

$query = mysqli_query($koneksi, "SELECT * FROM mhs $where");

/* ================= BUAT PDF ================= */
$pdf = new PDF('L','mm','A4');
$pdf->AddPage();

/* ================= HEADER TABEL ================= */
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(255,182,193); // pink pastel
$pdf->SetTextColor(0);

$pdf->Cell(10,8,'No',1,0,'C',true);
$pdf->Cell(35,8,'NIM',1,0,'C',true);
$pdf->Cell(45,8,'Nama',1,0,'C',true);
$pdf->Cell(35,8,'Tempat Lahir',1,0,'C',true);
$pdf->Cell(35,8,'Tgl Lahir',1,0,'C',true);
$pdf->Cell(30,8,'Kota',1,0,'C',true);
$pdf->Cell(60,8,'Email',1,1,'C',true);

/* ================= ISI DATA ================= */
$pdf->SetFont('Arial','',10);
$no = 1;
$fill = false;

while ($row = mysqli_fetch_assoc($query)) {
    $pdf->SetFillColor(255,240,245); // pink sangat soft
    $pdf->Cell(10,8,$no++,1,0,'C',$fill);
    $pdf->Cell(35,8,$row['nim'],1,0,'C',$fill);
    $pdf->Cell(45,8,$row['nama'],1,0,'L',$fill);
    $pdf->Cell(35,8,$row['tempatLahir'],1,0,'L',$fill);
    $pdf->Cell(35,8,tglIndo($row['tanggalLahir']),1,0,'C',$fill);
    $pdf->Cell(30,8,$row['kota'],1,0,'C',$fill);
    $pdf->Cell(60,8,$row['email'],1,1,'L',$fill);
    $fill = !$fill;
}

$pdf->Output('I','Laporan_Data_Mahasiswa.pdf');
