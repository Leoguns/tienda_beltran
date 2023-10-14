<?php
require("fpdf/fpdf.php");


if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
  
  require("pruebaConsultas.php");
  
  $fila2=pruebaConsulta::lista_prueba();
  
  // Archivo principal de tcpdf
  require_once('./vendor/tcpdf.php');


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    //$this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(20);
    // Título
    $this->Cell(30,10,'Factura',1,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF();

$pdf->AddPage();

$pdf->SetFont('Arial','B',15);
//utf8_decode
$pdf->Cell(30,10,'Ventas',1,0,'C');
$pdf->OutPut();

