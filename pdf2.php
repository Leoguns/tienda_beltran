<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

require("pruebaConsultas.php");

$fila2=pruebaConsulta::lista_prueba();

// Archivo principal de tcpdf
require_once('./vendor/tcpdf.php');


// Crear el documento PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Establecer Mmargenes
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// Salto de pagina automaticos
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// Factor de escalado de imagenes
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// Fuente general
$pdf->SetFont('dejavusans', '', 10);

// Setear la informacion del documento
$pdf->SetCreator('INDUMENTARIA DEPORTIVA'); //ACA IRIA EL NOMBRE DE SU EMPRESA
$pdf->SetAuthor('WCL'); // ACA IRIA EL NOMBRE DE SU EMPRESA
$pdf->SetTitle('FACTURA'); //EL nombre que le quieran dar de titulo

// SETEAR EL ENCABEZADO
//IMPORTANTE
//LO UNICO QUE HAY QUE CAMBIAR ACA ES EL STRING DE LA IMAGEN
//PERO LA IMAGEN NO SE PUEDE PONER EN CUALQUIER LADO
//LA IMAGEN VA EN LA CARPETA Vendor/examples/images
//DESPUES SIMPLEMENT PONEN EL NOMBRE DE LA IMAGEN Y LA EXTENSION

$pdf->SetHeaderData('logoWCL.png', PDF_HEADER_LOGO_WIDTH, 'INDUMENTARIA DEPORTIVA', 'WCL');

// Agregar una pagina
$pdf->AddPage();

// String html
// EL CSS LO TIENEN QUE PONER EN LINEA MEDIANTE EL ATRIBUTO STYLE

// $productos = array(
//   (object) [
//     'nombre' => 'title 1',
//     'precio' => 'green'
//   ],
//   (object) [
//     'nombre' => 'title 2',
//     'precio' => 'yellow'
//    ],
  
// );
// $productosPrueba = $productos[1]->color
// <p>Av. Winston Churchill</p>
//     <p>Plaza Orleans 3er. nivel</p>
//     <p>local 312</p>
// <div class="row my-5">
//   <table class="table table-borderless factura">
//     <thead>
//       <tr>
//         <th>Cant.</th>
//         <th>Descripcion</th>
//         <th>Precio Unitario</th>
//         <th>Importe</th>
//       </tr>
//     </thead>
//     <tbody>
//       <tr>
//         <td>1</td>
//         <td>Clases de Cha-Cha-Cha</td>
//         <td>3,000.00</td>
//         <td>3,000.00</td>
//       </tr>
//       <tr>
//         <td>3</td>
//         <td>Clases de Salsa</td>
//         <td>4,000.00</td>
//         <td>12,000.00</td>
//       </tr>
//     </tbody>
//     <tfoot>
//       <tr>
//         <th></th>
//         <th></th>
//         <th>Total Factura</th>
//         <th>RD$15,000.00</th>
//       </tr>
//     </tfoot>
//   </table>
// </div>




// <div class="cond row">
//   <div class="col-12 mt-3">
//     <h4>Condiciones y formas de pago</h4>
//     <p>El pago se debe realizar en un plazo de 15 dias.</p>
//     <p>
//       Banco Banreserva
//       <br />
//       IBAN: DO XX 0075 XXXX XX XX XXXX XXXX
//       <br />
//       Código SWIFT: BPDODOSXXXX
//     </p>
//   </div>
// </div>
// </div>
// <div class="col-3">
// <h5>Facturar a</h5>
// <p>
//   Arian Manuel Garcia Reynoso
// </p>
// </div>
// <div class="col-3">
// <h5>Enviar a</h5>
// <p>
//   Cotui, Sanchez Ramirez
//   Santa Fe, #19
//   arianmanuel75@gmail.com
// </p>
// </div>
// <div class="col-3">
// <h5>N° de factura</h5>
// <h5>Fecha</h5>
// <h5>Fecha de vencimiento</h5>
// </div>
// <div class="col-3">
// <h5>103</h5>
// <p>09/05/2019</p>
// <p>09/05/2019</p>
// </div>;


$html =  '</div><div id="app" class="col-11">

<h2>Factura</h2>

<div class="row my-3">
  <div class="col-4">
    <h1>Cliente</h1>';
    
    '</div>';

$producto = '<table border="2" class="table table-borderless factura">    
<thead>
<tr>
  <th>Cantidad</th>
  <th>Descripcion</th>
  <th>Precio Unitario</th>
  <th>Importe</th>
</tr>
</thead>';
$total=0;
foreach ($fila2 as $p){
  $nombre= $p[3];
  $subtotal=$p[6]*$p[5];
  
  $producto.= "
    
    <tbody>
      <tr>
        <td>$p[5]</td>
        <td>$p[4]</td>
        <td>$p[6]</td>
        <td>$subtotal</td>
      </tr>
 ";
                 $total=$total+$subtotal;
                }
$producto.=" <tfoot>
<tr>
  <th></th>
  <th></th>
  <th>Total Factura</th>
  <th>$total</th>
</tr>
</tfoot>
</table>";

$html.=$producto;

$html.='<hr />

<div class="row fact-info mt-3">

<h5>Facturar a</h5>
<p>';  

$producto=$nombre;

$html.=$producto;

$html.="</p>
</div>";


// TRANSFORMAR EL HTML A PDF
$pdf->writeHTML($html, true, false, true, false, '');
//INDICAR LA ULTIMA PAGINA
$pdf->lastPage();
//MOSTRAR EL ARCHIVO PDF PARA DESCARGAR
$pdf->Output('factura.pdf', 'I');
