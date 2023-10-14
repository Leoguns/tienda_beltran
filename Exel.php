<?php

class Exportar
{

    protected static $con;


    private static function getConnection()
    {
        self::$con=Conexion::conectar();

        
    }

    private static function desconectar()
    {
        self::$con=null;
    }


    public static function exportarConst()
  {
      $query="SELECT p.id_producto, p.nombre, SUM(d.cantidad) as cantidad, SUM(d.cantidad * p.precio) as recaudado FROM 
      productos p inner join detalle_compras d on p.id_producto=d.id_producto group by p.id_producto ORDER BY recaudado DESC limit 0,10";

      self::getConnection();

      $resultado=self::$con->prepare($query);

      $resultado->execute();

      $filas=$resultado->fetchall();

  
        


     return $filas;
  }
}


?>