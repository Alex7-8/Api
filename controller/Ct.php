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
            $id = $_GET["id"];
            $datos=$categoria->get_articulos_x_id($id);
            echo json_encode($datos);
        break;

        case "Setart":
            $datos=$categoria->insert_articulos($body["nom_articulo"],$body["sub_categoria"],$body["descripcion"],$body["estado"],$body["autor"]);
            if($datos){
                echo json_encode(array('success' => 1, 'message' => 'Articulo Creado'));}
                else{
                echo json_encode(array('success' => 0, 'message' => 'Error al Crear Articulo'));
                }
            
        break;

        case "Upart":
            $datos=$categoria->update_articulos($body["id"],$body["nom_articulo"],$body["sub_categoria"],$body["descripcion"],$body["estado"],$body["autor"],$body["fechayhora"]);
            echo json_encode($datos);
        break;

        case "Delart":
            $id = $_GET["id"];
            $datos=$categoria->delete_articulos($id);
            echo json_encode("Delete Correcto");
        break;

        case "GimgId":
            $id = $_GET["id"];
            $datos=$categoria->get_imgId($id);
            echo json_encode($datos);
        break;

        //case "GetAcc":
         //    $datos=$categoria->get_img_x_id($id);
         //    echo json_encode($datos);
         //break;

        // case "InsertAll":
        //     $datos=$categoria->insert_arti($body["nom_articulo"],$body["sub_categoria"],$body["descripcion"],$body["autor"],$body["fechayhora"],$body["enlace"],$body["fecha"],$body["hora"]);
        //     echo json_encode($datos);
        // break;
    }
?>