<?php 


require("templates/head.php");
require("templates/header.php");
require_once("Controladores/ProductoControlador.php");
require_once("Controladores/CategoriaControlador.php");


if(!isset($_POST['id'])){

    $_SESSION["message"]="No existe producto seleccionado"; 
                 
                 //header("location:login.php"); ?>
                 <script text=javascript> location.href = 'index.php';</script>

<?php  }else{

$id = $_POST['id'];

$prod=ProductoControlador::get_prod_id($id);

?>	
                <section class="listadop container">
          
          <br>

          <div class= "row">
        <div class= "col-mx-6 mx-auto">
          
         
                <div class="card">
                        <div class="card-header">¿Desea inhabilitar producto?</div>
                        <div class="card-body text-center">
                                <div class="card-text">
                                        <p><?php echo $prod->getNombre() ?></p>

                                         <p class="contenedor tamano-1">
                                        <img src="imagenes/<?php echo $prod->getImagen();?>">
                                       </p>
                                        

                                         <p>Categoria:<?php echo $prod->getId_categoria() ?></p>

                                        <p>Marca:<?php echo $prod->getId_marca() ?></p>          
                 
                                                                                
                                      
                                        <form method="POST" action="abm.php">
                                                <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span>Inhabilitar</button> 
                                                <input type="hidden" name="accion" value="3">
                                                <input type="hidden" name="id" value="<?php echo $prod->getId_producto(); ?>">

                                                
                                                <a href="abm.php" class="btn btn-primary"><i class="fa fa-reply"></i> Volver</a>
                                        </form>
                                </div>
                                <!-- card text -->
                        </div>
                        <!-- text center -->
                </div>
                <!-- card -->

                </div> <!-- /col-md-6 -->
	</div> 	<!-- row -->
	<br>
                </section>

            <?php } ?>
<?php require ("templates/footer.php") ?>



Leonel Farias <fariasrodrigoleonel@gmail.com>
22:22 (hace 0 minutos)
para mí

<?php

include "./conexion.php";

//se valida que los valores recibidos sean los correcto del ID del usuario a eliminar 
//tambien pedimos los datos del mismo para poder mostrar al usuario y lograr validar la eliminacion de forma correcta

if(!empty($_POST)){
  //se recibe el valor del id del cual se quiere borrar
$idUsuario=$_POST['idUsuario'];

//la consulta de abajo nos permite poder eliminar un registro,en el proyecto no lo vamos a utilizar,ya que no se desea eliminar el registro historico del usuario sino, que modificar como activo o inactivo 
    //$query_eliminar=mysqli_query($conexion,"DELETE FROM usuarios WHERE idUsuarios=$idUsuario");

    // con esta consulta no eliminamos al usuario sino que cambiamos el estado del usuario, considerando que si el estado=1 mostrarlo y si no lo es, no mostrarlo

    $query_eliminar=mysqli_query($conexion,"UPDATE usuarios SET estado=0 WHERE idUsuarios=$idUsuario");


    if($query_eliminar){
      //si se borra , el administrador es devuelto a la pagina del listado 
    header('location:listaUsuarios.php');
    }else{
      //sino tira un error con una frase
    echo "Error al Eliminar el usuario";
      }
  


if(!empty($_REQUEST['idUsuario'])){
  
    $idUsuario=$_REQUEST['idUsuario'];
  
    $query=mysqli_query($conexion,"SELECT u.nombre,u.apellido,u.email
                                    FROM usuarios u
                                    WHERE u.idUsuarios=$idUsuario");
  
    $resultado=mysqli_num_rows($query);
  
    }//request
}//post

?>
<!----modal desactivar-------->
<div class="modal fade" id="desactivarUsuarioModal" tabindex="-1" aria-labelledby="desactivarUsuarioModallLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="desactivarUsuarioModalLabel">Desactivar usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="container">
            <p class="titulo-formulario">¿Esta seguro que desea desactivar la cuenta del usuario?</p>
           <?php if($resultado>0){
        while($data=mysqli_fetch_array($query)){
            $nombre=$data['nombre'];
            $apellido=$data['apellido'];
            $email=$data['email']; ?>
        
            <p>Nombre:<span name="nombre" id="nombre"><?php echo $nombre;?></span></p>
            <p>Apellido:<span name="apellido" id="apellido"><?php echo $apellido;?></span></p>
            <p>Email:<span name="email" id="email"><?php echo $email;?></span></p>
          </div>
        <?php } //endwhile
        else{echo "no se pudo mostrar";} //end if ?>

          <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <div class="col-lg-12">
              <input type="hidden" id="idUsuario" name="idUsuario">
              <input type="hidden" id="nombre" name="nombre">
              <input type="hidden" id="apellido" name="apellido">
              <input type="hidden" id="email" name="email">
            </div>
          </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </form>
      </div>
      </div>
    </div>
  </div>
</div>

