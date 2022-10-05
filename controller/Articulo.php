<?php
require_once("../config/conexion.php");
require_once("..models/articulo.php");

$ARTICULO = new articulo();

switch($get_GET["op"]){
   case "GetAll":
        $datos = $ARTICULO->get_articulo();
        echo json_encode($datos);
    break; 
}
?>