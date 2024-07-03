<?php
require_once("../TCPDF/tcpdf.php");
require_once("../functions/get-function.php");

$thisMonth = date("F");

//* instance of TCPDF
$pdf = new TCPDF();

//* Document info

$pdf->setCreator("Neo Coffe");
$pdf->setAuthor("Neo Coffee Official Admin");
$pdf->setTitle("Report Bulanan");
$pdf->setSubject("Report Bulan $thisMonth");
$pdf->setKeywords("neo coffee, report, montly, annual");


//* Set Margin

$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

//* Auto page break
$pdf->setAutoPageBreak(true, PDF_MARGIN_BOTTOM);

//* add page
$pdf->AddPage();

$html = '
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Neo Coffee</title>
    <style>
    
    @media print {
        *{
            print-color-adjust: exact;
        }
    }

    table {
        
        border-collapse: collapse;
    }

    td,th {
        border-bottom:1px solid black;
        padding: 1rem;
    }

    .grid {
        display: grid;
    }
        
    </style>
</head>

<body>
    <div class="">
        <h1 class="" style="font-weight: 500;">Report Menu & Categories</h1>
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
                    <tbody>                               
';

$menus = getData("menus");

foreach($menus as $index => $menu){
    $index++;
    $html .= '  <tr>
                    <td>'. $index .'</td>
                    <td>'. $menu["name"] .'</td>
                    <td>Rp. '. number_format($menu["price"] ).'</td>
                </tr>';
} 

//* Middle code
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

$categories = getData("categories");
foreach($categories as $index => $category){
    $html .= '  <tr>
                    <td> ' .$index + 1 .' </td>
                    <td> ' .$category["name"] .'</td>
            </tr> ';
}



//* Footer html
$html .= '          </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>';

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output("Report Bulan $thisMonth", "I");

echo "Berahasil buat pdf";
