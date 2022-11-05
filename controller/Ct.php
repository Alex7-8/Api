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
    $categoria = new Categoria();
    $body = json_decode(file_get_contents("php://input"), true);

    switch($_GET["Op"]){
    /*Inicio Métodos para CRUD Articulo*/
        case "Gart":
            $datos=$categoria->get_articulos();
            echo json_encode($datos);
        break;
        case "GartProc":
            $datos=$categoria->get_articulos_proc();
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

        case "SetartProc":
            $datos=$categoria->insert_articulos_proc($body["nom_articulo"],$body["sub_categoria"],$body["descripcion"],$body["estado"],$body["autor"],$body['enlace']);
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
            if($datos=="ok"){
                echo json_encode(array('status' => 'Estado Actualizado a Eliminado'));}
            else{
                echo json_encode($datos);}
        break;
        case "DelartProc":
            $id = $_GET["id"];
            $idimg = $_GET["idimg"];
            $datos=$categoria->delete_articulos_proc($id,$idimg);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Estado Actualizado a Eliminado'));}
            else{
                echo json_encode($datos);}
        break;
    /*Fin Métodos para CRUD Articulo*/
    /*Inicio Métodos para CRUD Img*/
        case "Gimg":
            $datos=$categoria->get_img();
            echo json_encode($datos);
        break;
        case "GimgDes":
            $datos=$categoria->get_img_des();
            echo json_encode($datos);
        break;
        case "GimgId":
            $id = $_GET["id"];
            $datos=$categoria->get_imgId($id);
            echo json_encode($datos);
        break;
        case "Setimg":
            $datos=$categoria->insert_img($body['id_art'],$body['enlace']);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Guardado Correctamente'));}
            else{
                echo json_encode($datos);}
        break;
        case "Upimg":
            $datos=$categoria->update_img($body['id_img'],$body['id_art'],$body['enlace'],$body['estado']);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Actualizado Correctamente'));}
            else{
                echo json_encode($datos);}
        break;
        case "Delimg":
            $id = $_GET["id"];
            $datos=$categoria->delete_img($id);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Estado Actualizado a Eliminado'));}
            else{
                echo json_encode($datos);}
        break;
    /*Fin Métodos para CRUD Img*/

    /*Inicio Métodos para CRUD Pago*/
        case "Gpag":
            $datos=$categoria->get_pago();
            echo json_encode($datos);
        break;
        case "GpagDes":
            $datos=$categoria->get_pago_des();
            echo json_encode($datos);
        break;
        case "GpagId":
            $id = $_GET["id"];
            $datos=$categoria->get_pagoId($id);
            echo json_encode($datos);
        break;
        case "Setpag":
            $datos=$categoria->insert_pago($body['id_metP'],$body['nombtarjeta'],$body['numtarjeta'],$body['vencimiento'],$body['cvv']);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Guardado Correctamente'));}
            else{
                echo json_encode($datos);}
        break;
        case "Uppag":
            $datos=$categoria->update_pago($body['id_metP'],$body['nombtarjeta'],$body['numtarjeta'],$body['vencimiento'],$body['cvv'],$body['estado']);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Actualizado Correctamente'));}
            else{
                echo json_encode($datos);}
        break;
        case "Delpag":
            $id = $_GET["id"];
            $datos=$categoria->delete_pago($id);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Estado Actualizado a Eliminado'));}
            else{
                echo json_encode($datos);}
        break;
    /*Fin Métodos para CRUD Pago*/

    /*Inicio Métodos para CRUD Metodo de pago*/
        case "GmetP":
            $datos=$categoria->get_metodopago();
            echo json_encode($datos);
        break;
        case "GmetPDes":
            $datos=$categoria->get_metodopago_des();
            echo json_encode($datos);
        break;
        case "GmetPId":
            $id = $_GET["id"];
            $datos=$categoria->get_metodopago_x_id($id);
            echo json_encode($datos);
        break;
        case "SetmetP":
            $datos=$categoria->insert_metodopago($body['id_user'],$body['nombre'],$body['apellido'],$body['telefono'],$body['correo'],$body['pais'],$body['direccion'],$body['nit']);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Guardado Correctamente'));}
            else{
                echo json_encode($datos);
            }
        break;
        case "UpmetP":
            $datos=$categoria->update_metodopago($body['id_metP'],$body['id_user'],$body['nombre'],$body['apellido'],$body['telefono'],$body['correo'],$body['pais'],$body['direccion'],$body['nit'],$body['estado']);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Actualizado Correctamente'));}
            else{
                echo json_encode($datos);
            }
        break;
        case "DelmetP":
            $id = $_GET["id"];
            $datos=$categoria->delete_metodopago($id);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Estado Actualizado a Eliminado'));}
            else{
                echo json_encode($datos);}
        break;
    /*Fin Métodos para CRUD Metodo de pago*/
    /*Inicio Métodos para CRUD Usuarios*/
        case "Gusu":
            $datos=$categoria->get_usuario();
            echo json_encode($datos);
        break;
        case "GusuDes":
            $datos=$categoria->get_usuario_des();
            echo json_encode($datos);
        break;
        case "GusuInner":
            $datos=$categoria->get_user_inner();
            echo json_encode($datos);
        break;
        case "GusuInnerDes":
            $datos=$categoria->get_user_inner_Des();
            echo json_encode($datos);
        break;
        case "GusuId":
            $id = $_GET["id"];
            $datos=$categoria->get_usuario_x_id($id);
            echo json_encode($datos);
        break;
        case "Setusu":
            $datos=$categoria->insert_usuario($body["nombre"],$body["apellido"],$body["correo"],$body["pass"],$body["tip_user"],$body["img"]);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Guardado Correctamente'));}
            else{
                echo json_encode($datos);}
        break;
        case "Upusu":
            $datos=$categoria->update_usuario($body["id_user"],$body["nombre"],$body["apellido"],$body["correo"],$body["pass"],$body["tip_user"],$body["estado"],$body["img"]);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Actualizado Correctamente'));}
            else{
                echo json_encode($datos);}
        break;
        case "Delusu":
            $id = $_GET["id"];
            $datos=$categoria->delete_usuario($id);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Estado Actualizado a Inactivo'));}
            else{
                echo json_encode($datos);}
        break;
        case "Acusu":
            $id = $_GET["id"];
            $datos=$categoria->Activar_usuario($id);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Estado Actualizado a Activado'));}
            else{
                echo json_encode($datos);}
        break;
    /*Fin Métodos para CRUD Usuarios*/

    /*Inicio Métodos para CRUD Tipo de Usuario*/
        case "GtipU":
            $datos=$categoria->get_tipouser();
            echo json_encode($datos);
        break;
        case "GtipUDes":
            $datos=$categoria->get_tipouserDes();
            echo json_encode($datos);
        break;
        case "GtipUId":
            $id = $_GET["id"];
            $datos=$categoria->get_tipouser_x_id($id);
            echo json_encode($datos);
        break;
        case "SettipU":
            $datos=$categoria->insert_tipouser($body['rol']);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Guardado Correctamente'));}
            else{
                echo json_encode($datos);}
        break;
        case "UptipU":
            $datos=$categoria->update_tipouser($body['id'],$body['rol'],$body['estado']);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Actualizado Correctamente'));}
            else{
                echo json_encode($datos);}
        break;
        case "DeltipU":
            $id = $_GET["id"];
            $datos=$categoria->delete_tipouser($id);
            if($datos=="ok"){
                echo json_encode(array('status' => 'Estado Actualizado a Inactivo'));}
            else{
                echo json_encode($datos);}
        break;
    /*Fin Métodos para CRUD Tipo de Usuario*/

/*Categoria CRUD*/
    case "Getcat":
        $datos=$categoria->get_categoria();
        echo json_encode($datos);
    break;
    case "GetcatDes":
        $datos=$categoria->get_categoria_des();
        echo json_encode($datos);
    break;
    case "GetcatId":
        $id = $_GET["id"];
        $datos=$categoria->get_categoria_x_id($id);
        echo json_encode($datos);
    break;
    case "Setcat":
        $datos=$categoria->insert_categoria($body["nombre"],$body["descripcion"]);
        if($datos=="ok"){
            echo json_encode(array('status' => 'Guardado Correctamente'));}
        else{
            echo json_encode($datos);}
        
    break;
    case "Upcat":
        $datos=$categoria->update_categoria($body["id"],$body["nombre"],$body["descripcion"],$body["estado"]);
        if($datos=="ok"){
            echo json_encode(array('status' => 'Actualizado Correctamente'));}
        else{
            echo json_encode($datos);}
    break;
    case "Delcat":
        $id = $_GET["id"];
        $datos=$categoria->delete_categoria($id);
        if($datos=="ok"){
            echo json_encode(array('status' => 'Estado Actualizado a Inactivo'));}
        else{
            echo json_encode($datos);}
    break;

/*fin*/
/*Inicio Métodos para CRUD Sub Categoria*/

// Metodo para obtener nombre de la categoria
    case "Gcatnom":
        $nomb = $_GET["nomb"];
        $datos=$categoria->get_categor($nomb);
        echo json_encode($datos);
    break;
    case "Gsubcat":
        $datos=$categoria->get_subcategoria();
        echo json_encode($datos);
    break;
    case "GsubcatDes":
        $datos=$categoria->get_subcategoria_des();
        echo json_encode($datos);
    break;
    case "GsubcatNomb":
        $nomb = $_GET["nomb"];
        $datos=$categoria->get_subcategoria_x_id($nomb);
        echo json_encode($datos);
    break;
    case "Setsubcat":
        $datos=$categoria->insert_subcategoria($body['nombre_sub'],$body['id_categoria'],$body["descripcion"]);
        if($datos=="ok"){
            echo json_encode(array('status' => 'Guardado Correctamente'));}
        else{
            echo json_encode($datos);}
    break;
    case "Upsubcat":
        $datos=$categoria->update_subcategoria($body['nombre_sub'],$body['id_categoria'],$body["descripcion"],$body["estado"]);
        if($datos=="ok"){
            echo json_encode(array('status' => 'Actualizado Correctamente'));}
        else{
            echo json_encode($datos);}
    break;
    case "Delsubcat":
        $nomb = $_GET["nomb"];
        $datos=$categoria->delete_subcategoria($nomb);
        if($datos=="ok"){
            echo json_encode(array('status' => 'Estado Actualizado a Inactivo'));}
        else{
            echo json_encode($datos);}
    break;
/*Fin Métodos para CRUD Sub Categoria*/
/*Suscripcion CRUD*/
    case "Getsus":
        $datos=$categoria->get_suscripcion();
        echo json_encode($datos);
    break;
    case "GetsusDes":
        $datos=$categoria->get_suscripcion_des();
        echo json_encode($datos);
    break;
    case "GetsusId":
        $id = $_GET["id"];
        $datos=$categoria->get_suscripcion_x_id($id);
        echo json_encode($datos);
    break;
    case "Setsus":
        $datos=$categoria->insert_suscripcion($body['id_sus']);
        if($datos=="ok"){
            echo json_encode(array('status' => 'Guardado Correctamente'));}
        else{
            echo json_encode($datos);}
    break;
    case "Upsus":
        $datos=$categoria->update_suscripcion($body['id_sus'],$body['fecha_sus'],$body["estado"]);
        if($datos=="ok"){
            echo json_encode(array('status' => 'Actualizado Correctamente'));}
        else{
            echo json_encode($datos);}
    break;
    case "Delsus":
        $id = $_GET["id"];
        $datos=$categoria->delete_suscripcion($id);
        if($datos=="ok"){
            echo json_encode(array('status' => 'Estado Actualizado a Inactivo'));}
        else{
            echo json_encode($datos);}
    break;
    /*fin*/

/*Inicio Métodos para CRU Acceso*/
case "Getacc":
    $datos=$categoria->get_acceso();
    echo json_encode($datos);
break;
case "GetaccId":
    $id = $_GET["id"];
    $datos=$categoria->get_acceso_x_id($id);
    echo json_encode($datos);
break;
case "Setacc":
    $datos=$categoria->insert_acceso($body['id_user'],$body['id_art'],$body['direccion'],$body['direccion2'],$body['conteo']);
    if($datos=="ok"){
        echo json_encode(array('status' => 'Guardado Correctamente'));}
    else{
        echo json_encode($datos);}
break;
case "Upacc":
    $datos=$categoria->update_acceso($body['id'],$body['id_user'],$body['id_art'],$body['direccion'],$body['direccion2'],$body['conteo']);
    if($datos=="ok"){
        echo json_encode(array('status' => 'Actualizado Correctamente'));}
    else{
        echo json_encode($datos);}
break;
/*Fin Métodos para CRU Acceso*/

/*Inicio Métodos para CR Bitacora*/
case "Getbit":
    $datos=$categoria->get_bitacora();
    echo json_encode($datos);
break;
case "GetbitId":
    $id = $_GET["id"];
    $datos=$categoria->get_bitacora_x_id($id);
    echo json_encode($datos);
break;
case "Setbit":
    $datos=$categoria->insert_bitacora($body['id_art'],$body['id_user'],$body['cambios']);
    if($datos=="ok"){
        echo json_encode(array('status' => 'Guardado Correctamente'));}
    else{
        echo json_encode($datos);}
break;
/*Fin Métodos para CR Bitacora*/
    }
    
?>