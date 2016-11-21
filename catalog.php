<<?php //Created By Adam Hussain ?>

<?php
require_once('tcpdf\tcpdf.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Search Results', 'Home Catalog', array(5,167,228), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->AddPage();
$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'catalog';
$conn = new mysqli($server,$user,$pass,$db);
// Check connection

$html = "";


if($conn->connect_error)
  die("Unable to connect");
$htmltext = "";
if(isset($_GET['Name']))
{
    $v1 = $_GET['Name'];
    $query = "SELECT * FROM `home` WHERE `Name` LIKE '%$v1%';";
    $result = $conn->query($query);
    $html = "<table style=\"width:100%\"><tr> <th>Name</th> <th>Type</th> </tr>";
    //$row = $result->fetch_assoc();
    while($row = $result->fetch_assoc())
    {
      $html .= "<tr><td>" .$row["Name"]."</td>" . "<td>" . $row["Type"] . "</td></tr>";
    }
    $html .= "</table>";


}

$pdf->writeHTML($html, true, false, true, false, '');

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->Output($_GET['Name']+'.pdf', 'I');

?>
