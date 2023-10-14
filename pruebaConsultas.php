<?php

require_once("Datos/Conexion.php");

class pruebaConsulta extends Conexion{

    protected static $con;


    private static function getConnection()
    {
        self::$con=Conexion::conectar();

        
    }

    private static function desconectar()
    {
        self::$con=null;
    }


public static function lista_prueba()
{
    $query="SELECT 
    c.id_compra as CodigoFactura , 
    p.id_producto as Codigo_Producto,
    c.fecha as Fecha , 
    u.nombre As Cliente, 
    p.nombre AS Producto, 
    d.cantidad AS Cantidad, 
    d.precio_unitario AS Precio, 
    d.precio_unitario*d.cantidad AS subtotal, 
    c.monto as Total_Neto 
    FROM detalle_compras d 
    inner join productos p on d.id_producto=p.id_producto 
    inner join compras c on d.id_compra=c.id_compra 
    INNER JOIN usuarios u ON u.id_usuario=c.id_usuario 
    WHERE c.id_compra =".$_SESSION['id_compra'];

   self::getConnection();

    $resultado=self::$con->prepare($query);

    $resultado->execute();

    $filas=$resultado->fetchAll();

    return $filas;


}


}

