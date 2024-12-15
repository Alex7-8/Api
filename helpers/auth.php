<?php
require_once("../vendor/autoload.php");
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth {
    private static $secret_key = 'HDdfB-3DNS4-NdhHy-471df'; 
    private static $encrypt = 'HS256';

    public static function generateToken($data) {
        $time = time();
        $token = [
            'iat' => $time, // Tiempo de creación
            'exp' => $time + (60 * 60), // Expiración (1 hora)
            'data' => $data // Datos personalizados
        ];

        return JWT::encode($token, self::$secret_key, self::$encrypt);
    }

    public static function validateToken($token) {
        try {
            // Decodifica y valida el token
            $decoded = JWT::decode($token, new Key(self::$secret_key, self::$encrypt));
            return $decoded; // Devuelve los datos decodificados si es válido
        } catch (\Firebase\JWT\ExpiredException $e) {
            // Token expirado
            return null;
        } catch (\Exception $e) {
            // Otros errores (token inválido, firma incorrecta, etc.)
            return null;
        }
    }
}





?>