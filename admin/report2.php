<?php
require_once("../tcpdf/tcpdf.php");
require_once("../functions/get-function.php");

$menus = getData("menus");
$categories = getData("categories");

$today = date("F");

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

$html = `
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
</head>

<body class=">
    <div class="">
        <div class="">
            <p class="">
                <span class="">a</span>
            </p>
            <p class="" style="width:6.25%">
                <span class="">a</span>
            </p>
            <p class="" style="width:12.5%">
                <span class="">a</span>
            </p>
            <p class="" style="width:25%">
                <span class="">a</span>
            </p>
        </div>
        <h1 class="" style="font-weight: 500;">Report Memu & Categories</h1>
        <div class="">
            <div class="">
                <h2 class="">Menu</h2>
                <table class="">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody> `;

//* Tambahkan element yang menampung data menu;
foreach ($menus as $index => $menu) {
    $html .= "
    <tr>
    <td>" . $index + 1 . "</td>
    <td>" . $menu["name"] . "</td>
    <td>Rp. " . $menu["price"] . "</td>
    </tr>
    ";
}

$html .= '
     </tbody>
                </table>
            </div>
            <div class="">
                <h2 class="">Categories</h2>
                <table class="">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
    ';

//* Tambahkan element yang menampung data categories;
foreach ($categories as $index => $cate) {
    $html .= "
    <tr>
        <td>" . $index + 1 . "</td>
        <td>" . $cate["name"] . "</td>
    </tr>
    ";
}

$html .= "      </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>";



//* Write pdf
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output("Report bulan" . $today);


echo "PDF berhasil dibuat";
