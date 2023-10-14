<?php

require("Entidades/Compras.php");
require_once("Datos/Conexion.php");



class ComprasDao extends Conexion{

    protected static $con;


    private static function getConnection()
    {
        self::$con=Conexion::conectar();

        
    }

    private static function desconectar()
    {
        self::$con=null;
    }

   public static function Agregar_compra($compras){

    $query="insert into compras(id_usuario,Fecha,Monto) values(:id_usuario, NOW(),:Monto)";

    self::getConnection();

    $resultado=self::$con->prepare($query);

    $resultado->bindValue(":id_usuario",$compras->getid_usuario());
    $resultado->bindValue(":Monto",$compras->getMonto());
 

        $resultado->execute();

        return  $resultado = self::$con->lastInsertId();

        

     }

   
   public static function listar_compras()
  {
      $query="SELECT c.id_compra, c.fecha, c.monto, u.nombre as nombre FROM compras c inner join usuarios u on c.id_usuario=u.id_usuario order by c.id_compra asc;";

     self::getConnection();

      $resultado=self::$con->prepare($query);

      $resultado->execute();

      $filas=$resultado->fetchAll();

      return $filas;


  }

  public static function listar_pdf()
  {
      $query="SELECT c.id_compra, c.fecha, c.monto, u.nombre as nombre FROM compras c inner join usuarios u on c.id_usuario=u.id_usuario;";

     self::getConnection();

      $resultado=self::$con->prepare($query);

      $resultado->execute();

      $filas=$resultado->fetchAll();

      return $filas;


  }

  public static function Eliminar_compra($compra){

    try {
      $query="delete from compras where id_compra=:id_compra";
    
      self::getConnection();
    
      $resultado=self::$con->prepare($query);
    
      $resultado->bindValue(":id_compra",$compra->getid_compra());
    
      $resultado->execute();
    } catch (Exception $e) {
      //echo 'Excepción capturada: ',  $e->getMessage(), "\n";
      $_SESSION['message'] = 'No se pudo eliminar el producto '; //guardo mensaje en session
      $_SESSION['message_type'] = 'warning';
    }
}

}