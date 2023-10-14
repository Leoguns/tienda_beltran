<?php

require("funcion_arraycolumn.php");
require __DIR__ . './Datos/ProductosDao.php';
session_start();
$mensaje = "";


if (isset($_POST['btnAccion'])) {
  switch ($_POST['btnAccion']) {
    case 'Agregar':

      if (is_numeric($_POST['id_producto'])) {
        $ID = $_POST['id_producto'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $stock = $_POST['stock'];
      } else {
        $mensaje = "id de producto incorrecto " . $ID;
        break;
      }

      if (!isset($_SESSION['CARRITO'])) {

        $producto = array(
          'id_producto' => $ID,
          'nombre' => $nombre,
          'cantidad' => $cantidad,
          'precio' => $precio,
          'stock' => $stock,
        );
        $_SESSION['CARRITO'][0] = $producto;

        $mensaje = "Producto agregado al carrito";
      } else {

        $idProductos = array_column($_SESSION['CARRITO'], "id_producto");

        if (in_array($ID, $idProductos)) {
          echo " <script>
                toastr.warning('El producto ya fue seleccionado', 'Mensaje del carrito');
               </script>";
        } else {

          $NumeroProductos = count($_SESSION['CARRITO']);
          $producto = array(
            'id_producto' => $ID,
            'nombre' => $nombre,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'stock' => $stock,
          );


          $_SESSION['CARRITO'][$NumeroProductos] = $producto;
          $mensaje = "Producto agregado al carrito";
        }
      }

      break;

    case "Eliminar":

      if (is_numeric($_POST['id_producto'])) {
        $ID = $_POST['id_producto'];

        foreach ($_SESSION['CARRITO'] as $indice => $producto) {

          if ($producto['id_producto'] == $ID) {

            unset($_SESSION['CARRITO'][$indice]); ?>

            <script>
              toastr.warning("Producto borrado", "Mensaje");
            </script>

        <?php
          } //if
        } //foreach 

      } else {


        echo "<script>alert('Error al borrar...');</script>";
        break;
      }

      break;

    case "VaciarCarrito":

      if (isset($_POST['session'])) {


        unset($_SESSION['CARRITO']); ?>

        <script>
          toastr.warning("El carrito se vacio...", "Mensaje");
        </script>



        <?php } else {


        echo "<script>alert('Error al vaciar Carrito');</script>";
        break;
      }

      break;

      case "Actualizar":
               
        
        if(isset($_POST['items'])) {
          $items = $_POST['items'];
          
          $products = ProductosDao::listar_productos(array_keys($items));

          $data = [
            'items' => [],
            'total' => 0,
            'respuesta' => ''
          ];

          foreach ($items as $productId => $quantity) {
            $product = array_filter($products, function($product) use($productId) {
              return $product['id_producto'] == $productId;
            });

            // array_filter devuelve un array, como sabemos que 
            // contiene un solo elemento usamos reset() para 
            // quedarnos con el primero.
            
            $product = reset($product) ?? null;

            if (! $product) {
              http_response_code(400);
              echo json_encode(['message' => 'El producto no existe!']);
              exit;
            }

            if ($quantity > $product['stock']) {

              http_response_code(400);
              echo json_encode(['message' => 'No hay suficiente stock para el producto ' . $product['nombre'] . '.']);
              exit;
            }
            
             $_SESSION['CARRITO'][0]['cantidad']=$quantity;
            
            $data['items'][$productId] = $quantity * $product['precio'];

          }

          
          $data['total'] = array_sum(array_values($data['items']));
          $data['respuesta'] = "el carrito se actualizó";

          echo json_encode($data);
       
          exit;
        }

        break;

  //       if(is_numeric($_POST['id_producto'])){
    
          
  //   $ID = $_POST['id_producto'];
  //   $cantidad = $_POST['cantidad'];

  //   foreach ($_SESSION['CARRITO'] as $indice => $producto) {

  //   if($producto['id_producto']==$ID){

       
  //   $_SESSION['CARRITO'][$indice]['cantidad']=$cantidad;
     
  //     ?>
        
  //  <script>
  //       toastr.warning("El carrito se actualizó", "Mensaje");
  //      </script> 
        
     

  //  <?php //}//if
  //  }//foreach
  //   }else{ ?>
       
  //      <script>
  //       toastr.error("El carrito NO se actualizó", "Mensaje");
  //      </script> 
        
  //       <?php 
        
  //       break;} //numeric
                
  break; 


}//switch
}//if

?>