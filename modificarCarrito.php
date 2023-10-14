<?php 
	session_start();
  // if(isset($_POST['action'])){
	// 		$arreglo=$_SESSION['CARRITO'];
	// 		$total=0;
	// 		$numero=0;
	// 		for($i=0;$i<count($arreglo);$i++){
	// 			if($arreglo[$i]['id_producto']==$_POST['Id']){
	// 				$numero=$i;
	// 			}
	// 		}
	// 		$arreglo[$numero]['cantidad']=$_POST['Cantidad'];
	// 		for($i=0;$i<count($arreglo);$i++){
	// 			$total=($arreglo[$i]['precio']*$arreglo[$i]['cantidad'])+$total;
	// 		}
	// 		$_SESSION['CARRITO']=$arreglo;

	// 		echo $total;

  //   }

  if(isset($_POST)){
    
    echo 'existepost';
  }

  if(isset($_POST['action'])){
    echo 'existepost';
    $action = $_POST['action'];
    $id_producto = isset($_POST['id_producto']) ? $_POST['id_producto'] : 0;

    if($action == 'agregar'){
      
      $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
      }
    } 
    ?> 

    <!-- function agregar($id_producto, $cantidad){

      $res = 0;

      if($id_producto > 0 && $cantidad > 0 && is_numeric(($cantidad)))
      {
        if(isset($_SESSION['CARRITO'][$id_producto])){
          $_SESSION['CARRITO']['cantidad'] = $cantidad;
        }
      }
    } --> 


?>