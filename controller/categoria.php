<?php
    header('Content-Type: application/json');

    require_once("../config/conexion.php");
    require_once("../models/Categoria.php");
    $categoria = new Categoria();

    $body = json_decode(file_get_contents("php://input"), true);

    switch($_GET["Op"]){

        case "GetAll":
            $datos=$categoria->get_articulos();
            echo json_encode($datos);
        break;

        case "GetId":
            $datos=$categoria->get_articulos_x_id($body["id"]);
            echo json_encode($datos);
        break;

        case "Insert":
            $datos=$categoria->insert_articulos($body["nombre"],$body["categoria"],$body["sub_cat"],$body["des"],$body["enlace"]);
            echo json_encode("Insert Correcto");
        break;

        case "Update":
            $datos=$categoria->update_categoria($body["cat_id"],$body["cat_nom"],$body["cat_obs"]);
            echo json_encode("Update Correcto");
        break;

        case "Delete":
            $datos=$categoria->delete_categoria($body["cat_id"]);
            echo json_encode("Delete Correcto");
        break;
    }
?>