<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
 }
use PDF as GlobalPDF;

require_once("Datos/Conexion.php");
require('fpdf/fpdf.php');
require('ExpoPDF.php');

//$email = $_SESSION["log"]["email"];
class PDF extends FPDF
{
    function Header()
    {


        $this->image('imagenes/logoWCL.png',5,5,30);
        $this->SetFont('Arial','B',12);
        $this->Cell(30);

        $this-> Cell(120,10,'Factura de Compra',0,0,'C');

        $this->Ln(50);

        $this->Cell(39,10,'Codigo Producto',1,0,'C',0);
        $this->Cell(39,10,'Producto',1,0,'C',0);
        $this->Cell(39,10,'Cantidad',1,0,'C',0);
        $this->Cell(39,10,'Precio',1,0,'C',0);
        $this->Cell(39,10,'Subtotal',1,1,'C',0);

    }
    

}
$factura = new FacturaPDF();

$pdf = new PDF();
$fila = FacturaPDF::Exportar_PDF();


$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$textypos = 5;

foreach ($fila as $r) {
  

    $pdf->Cell(39,10,str_pad((int)$r['Codigo_Producto'],4,"0",STR_PAD_LEFT),1,0,'C',0);

    $pdf->Cell(39,10,$r['Producto'],1,0,'C',0);
    $pdf->Cell(39,10,$r['Cantidad'],1,0,'C',0);
    $pdf->Cell(39,10,"$".number_format($r['Precio'],2),1,0,'R',0);
    $pdf->Cell(39,10,"$".number_format($r['Subtotal'],2),1,1,'R',0);
 
}
$pdf->setX(127);
$pdf->Cell(39,10,"Total Neto",1,0,'C',0);
$pdf->setX(166);
$pdf->Cell(39,10,"$".number_format($r['Total_Neto'],2),1,1,'R',0);
$pdf->setY(10);
$pdf->setX(35);
$pdf->SetFont('Arial','B',10); 
// Agregamos los datos de la empresa
$pdf->Cell(5,$textypos,"Indumentaria WCL");
   
$pdf->SetFont('Arial','B',10);  
$pdf->setY(10);$pdf->setX(140);
$pdf->Cell(5,$textypos,"Telefono: 0800-123-456");
$pdf->SetFont('Arial','B',10);  
$pdf->setY(6);$pdf->setX(140);
$pdf->Cell(5,$textypos,"Email: WCLIndumentaria@gmail.com");

// ---------------------------------------------------------------
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(160);
$pdf->Cell(5,$textypos,"FACTURA:".str_pad((int)$r['CodigoFactura'],8,"0",STR_PAD_LEFT));
$nrofact = str_pad((int)$r['CodigoFactura'],8,"0",STR_PAD_LEFT);
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(10);
$pdf->Cell(5,$textypos,"PARA:");
$pdf->SetFont('Arial','B',10);    
$pdf->setY(35);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Nombre: ".$r['Nombre']);
$pdf->SetFont('Arial','B',10); 
$pdf->setY(40);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Usuario: ".$r['Usuario']);
$pdf->SetFont('Arial','B',10); 
$pdf->setY(45);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Fecha de Compra: ".$r['Fecha']);
$pdf->SetFont('Arial','B',10); 
$pdf->setY(50);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Email del cliente: ".$r['Correo']);



$pdf->Output('factura'.$nrofact.'.pdf', 'I');


?>