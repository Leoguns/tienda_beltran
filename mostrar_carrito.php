<?php
require("templates/head.php");
require("templates/header.php");

?>
<div class="listadop container">
	<br>
	<h3>Lista del carrito</h3>

	<?php if (!empty($_SESSION['CARRITO'])) { ?>

		<!--<p><?php echo json_encode($_SESSION['CARRITO']); ?></p>-->
		<table class="table table-hover table-condensed table-bordered table-fixed">
			<tbody>
				<tr>
					<th width="40%">Nombre</th>
					<th width="15%" class="text-center">Cantidad</th>
					<th width="20%" class="text-center">Precio </th>
					<th width="20%" class="text-center">Subtotal</th>
					<th width="5%">--</th>
				</tr>

				<?php $total = 0; ?>

				<?php foreach ($_SESSION['CARRITO'] as $indice => $producto) { ?>


					<?php $id_producto = $producto['id_producto']; ?>

					<tr class="js-productos">
						<th width="40%"><?php echo $producto['nombre'] ?></th>

						<th  width="15%">
							<input 
								type="number" 
								min="1" 
								max="10" 
								size="5"
								step="1"
								class="js-cantidad cantidad" 
								data-stock="<?php echo $producto['stock']; ?>" 
								data-id="<?php echo $producto['id_producto']; ?>" 
								value="<?php echo $producto['cantidad']; ?>"
							/>
						</th>
						<input class="stock" type="hidden" value="<?php echo $producto['stock']; ?>" />
						<input type="hidden" class="id_producto" value="<?php echo $producto['id_producto']; ?>" />
						<th width="20%" class="text-center precio" id="precio_<?php echo $id_producto; ?>"><?php echo $producto['precio'] ?></th>

						<th width="20%" class="subtotal" id="subtotal_<?php echo $id_producto; ?>">$ <?php $sub = $producto['precio'] * $producto['cantidad'];
																									echo number_format($sub, 2) ?></th>
						<th width="5%">

							<form action="" method="post">
								<input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
								<button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar" id="send-btn">Eliminar</button>
							</form>


						</th>

					</tr>

					<?php $total = $total + $sub; ?>

				<?php } //endfor 
				?>
				<tr>
					<td colspan="3" class="text-right">
						<h3>Total</h3>
					</td>
					<td class="text-right" >
						<h3 id="total">$<?php echo ($total); ?></h3>
					</td>

				</tr>

				<tr>

					<td colspan="5">

						<div class="row">

							<div class="col-md-6">

								<form action="" method="post">
									<input type="hidden" name="session" value="session">
									<button class="btn btn-warning btn-lg btn-block" type="submit" name="btnAccion" value="VaciarCarrito">VaciarCarrito>></button>
								</form>
							</div>



							<div class="col-md-6">

								<form action="pagar.php" name="formularioPagar" method="post" class="formularioPagar">

									<button class="btn btn-primary btn-lg btn-block" type="submit" name="btnAccion" value="proceder">
										Proceder a pagar >>
										<!-- <a href="pdf.php" target="__blank"></a>  -->
									</button>

									<!-- <input type=button class="btn btn-primary btn-lg btn-block" onclick="pregunta()" value="Proceder a pagar >>"> -->

								</form>


							</div> <!--col-->
						</div> <!--row-->

						<br>

						<div class="alert alert-success">

							<small id="emailHelp" class="form-text text-muted">
								Los productos se enviaran a este correo
								<?php if (isset($_SESSION["log"])) { ?>
									<h4><?php echo $_SESSION["log"]["correo"]; ?></h4>
								<?php } else { ?>
									<h4><?php echo "No hay ningun usuario logueado"; ?></h4>
								<?php } ?>
							</small>
						</div>

					</td>

				</tr>
			</tbody>
		</table>

	<?php } else { ?>

		<div class="alert alert-success">
			No hay productos en el carrito...
		</div>

	<?php } //empty session
	?>
</div>

<script src="js/alertaPagar.js"></script>
<script src="js/actualizarCarrito.js"></script>


<script>

	function formatMoney(amount) {
		const formatter = new Intl.NumberFormat('es-AR', {
			style: 'currency',
			currency: 'ARS'
		});

		return formatter.format(amount);
	}

	function updateCart() {
		// Obtener todos los productos
		const productos = $('.js-productos')
		const data = {};

		productos.each( (index, producto) => {
			let id_producto = $(producto).children('input.id_producto').val()
			let cantidad =  $(producto).children().children('input.cantidad').val()

			data[id_producto] = cantidad;
		});

		$.ajax({
			type: "POST",
			url: "carrito.php",
			data: { btnAccion: 'Actualizar', items: data },
		    dataType: "json",
		}).done(function (response) {
			Object.keys(response.items).forEach((productId) => {
				$('#subtotal_'+productId).html(formatMoney(response.items[productId]));
			});

			$('#total').html(formatMoney(response.total));

            console.log("respuesta", respuesta);
			//console.log("respuesta", respuesta);
			// if(respuesta.error) {
			// 	toastr.warning(respuesta.message)
			// } else {
			// 	toastr.success(respuesta.message)
			// }
		}).fail(function (err) {

			console.log("fail", err)

		})

	
	}

	$(document).ready(function() {
		console.log("Ready!")
		$(".js-cantidad").change(function() {
			updateCart();
		});

	});

	$('.formularioPagar').submit(function(e) {
		e.preventDefault();

		Swal.fire({
			title: 'DESEA CONFIRMAR LA COMPRA?',
			text: "PAGAR CON MERCADOPAGO",
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


<?php require("templates/footer.php"); ?>