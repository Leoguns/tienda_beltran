<?php 
require("templates/head.php"); 
require("templates/header.php");
require_once("Controladores/CompraControlador.php"); 
require_once("Controladores/DetalleCompraControlador.php"); 

if(isset($_POST)){
	
   if(!isset($_SESSION['log'])){
    
    $_SESSION["message"]="Debe loguearse para comprar"; 
    //header("location:login.php"); ?>
    <script text=javascript> location.href = 'login.php';</script>
 
 <?php }else{
    $Monto=0; 
    $id_usuario = $_SESSION["log"]["id_usuario"];
	foreach ($_SESSION['CARRITO'] as $indice => $producto) {
		$Monto=$Monto + ($producto['precio']*$producto['cantidad']);
	} 
	
	$registro_id = CompraControlador::agregar_compra($id_usuario,$Monto);
  
  $id_compra=(int)$registro_id;

  $_SESSION['id_compra'] = $id_compra;

	foreach ($_SESSION['CARRITO'] as $indice => $producto) {


	  $id_producto = $producto['id_producto'];
    $precio_unitario = $producto['precio'];
    $cantidad = $producto['cantidad'];
    
   DetalleCompraControlador::agregar_detalleCompra($id_compra,$id_producto,$precio_unitario,$cantidad);
    DetalleCompraControlador::disminuir($id_producto,$cantidad);
     


	}
  
   
    unset($_SESSION['CARRITO']);
    //header("location:index.php");
     $_SESSION["message"]="Compra realizada"; ?>
      
     
     
     <?php } //else

}//post
  
?>

<script text=javascript> 
            var pagina = 'index.php';
             var segundos = 5;
             
             
            
             function redireccion() { document.location.href=pagina;}
            setTimeout("redireccion()",segundos*1000); 
            //location.href = 'index.php';</script>
  
  <div class="jumbotron container text-center">
  
  <script text=javascript>

     Swal.fire(
      'Compra exitosa',
      'Se descargara factura PDF.',
      'success'
    ).then((result) => {
  if (result.isConfirmed) {




    
    window.open('http://localhost/Repositorio/ExportaPDF.php', '_blank');
  }
})
   

</script>

  	<h1 class="display-4">¡Listo!</h1>
  	<hr class="my-4">
  	<p class="lead">Pagaste con MercadoPago la cantidad de:
      <h4> $<?php echo number_format($Monto,2);?> </h4>
    
	</p>
  	
  	<strong>Para aclaraciones: fariasrodrigoleonel@gmail.com</strong>
  </div>
   
 
<?php require("templates/footer.php") ?>