<?php
    class Conectar {
        protected $dbh;

        protected function Conexion() {
            // Ruta al certificado SSL
            $ruta_certificado = "/DigiCertTLSECCP384RootG5.crt.pem";

            // Opciones adicionales para la conexión segura
            $opciones = array(
                PDO::MYSQL_ATTR_SSL_CA     => $ruta_certificado, // Certificado CA
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false, // (Opcional) No verificar el certificado del servidor
                PDO::ATTR_ERRMODE          => PDO::ERRMODE_EXCEPTION, // Manejo de errores
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Formato de datos por defecto
            );

            try {
                // Establecer la conexión usando PDO
                $this->dbh = new PDO(
                    "mysql:host=prestamos.mysql.database.azure.com;dbname=prestamos_md;port=3306",
                    "psviaadprx", // Usuario
                    "Server@78", // Contraseña
                    $opciones
                );

                return $this->dbh;	
            } catch (Exception $e) {
                // Manejo de errores
                print "¡Error BD!: " . $e->getMessage() . "<br/>";
                die();	
            }
        }

        public function set_names() {	
            return $this->dbh->query("SET NAMES 'utf8'");
        }
    }
?>
