
<?php
header('Content-Type: text/plain; charset=UTF-8');
include_once("../Assets/fpdf/fpdf.php");

class PDF extends FPDF
{
function Header()
{
    // Logo
    $this->Image('../Assets/img/logo.png',10,6,30);
    
    $this->SetFont('Arial','I',11);
    $this->Cell(25,0,"",0,1);
    $this->Cell(20,25,'MF: 1442681C/MN000 ',0,0,'L');
    $this->Cell(50,0,"",0,1);
    $this->Cell(20,35,'RC: D0347472016 ',0,0,'L');
    $this->Cell(50,0,"",0,1);
    $this->Cell(20,45,'MOB: +21623562228 ',0,0,'L');
    $this->Cell(120);
    
    $this->Cell(25,10,'Date:',0,0,'R');
    $this->SetFont('Arial','B',10);
    $this->Cell(25,10,$_GET["order_date"],0,0,'R');

    $this->SetY(55);
    // Arial bold 15
    $this->SetFont('Times','B',20);
    // Move to the right
    $this->Cell(80);

    // Title
    $this->Cell(30,10,'FACTURE Num: '.$_GET["invoice_no"],0,0,'C');
    $this->Line(20, 45, 210-20, 45);
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

}
// Instanciation of inherited class
if($_GET["order_date"] && $_GET["invoice_no"])
{
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',14);
$pdf->SetY(100);
$pdf->Cell(20);
$pdf->Cell(20,10,'Client : ',0,0,'L');
$pdf->SetFont('Times','I',12);
$pdf->Cell(5,10,$_GET['cust_name'],0,0,'L');

$pdf->Cell(120,10,"",0,1);
$pdf->SetFont('Times','B',14);

$pdf->Cell(10,10,"#",1,0,"C");
$pdf->Cell(70,10,"Product name",1,0,"C");
$pdf->Cell(30,10,"Quantity",1,0,"C");
$pdf->Cell(40,10,"Price",1,0,"C");
$pdf->Cell(40,10,"Total HT (dt)",1,1,"C");

for($i=0; $i < count((array)$_GET["pname"]); $i++)
{
    $pdf->Cell(10,10,($i+1),1,0,"C");
    $pdf->Cell(70,10,$_GET["pro_name"][$i],1,0,"C");
    $pdf->Cell(30,10,$_GET["qty"][$i],1,0,"C");
    $pdf->Cell(40,10,$_GET["price"][$i],1,0,"C");
    $pdf->Cell(40,10,$_GET["qty"][$i] * $_GET["price"][$i], 1,1,"C");
}
$pdf->Cell(50,10,"",0,1);
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,10,"Total HT:", 0,0);
$pdf->SetFont('Times','I',12);
$pdf->Cell(50,10,$_GET["total_ht"],0,1);
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,10,"Timbre fiscal:",0,0);
$pdf->SetFont('Times','I',12);
$pdf->Cell(50,10,$_GET["tva"],0,1);
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,10,"Remise :",0,0);
$pdf->SetFont('Times','I',12);
$pdf->Cell(50,10,$_GET["remise"],0,1);
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,10,"Total TTC:",0,0);
$pdf->SetFont('Times','I',12);
$pdf->Cell(50,10,$_GET["ttc"].' dt',0,1);
$pdf->setY(200);
$pdf->Cell(180,10,'Cachet & signature',0,0,'R');


$pdf->Output("../PDF_INVOICE/PDF_INVOICE_".$_GET['invoice_no'].".pdf","F");
$pdf->Output();
}