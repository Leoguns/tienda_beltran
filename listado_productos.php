<?php require("templates/head.php"); ?>
<?php require("templates/header.php");?>
<?php require_once("Controladores/ProductoControlador.php");?>


<section class="listadop container">

  <?php if($mensaje!=""){?>
  <div class="alert alert-success">
    
    <?php echo $mensaje; ?>

    <a href="mostrar_carrito.php" class="badge badge-success">Ver carrito</a>

  </div>  
  <?php }//mensaje ?>
          <?php 
            $items=3;
            if(!isset($_GET['page'])){
                $page = 1;
            }else{
                $page = $_GET['page'];
            }
            $start=($page-1)*$items;
            //$query="SELECT * FROM productos LIMIT $start,$items";

       

 if(isset($_GET['id'])){

  $id = $_GET['id'];

  $id_cast=(int)$id;
   
   $productos= ProductoControlador::get_catalogo($id_cast);
   $cantidad= count($productos);

?> 
    <div>
    <br>
    <input type="text" name="buscador" id="buscador" placeholder="Buscar..." class="text-center">
    <br> <br>
    
      <ul id="demo">
  
               <div class="row">

            <?php if($cantidad > 0){
              for($i = 0; $i < $cantidad; $i++){
                $prod = $productos[$i];
               ?>

     <div class="col-md-4 articulo">
           
     <div class="descripcion">
           <div class="card border-black">
            
           <div class="contenedor-img"><img src="imagenes/<?php echo $prod['imagen']; ?>" alt="" class="prod-img"></div>
            <div class="card-body">
            
            
            <p><h5 class="featurette-heading2"><?php echo $prod["nombre"];?></h5></p>         
            <P><h4 class="featurette-heading2"> Precio: $<?php echo $prod["precio"]; ?>
            </h4></p>
            <p class="featurette-heading2"> Marca: <?php echo $prod["Marca"];?> </p>
            <p class="featurette-heading2"> Talle: <?php echo $prod["talle"];?> </p>
            <p class="featurette-headind2"> Stock: <?php echo $prod["stock"];?> </p>
            
           
             <form action="" method="post">

               <input type="hidden" name="id_producto" id="id_producto" value="<?php echo $prod["id_producto"];?>">
               <input type="hidden" name="nombre" id="nombre" value="<?php echo $prod["nombre"];?>">
               <input type="hidden" name="precio" id="precio" value="<?php echo $prod["precio"];?>">
              <input type="hidden" name="cantidad" id="cantidad" value="<?php echo 1;?>">
              <input type="hidden" name="stock" id="stock" value="<?php echo $prod["stock"];?>">

<!--<p class="featurette-heading2"> Cantidad:
<input type="number" min="1" value="1" name="numero">
</p> -->
  <button 
  class="btn btn-success btn-block"
  name="btnAccion"        
  value="Agregar"
  type="submit">
Agregar al carrito
</button>

</form>

           <p class="featurette-heading2 oculta-descripcion"> Descripcion: <?php echo $prod["descripcion"];?> </p>
            </div>
            </div>

             
            
           </div>
           <br>
        </div>
         <br>
 <?php } //ENDFOR
  }else{
  echo "no hay registros";
   } //endif cantidad ?>

    </div> <!-- row  -->


 <?php }//endif ?>

</ul>
  </div>
<br>
 
        <nav class="page-ind">
            <?php
            //$sql="SELECT * FROM productos WHERE id_categoria = '$id'";
            
          //  $Result2=mysqli_query(conectar(),$sql);

          //$Result2 = ProductoControlador::get_catalogo($id);

            if (empty($Result2)){ 
                echo " ";
            } else {
                $Registered=mysqli_num_rows($Result2);
                $Pages=ceil($Registered/$items);?>
                <ul class="pagination justify-content-center">
                  
                  <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                      <a class='page-link' href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1)."&id=".$id; } ?>">Anterior</a>
                  </li>
                  <?php
                  for ($i=1; $i <= $Pages ; $i++) { 
                  echo "<li class='page-item'><a class='page-link' href='listado_productos.php?page=".$i."&id=".$id."'>".$i." </a></li>";
                  } ?>
                  <li class="page-item <?php if($page >= $Pages){ echo 'disabled'; } ?>">
                      <a class='page-link' href="<?php if($page >= $Pages){ echo '#'; } else { echo "?page=".($page + 1)."&id=".$id; } ?>">Siguiente</a>
                  </li>
                  
                </ul>
            <?php 
            }
            ?>
            </nav>
            </section>

<?php require("templates/footer.php"); ?>
<script src="js/buscar_productos.js"></script>



    
          
          
        


 