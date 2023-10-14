<?php 

require_once("Datos/Conexion.php");
require('Exel.php');

$exportar  = new Exportar();
$filados = Exportar::exportarConst();


    $filename = "Ventas.xls";


    header("content-type:application/vnd.ms-excel");
    header("content-disposition: attachment; filename= $filename ");
    header("pragma: no-cache");
    header("expires: 0");
    //echo $salida;
?>



<div class="table-responsive">

				
				<tr class="tablat">
		<table class="table table-hover table-condensed table-bordered table-fixed" id="iddatatable">
			<thead>
		
					
				

          		<th>Nombre</th>
          		<th>Cantidad</th>
          		<th>Recaudado<th>
								    
					<th>--</th>
				</tr>
			</thead>
			<tbody >
				
					
			<?php
					foreach ($filados as $pr) { ?>
					<tr>
             
            		<td><?php echo $pr["nombre"]; ?></td>
             		<td><?php echo $pr["cantidad"]; ?></td>
              		<td><?php echo $pr["recaudado"]; ?></td>
          			</tr>
								
							</td>
						</tr> 
					<?php 
						}
				?>

        </tbody>
		</table>
	</div>
</section>