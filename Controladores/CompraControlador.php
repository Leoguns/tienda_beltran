<?php

require_once("Datos/ComprasDao.php");

class CompraControlador{


    public static function agregar_compra($id_usuario,$Monto)
    {
        $obj_venta=new Compras();

        $obj_venta->setid_usuario($id_usuario);
        $obj_venta->setMonto($Monto);
               

        return ComprasDao::Agregar_compra($obj_venta);

    }

     public static function mostrar_compras()
    {
        return ComprasDao::listar_compras();
    }

    public static function eliminar_comp($id)
    {
        $obj_comp=new Compras();

        $obj_comp->setid_compra($id);

        return ComprasDao::Eliminar_compra($obj_comp);

    }

     
}