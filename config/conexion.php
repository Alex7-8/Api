<?php
    class Conectar{
        protected $dbh;

        protected function Conexion(){
            try {
				$conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=chacongt_apirestmysql","chacongt_alex78","55262412");
				return $conectar;	
			} catch (Exception $e) {
				print "¡Error BD!: " . $e->getMessage() . "<br/>";
				die();	
			}
        }

        public function set_names(){	
			return $this->dbh->query("SET NAMES 'utf8'");
        }
    }
?>