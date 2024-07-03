<?php
// Sertakan file TCPDF utama
require_once('../tcpdf/tcpdf.php');

// include "./config/connection.php";
// include "./functions/session.php";


// Buat instance dari TCPDF
$pdf = new TCPDF();

// Atur informasi dokumen
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nama Penulis');
$pdf->SetTitle('Judul PDF');
$pdf->SetSubject('Subjek PDF');
$pdf->SetKeywords('Kata Kunci, PDF, Contoh');

// Atur margin halaman
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Atur otomatis page break
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Tambahkan halaman baru
$pdf->AddPage();

$test = "asdasd";

// Konten HTML yang ingin Anda konversi ke PDF
$html = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>PDF Example</title>
</head>
<body>
    <h1>Contoh PDF dari PHP</h1>
    <p>Ini adalah contoh teks yang akan diubah menjadi PDF menggunakan TCPDF.</p>
    <table>
    <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Alamat</th>
    </tr>
    </thead>
    <tbody>
    ";
   $html .=  "
      </tbody>
  </table>
</body>
</html>
";

// Tulis konten HTML ke PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Tutup dan output PDF
$pdf->Output('example.pdf', 'I');

echo "PDF berhasil dibuat!";