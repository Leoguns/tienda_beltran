<?php
require("Entidades/Compras.php");
class FacturaPDF
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


    public static function Exportar_PDF()
  {
      $query="SELECT c.id_compra as CodigoFactura , 
      p.id_producto as Codigo_Producto,c.fecha as Fecha ,
       u.usuario As Usuario,u.nombre as Nombre,u.correo as Correo, p.nombre AS Producto, d.cantidad AS Cantidad,
        d.precio_unitario AS Precio, d.precio_unitario*d.cantidad AS Subtotal, 
        c.monto as Total_Neto FROM detalle_compras d inner join productos p on d.id_producto=p.id_producto inner join compras c on d.id_compra=c.id_compra INNER JOIN usuarios u ON u.id_usuario=c.id_usuario
        where c.id_compra =".$_SESSION['id_compra'];

   self::getConnection();

    $resultado=self::$con->prepare($query);

    $resultado->execute();

    $filas=$resultado->fetchAll();

    return $filas;
  }
}


?>