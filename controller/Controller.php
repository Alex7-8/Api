<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Authorization, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

header('Content-Type: application/json');

require_once("../config/conexion.php");
require_once("../service/Logica_login.php");
require_once("../helpers/auth.php"); 

use Firebase\JWT\JWT;

$categoria = new Login();
$body = json_decode(file_get_contents("php://input"), true);

// Función para obtener el token desde los headers
function getBearerToken() {
    $headers = getallheaders();
    if (!isset($headers['Authorization'])) {
        return null;
    }
    $matches = [];
    if (preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
        return $matches[1];
    }
    return null;
}

// Función para autenticar solicitudes protegidas
function authenticate() {
    $token = getBearerToken();

    if (!$token) {
        http_response_code(401);
        echo json_encode(['error' => 'Acceso denegado, token no proporcionado']);
        die();
    }

    $decoded = Auth::validateToken($token);

    if ($decoded === null) {
        http_response_code(401);
        echo json_encode(['error' => 'Token inválido o expirado']);
        die();
    }

    // Opcional: puedes usar los datos del token (por ejemplo, el ID del usuario)
    return $decoded->data;
}


switch($_GET["Op"]){
    /* Inicio Métodos para CRUD USUARIO */

    // Endpoint de LOGIN para generar el token
    case "LOGIN":
        $usuario = isset($body["usuario"]) ? $body["usuario"] : '';
        $password = isset($body["password"]) ? $body["password"] : '';
    
        // Validar que los campos no estén vacíos
        if (empty($usuario) || empty($password)) {
            echo json_encode(['error' => 'Usuario y contraseña son requeridos']);
            break;
        }
    
        // Llamar al método para autenticar el usuario
        $loginResult = $categoria->Get_Login($usuario, $password);
    
        // Validar el resultado de la autenticación
        if ($loginResult['resultado'] === 'ACCESO CONCEDIDO.') {
            // Generar el token con los datos del usuario
            $token = Auth::generateToken([
                'id' => $loginResult['idusuario'], 
                'rol' => $loginResult['rol']
            ]);
    
            // Enviar respuesta con el token y datos del usuario
            echo json_encode([
                'token' => $token,
                'idusuario' => $loginResult['idusuario'],
                'rol' => $loginResult['rol']
            ]);
        } else {
            // Enviar respuesta de error si las credenciales son incorrectas
            echo json_encode(['error' => $loginResult['resultado']]);
        }
        break;
    

    // Endpoint protegido para obtener usuarios
    case "GTUSU":
       authenticate(); // Validar token

        $datos = $categoria->Get_Usuarios();
        echo json_encode($datos);
        break;

    // Endpoint protegido para establecer usuarios
    case "STUSU":
        authenticate(); // Validar token

        $datos = $categoria->Set_Usuario(
            isset($body["ID_USUARIO"]) ? $body["ID_USUARIO"] : null,
            isset($body["NOMBRES"]) ? $body["NOMBRES"] : null,
            isset($body["CONTRASENA"]) ? $body["CONTRASENA"] : null,
            isset($body["USUARIO"]) ? $body["USUARIO"] : null
        );

        echo json_encode(['Status' => $datos]);
        break;

    // Endpoint protegido para actualizar artículos
    case "UPUSU":
        authenticate(); // Validar token

        $datos = $categoria->Put_Usuario(
            isset($body["ID_USUARIO"]) ? $body["ID_USUARIO"] : null,
            isset($body["NOMBRES"]) ? $body["NOMBRES"] : null,
            isset($body["CONTRASENA"]) ? $body["CONTRASENA"] : null,
            isset($body["USUARIO"]) ? $body["USUARIO"] : null
        );

       
        echo json_encode(['Status' => $datos]);
        break;

    default:
        echo json_encode(['error' => 'Operación no válida']);
        break;
}
?>
