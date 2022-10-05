<?php

class Articulo extends Conectar{
    public function get_articulo(){
         $Conectar = parent::Conexion();
         parent::set_names();
        $sql = "SELECT * FROM articulos";
        $sql = $Conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
        
    }
}

?>