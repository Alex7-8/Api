<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

    header('Content-Type: application/json');

    require_once("../config/conexion.php");
    require_once("../models/Categoria.php");
    require_once("../models/Acceso.php");
    $categoria = new Categoria();
    $acceso = new Acceso();

    $body = json_decode(file_get_contents("php://input"), true);

    switch($_GET["Op"]){

        case "Gart":
            $datos=$categoria->get_articulos();
            echo json_encode($datos);
        break;
        case "GartDes":
            $datos=$categoria->get_articulos_des();
            echo json_encode($datos);
        break;
        case "GartId":
            $datos=$categoria->get_articulos_x_id($body["id"]);
            echo json_encode($datos);
        break;

        case "Setart":
            $datos=$categoria->insert_articulos($body["nom_articulo"],$body["sub_categoria"],$body["descripcion"],$body["autor"],$body["fechayhora"]);
            echo json_encode("Insert Correcto");
        break;

        case "Upart":
            $datos=$categoria->update_articulos($body["id"],$body["nom_articulo"],$body["sub_categoria"],$body["descripcion"],$body["estado"],$body["autor"],$body["fechayhora"]);
            echo json_encode($datos);
        break;

        case "Delart":
            $datos=$categoria->delete_articulos($body["id"]);
            echo json_encode("Delete Correcto");
        break;

        case "GimgId":
            $id = $_GET["id"];
            $datos=$categoria->get_imgId($id);
            echo json_encode($datos);
        break;

        // case "GetAcc":
        //     $datos=$acceso->get_acceso();
        //     echo json_encode($datos);
        // break;

        // case "InsertAll":
        //     $datos=$categoria->insert_arti($body["nom_articulo"],$body["sub_categoria"],$body["descripcion"],$body["autor"],$body["fechayhora"],$body["enlace"],$body["fecha"],$body["hora"]);
        //     echo json_encode($datos);
        // break;
    }
?>