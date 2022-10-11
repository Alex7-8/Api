<?php
    header('Content-Type: application/json');

    require_once("../config/conexion.php");
    require_once("../models/Categoria.php");
    require_once("../models/Acceso.php");
    $categoria = new Categoria();
    $acceso = new Acceso();

    $body = json_decode(file_get_contents("php://input"), true);

    switch($_GET["Op"]){

        case "GetAll":
            $datos=$categoria->get_articulos();
            echo json_encode($datos);
        break;
        case "GetIn":
            $datos=$categoria->get_articulos_des();
            echo json_encode($datos);
        break;
        case "GetId":
            $datos=$categoria->get_articulos_x_id($body["id"]);
            echo json_encode($datos);
        break;

        case "Insert":
            $datos=$categoria->insert_articulos($body["nom_articulo"],$body["sub_categoria"],$body["descripcion"],$body["autor"],$body["fechayhora"]);
            echo json_encode("Insert Correcto");
        break;

        case "Update":
            $datos=$categoria->update_articulos($body["id"],$body["nom_articulo"],$body["sub_categoria"],$body["descripcion"],$body["estado"],$body["autor"],$body["fechayhora"]);
            echo json_encode($datos);
        break;

        case "Delete":
            $datos=$categoria->delete_articulos($body["id"]);
            echo json_encode("Delete Correcto");
        break;

        case "GetAcc":
            $datos=$acceso->get_acceso();
            echo json_encode($datos);
        break;

        case "InsertAll":
            $datos=$categoria->insert_arti($body["nom_articulo"],$body["sub_categoria"],$body["descripcion"],$body["autor"],$body["fechayhora"],$body["enlace"],$body["fecha"],$body["hora"]);
            echo json_encode("Insert Correcto");
        break;
    }
?>