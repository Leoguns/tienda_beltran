<?php
require("fpdf/fpdf.php");
require("templates/head.php");
require("templates/header.php"); ?>

<?php require_once("Controladores/CompraControlador.php");
require_once("Controladores/ProductoControlador.php");


$fila=CompraControlador::mostrar_compras();

$filados=ProductoControlador::prod_mas_vendidos();
        $i = 1;
?>
<?php	if(isset($_POST["borrar"])){ 

$flag = true;
$id = $_POST['id'];

if($flag)
	{
		 CompraControlador::eliminar_comp($id); ?>
		 
		 <script text=javascript>
		 Swal.fire(
		  'SE HA BORRADO LA COMPRA',
		  'SE HA BORRADO LA COMPRA DEFINITIVAMENTE',
		  'success'
		) 
		</script>
	<?php }else{ ?>
		<script text=javascript>
		Swal.fire(
		 'NO SE PUDO BORRAR LA COMPRA',
		 'NO SE PUDO BORRAR LA COMPRA DEFINITIVAMENTE',
		 'success'
	   ) 
	   </script>
	<?php }
} ?>

<?php  if(isset($_SESSION["log"])){ ?>

<section class="productosabm tabla container">
  
<button id="abrirModal">Productos más vendidos</button>
  <!-- Ventana modal, por defecto no visiblel -->
  <div id="ventanaModal" class="modal">
    <div class="modal-content max" >
	    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span class="cerrar">CERRAR&times;</span>
		</button>
        <h2>Más vendidos</h2>  
		<div class = "row"> 
			<div class="col-6"><canvas id="miTorta"></canvas></div>

			<div class="col-6">
				<a href="plantilla.php"type="submit" class="btn btn-success" ><i class="fa fa-reset"></i>Exportar a Excel</a>
		    

	    
			<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered table-fixed">
			<thead>
				<th>Ranking</th>
				<th>Nombre</th>
				<th>Cantidad</th>
				<th>Recaudado<th>
			</thead>
			<tfoot>
				<th>Ranking</th>
				<th>Nombre</th>
				<th>Cantidad</th>
				<th>Recaudado<th>
			</tfoot>
			<tbody > <?php 
			foreach ($filados as $pr) { ?>
				
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $pr["nombre"]; ?></td>
					<td><?php echo $pr["cantidad"]; ?></td>
					<td><?php echo $pr["recaudado"]; ?></td>
				</tr>
				<?php $i++;
				}
				?>

				</tbody>
			</table>
	        </div> <!--table responsive-->
			</div>
			</div>

	</div>
  </div>


	<div class="table-responsive">
		<table class="table table-hover table-condensed table-bordered table-fixed" id="iddatatable">
			<thead>
				<tr class="tablat">
					
				    <th>Nro. Venta</th>
				    <th>Usuario</th>
					<th>Fecha</th>
					<th>Monto</th>
								    
					<!-- <th>--</th> -->
				</tr>
			</thead>
			<tfoot>
				<tr class="tablab">
                    
                    <th>Nro. Venta</th>
				    <th>Usuario</th>
					<th>Fecha</th>
					<th>Monto</th>

                    <!-- <th>--</th> -->
				</tr>
			</tfoot>
			<tbody >
				
					
			<?php
					foreach ($fila as $p) { ?>
						<tr>
							<td><?php echo $p["id_compra"] ?></td>
							<td><?php echo $p["nombre"] ?></td>
							<td><?php

							$fecha_estandar = $p["fecha"];
							$timestamp = strtotime($fecha_estandar);
                            $fecha_argentino = date('d/m/Y H:i:s', $timestamp);
                            
							echo $fecha_argentino; ?>

							</td>
							<td><?php echo $p["monto"] ?></td>
												
							<!-- <td>
														
							    
								<?php if ($_SESSION["log"]['id_tipo'] == '1'){ ?>
								<form method="POST" action="tablaVentas.php" name="formBorrarVenta" class="formBorrarVenta">
									<button class="btn btn-danger" type="submit" >
										<i class="fa fa-trash"></i>
									</button> 
									<input type="hidden" name="borrar" value="borrar">
									<input type="hidden" name="id" value="<?php echo $p['id_compra']; ?>">
								</form>
								<?php } ?>
								
							</td> -->
						</tr> 
					<?php 
						}
				?>

        </tbody>
		</table>
	</div>
	
</section>
<?php } else { 
	$_SESSION["message"]="Usted no esta logueado"; ?>
<script> location.href = 'index.php'</script>
<?php } ?>


<script>
    $(document).ready(function() {
        $('#iddatatable').DataTable();
    } );
</script>

<script type="text/javascript">
	// Ventana modal
var modal = document.getElementById("ventanaModal");

// Botón que abre el modal
var boton = document.getElementById("abrirModal");

// Hace referencia al elemento <span> que tiene la X que cierra la ventana
var span = document.getElementsByClassName("cerrar")[0];

// Cuando el usuario hace click en el botón, se abre la ventana
boton.addEventListener("click",function() {
  modal.style.display = "block";
});

// Si el usuario hace click en la x, la ventana se cierra
span.addEventListener("click",function() {
  modal.style.display = "none";
});

// Si el usuario hace click fuera de la ventana, se cierra.
window.addEventListener("click",function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
});
</script>

<script>
$('.formBorrarVenta').submit(function(e)
{
e.preventDefault();

Swal.fire({
title: 'DESEA BORRAR LA COMPRA?',
text: "SE BORRARA LA COMPRA ELEGIDA",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'CONFIRMAR'
}).then((result) => {
if (result.isConfirmed) {
	 this.submit();
	
}
})

})
</script>

<script>
  // Datos de ejemplo para el gráfico
  const datos = {
    labels: ['Abrigos', 'Pantalones', 'Remeras', 'Botines'],
    datasets: [{
      data: [30, 40, 10, 20],
      backgroundColor: ['red', 'blue', 'green', 'orange'],
    }],
  };

  // Configuración del gráfico
  const opciones = {
    responsive: true,
    maintainAspectRatio: false,
  };

  // Obtener el elemento canvas y crear el gráfico
  const miTorta = document.getElementById('miTorta').getContext('2d');
  new Chart(miTorta, {
    type: 'pie',
    data: datos,
    options: opciones,
  });
</script>

<?php require("templates/footer.php"); ?>