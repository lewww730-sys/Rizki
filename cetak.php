<?php
ob_start();
require('fpdf.php');
include 'konek1.php';

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_GET['nis'])) {
    die('NIS tidak ditemukan');
}

$nis = $_GET['nis'];

$qSiswa = mysqli_query($koneksiRizkiArdiansyah,"
    SELECT 
        siswa_rizki.nama,
        kelas_rizki.nama_kelas
    FROM siswa_rizki
    JOIN kelas_rizki 
        ON siswa_rizki.id_kelas = kelas_rizki.id_kelas
    WHERE siswa_rizki.nis = '$nis'
");

$siswa = mysqli_fetch_assoc($qSiswa);
if (!$siswa) {
    die('Data siswa tidak ditemukan');
}

$nama  = $siswa['nama'];
$kelas = $siswa['nama_kelas'];


$qNilai = mysqli_query($koneksiRizkiArdiansyah,"
    SELECT 
        nilai_rizki.nilai_tugas,
        nilai_rizki.nilai_uts,
        nilai_rizki.nilai_uas,
        mapel_rizki.nama_mapel
    FROM nilai_rizki
    JOIN mapel_rizki 
        ON nilai_rizki.id_mapel = mapel_rizki.id_mapel
    WHERE nilai_rizki.nis = '$nis'
    ORDER BY mapel_rizki.nama_mapel ASC
");

$qAbsensi = mysqli_query($koneksiRizkiArdiansyah,"
    SELECT sakit, izin, alfa
    FROM absensi_rizki
    WHERE nis = '$nis'
");

$absen = mysqli_fetch_assoc($qAbsensi);

$sakit = $absen['sakit'] ?? 0;
$izin  = $absen['izin'] ?? 0;
$alfa  = $absen['alfa'] ?? 0;


$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();


$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'RAPOR PESERTA DIDIK',0,1,'C');
$pdf->Ln(5);


$pdf->SetFont('Arial','',11);
$pdf->Cell(40,8,'Nama',0,0);
$pdf->Cell(5,8,':',0,0);
$pdf->Cell(100,8,$nama,0,1);

$pdf->Cell(40,8,'Kelas',0,0);
$pdf->Cell(5,8,':',0,0);
$pdf->Cell(100,8,$kelas,0,1);

$pdf->Cell(40,8,'NIS',0,0);
$pdf->Cell(5,8,':',0,0);
$pdf->Cell(100,8,$nis,0,1);

$pdf->Ln(5);


$pdf->SetFont('Arial','B',10);
$pdf->Cell(45,8,'Mata Pelajaran',1,0,'C');
$pdf->Cell(75,8,'Keterangan',1,0,'C');
$pdf->Cell(25,8,'Nilai',1,1,'C');

$pdf->SetFont('Arial','',10);
while ($n = mysqli_fetch_assoc($qNilai)) {

    $rata = ($n['nilai_tugas'] + $n['nilai_uts'] + $n['nilai_uas']) / 3;

    if ($rata >= 88) {
        $ket = "Sangat Baik Terus Tingkatkan";
    } elseif ($rata >= 75) {
        $ket = "Cukup Baik Semangat Terus Yaa";
    } else {
        $ket = "Sangat Kurang Tingkatkan Lagi Yaa";
    }

    $pdf->Cell(45,8,$n['nama_mapel'],1,0);
    $pdf->Cell(75,8,$ket,1,0);
    $pdf->Cell(25,8,number_format($rata,1),1,1,'C');
}

$pdf->Ln(8);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,8,'Kehadiran',0,1);

$pdf->Cell(40,8,'Keterangan',1,0,'C');
$pdf->Cell(40,8,'Jumlah (Hari)',1,1,'C');

$pdf->SetFont('Arial','',10);
$pdf->Cell(40,8,'Sakit',1,0);
$pdf->Cell(40,8,$sakit,1,1,'C');

$pdf->Cell(40,8,'Izin',1,0);
$pdf->Cell(40,8,$izin,1,1,'C');

$pdf->Cell(40,8,'Alfa',1,0);
$pdf->Cell(40,8,$alfa,1,1,'C');

$pdf->Ln(10);
$pdf->Cell(0,8,'Wali Kelas',0,1,'R');
$pdf->Ln(15);
$pdf->Cell(0,8,'( ____________________ )',0,1,'R');

ob_end_clean();
$pdf->Output('I','Rapor_'.$nis.'_'.time().'.pdf');
?>
