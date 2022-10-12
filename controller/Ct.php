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
    require_once("../models/katy.php");
    $categoria = new Categoria();
    $acceso = new Acceso();

    $body = json_decode(file_get_contents("php://input"), true);

    switch($_GET["Op"]){
    /*Inicio Métodos para CRUD Articulo*/
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
            if($datos=="ok"){
                echo json_encode(array('status' => 'Guardado Correctamente'));}
            else{
                echo json_encode($datos);}
            
        break;

        case "Upart":
            $datos=$categoria->update_articulos($body["id"],$body["nom_articulo"],$body["sub_categoria"],$body["descripcion"],$body["estado"],$body["autor"],$body["fechayhora"]);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Actualizado Correctamente'));}
            else{
                echo json_encode($datos);}
        break;

        case "Delart":
            $id = $_GET["id"];
            $datos=$categoria->delete_articulos($id);
            echo json_encode($datos);
        break;
    /*Fin Métodos para CRUD Articulo*/

    /*Inicio Métodos para CRUD Img*/
        case "GimgId":
            $id = $_GET["id"];
            $datos=$categoria->get_imgId($id);
            echo json_encode($datos);
        break;
    /*Fin Métodos para CRUD Img*/
        
    /*Inicio Métodos para CRUD Metodo de pago*/
        case "GmetP":
            $datos=$categoria->get_metodopago();
            echo json_encode($datos);
        break;
    /*Fin Métodos para CRUD Metodo de pago*/

    /*Inicio Métodos para CRUD Usuario*/
        case "Gusu":
            $datos=$categoria->get_usuario();
            echo json_encode($datos);
        break;
        case "GusuDes":
            $datos=$categoria->get_usuario_des();
            echo json_encode($datos);
        break;
        case "GusuId":
            $id = $_GET["id"];
            $datos=$categoria->get_usuario_x_id($id);
            echo json_encode($datos);
        break;
        case "Setusu":
            $datos=$categoria->insert_usuario($body["nombre"],$body["apellido"],$body["correo"],$body["pass"],$body["tip_user"],$body["estadp"]);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Guardado Correctamente'));}
            else{
                echo json_encode($datos);}
        break;
        case "Upusu":
            $datos=$categoria->update_usuario($body["id"],$body["nombre"],$body["apellido"],$body["correo"],$body["pass"],$body["tip_user"],$body["estadp"],$body["fechayhora"]);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Actualizado Correctamente'));}
            else{
                echo json_encode($datos);}
        break;
        case "Delusu":
            $id = $_GET["id"];
            $datos=$categoria->delete_usuario($id);
            echo json_encode($datos);
        break;
        
    /*Fin Métodos para CRUD Usuario*/
        //case "GetAcc":
         //    $datos=$categoria->get_img_x_id($id);
         //    echo json_encode($datos);
         //break;

        // case "InsertAll":
        //     $datos=$categoria->insert_arti($body["nom_articulo"],$body["sub_categoria"],$body["descripcion"],$body["autor"],$body["fechayhora"],$body["enlace"],$body["fecha"],$body["hora"]);
        //     echo json_encode($datos);
        // break;
    }
    /*Categoria CRUD*/
    case "Getcat":
        $datos=$categoria->get_categoria();
        echo json_encode($datos);
    break;

   
    case "Getctid":
        $id = $_GET["id"];
        $datos=$categoria->get_categoria_id($id);
        echo json_encode($datos);
    break;

    case "Setcat":
        $datos=$categoria->insert_categoria($body["nombre"],$body["descripcion"],$body["estado"]);
        if($datos=="ok"){
            echo json_encode(array('status' => 'Guardado Correctamente'));}
        else{
            echo json_encode($datos);}
        
    break;

    case "Upcat":
        $datos=$categoria->update_categoria($body["id"],$body["nombre"],$body["descripcion"],$body["estado"],$body["fechayhora"]);
        if($datos=="ok"){
            echo json_encode(array('status' => 'Actualizado Correctamente'));}
        else{
            echo json_encode($datos);}
    break;

    case "Delcat":
        $id = $_GET["id"];
        $datos=$categoria->delete_categori($id);
        echo json_encode($datos);
    break;

    /*fin*/

       /*Categoria CRUD*/
       case "Getsus":
        $datos=$categoria->get_suscripcion();
        echo json_encode($datos);
    break;
?>