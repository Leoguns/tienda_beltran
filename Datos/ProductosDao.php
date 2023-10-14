<?php

require("Entidades/Productos.php");
require_once("Datos/Conexion.php");



class ProductosDao extends Conexion{

    protected static $con;


    private static function getConnection()
    {
        self::$con=Conexion::conectar();

        
    }

    private static function desconectar()
    {
        self::$con=null;
    }

  public static function Agregar_Productos($prod){

    $query="insert into productos(id_marca,id_categoria,nombre,precio,descripcion,talle,stock,imagen) values(:id_marca,:id_categoria,:nombre,:precio,:descripcion,:talle,:stock,:imagen)";

    self::getConnection();

    $resultado=self::$con->prepare($query);

    $resultado->bindValue(":id_marca",$prod->getId_marca());
    $resultado->bindValue(":id_categoria",$prod->getId_categoria());
    $resultado->bindValue(":nombre",$prod->getNombre());
    $resultado->bindValue(":precio",$prod->getPrecio());
    $resultado->bindValue(":descripcion",$prod->getDescripcion());
    $resultado->bindValue(":talle",$prod->getTalle());
    $resultado->bindValue(":stock",$prod->getStock());
    $resultado->bindValue(":imagen",$prod->getImagen());

        $resultado->execute();


    return  $resultado = self::$con->lastInsertId();
  }

  public static function Editar_productos($prod){

    $query="update productos set id_marca=:id_marca,id_categoria=:id_categoria,nombre=:nombre,precio=:precio,descripcion=:descripcion,talle=:talle,stock=:stock,imagen=:imagen  
    where id_producto=:id_producto";

    self::getConnection();

    $resultado=self::$con->prepare($query);

    $resultado->bindValue(":id_producto",$prod->getId_producto());
    $resultado->bindValue(":id_marca",$prod->getId_marca());
    $resultado->bindValue(":id_categoria",$prod->getId_categoria());
    $resultado->bindValue(":nombre",$prod->getNombre());
    $resultado->bindValue(":precio",$prod->getPrecio());
    $resultado->bindValue(":descripcion",$prod->getDescripcion());
    $resultado->bindValue(":talle",$prod->getTalle());
    $resultado->bindValue(":stock",$prod->getStock());
    $resultado->bindValue(":imagen",$prod->getImagen());


    $resultado->execute();

  }

  public static function Eliminar_productos($prod){

try {
  $query="delete from productos where id_producto=:id_producto";

  self::getConnection();

  $resultado=self::$con->prepare($query);

  $resultado->bindValue(":id_producto",$prod->getId_producto());

  $resultado->execute();
} catch (Exception $e) {
  //echo 'Excepción capturada: ',  $e->getMessage(), "\n";
  $_SESSION['message'] = 'No se pudo eliminar el producto '; //guardo mensaje en session
  $_SESSION['message_type'] = 'warning';
}

}

public static function InhabilitarProducto($id_producto)
    {
        $query="Update productos set estado=0 where id_producto=:id_producto";

        self::getConnection();

        $resultado=self::$con->prepare($query);

        $resultado->bindValue(":id_producto",$id_producto->getId_producto());
      

        if ($resultado->execute())
        {
            return $msg="Producto bloqueado";
        }else{
            return $msg="Producto desbloqueado";
        }

      }

      public static function HabilitarProducto($id_producto)
      {
          $query="Update productos set estado=1 where id_producto=:id_producto";
  
          self::getConnection();
  
          $resultado=self::$con->prepare($query);
  
          $resultado->bindValue(":id_producto",$id_producto->getId_producto());
        
  
          if ($resultado->execute())
          {
              return $msg="Producto bloqueado";
          }else{
              return $msg="Producto desbloqueado";
          }
  
        }


  public static function listar_productos(array $ids = [])
  {
      $query="SELECT p.id_producto, p.nombre,p.precio,p.stock,p.descripcion,p.talle,p.imagen, p.estado ,m.nombre as Marca,c.nombre as Categoria FROM 
      productos p inner join marcas m on p.id_marca=m.id_marca inner join categorias c on p.id_categoria=c.id_categoria";

      if (! empty($ids)) {
        $query .= " where p.id_producto in (" . implode(',', $ids) . ")";
      }

      $query .= ";";

      self::getConnection();

      $resultado=self::$con->prepare($query);

      $resultado->execute();

      $filas=$resultado->fetchAll();

      return $filas;

      $producto=new Productos();

    $producto->setId_producto($filas["id_producto"]);
    $producto->setId_marca($filas["id_marca"]);
    $producto->setId_categoria($filas["id_categoria"]);
    $producto->setNombre($filas["nombre"]);
    $producto->setPrecio($filas["precio"]);
    $producto->setDescripcion($filas["descripcion"]);
    $producto->setTalle($filas["talle"]);
    $producto->setStock($filas["stock"]);
    $producto->setImagen($filas["imagen"]);
    $producto->setestado($filas["estado"]);

    return $producto;

  }

  public static function productos_mas_vendidos()
  {
      $query="SELECT p.id_producto, p.nombre, SUM(d.cantidad) as cantidad, SUM(d.cantidad * p.precio) as recaudado FROM 
      productos p inner join detalle_compras d on p.id_producto=d.id_producto group by p.id_producto ORDER BY recaudado DESC limit 0,10";

      self::getConnection();

      $resultado=self::$con->prepare($query);

      $resultado->execute();

      $filas=$resultado->fetchAll();

      return $filas;
  }

  public static function get_productos($id)
  {
      $query="SELECT p.id_producto, p.nombre,p.precio,p.stock,p.descripcion,p.talle,p.imagen,m.nombre as Marca,c.nombre as Categoria FROM 
      productos p inner join marcas m on p.id_marca=m.id_marca inner join categorias c on p.id_categoria=c.id_categoria where p.id_producto=:id_producto";

      self::getConnection();

      $resultado=self::$con->prepare($query);

      $resultado->bindValue(":id_producto",$id);

      $resultado->execute();

      $filas= $resultado->fetch();

      $prod=new Productos();

      $prod->setId_producto($filas["id_producto"]);
      $prod->setNombre($filas["nombre"]);
      $prod->setPrecio($filas["precio"]);
      $prod->setStock($filas["stock"]);
      $prod->setDescripcion($filas["descripcion"]);
      $prod->setTalle($filas["talle"]);
      $prod->setImagen($filas["imagen"]);
      $prod->setId_marca($filas["Marca"]);
      $prod->setId_categoria($filas["Categoria"]);
    
      return $prod;
  }

  public static function catalogo_prod($id)
  {

$query="SELECT p.id_producto, p.nombre,p.precio,p.stock,p.descripcion,p.talle,p.imagen,p.estado,m.nombre as Marca,c.nombre as Categoria FROM productos p inner join marcas m on p.id_marca=m.id_marca inner join categorias c on p.id_categoria=c.id_categoria WHERE c.id_categoria =:id_categoria and p.estado='1' and p.stock>'0' ";

    self::getConnection();

    $resultado=self::$con->prepare($query);

    $resultado->bindValue(":id_categoria",$id);

    $resultado->execute();

    $filas=$resultado->fetchAll();

    return $filas;

    $filas=$resultado->fetch();

  }

  public static function catalogo_prodNuevo($id)
  {

$query="SELECT p.id_producto, p.nombre,p.precio,p.stock,p.descripcion,p.talle,p.imagen,p.estado,m.nombre as Marca,c.nombre as Categoria FROM productos p inner join marcas m on p.id_marca=m.id_marca inner join categorias c on p.id_categoria=c.id_categoria WHERE c.id_categoria =:id_categoria and p.estado='1'";

    self::getConnection();

    $resultado=self::$con->prepare($query);

    $resultado->bindValue(":id_categoria",$id);

    $resultado->execute();

    $filas=$resultado->fetchAll();

    return $filas;

    $filas=$resultado->fetch();

  }


public static function ProductoExiste($prod)
    {
        $query="select * from productos where nombre =:nombre";

        self::getConnection();

        $resultado=self::$con->prepare($query);

        $resultado->bindValue(":nombre",$prod->getNombre());
      

        $resultado->execute();

        
        if($resultado->rowCount()>0 )
        {
            return true;
        }
        return false;
    }

}


?>