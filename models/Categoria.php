<?php
    class Categoria extends Conectar{
        
        public function get_articulos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM articulo WHERE estado = 'Publicado' ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_articulos_des(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM articulo WHERE estado = 'No Publicado' || estado = 'Archivado'|| estado = 'Eliminado' ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_articulos_x_id($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM articulo WHERE id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_articulos($nom_articulo,$sub_categoria,$descripcion,$estado,$autor){
            date_default_timezone_set('America/Guatemala');
            $conectar= parent::conexion();
            parent::set_names();
            // No Publicado Eliminado Archivado
            $fecha = date('Y-m-d H:i:s');
            $sql="INSERT INTO articulo
            (id,
            nom_articulo,
            sub_categoria,
            descripcion,
            estado,
            autor,
            fechayhora) 
            VALUES
            (NULL,
            '$nom_articulo',
            '$sub_categoria',
            '$descripcion',
            '$estado',
            $autor,
            '$fecha')";
            $sql=$conectar->prepare($sql);
            if($sql->execute()){
                return "ok";
             }
            return $sql->errorInfo();
        }
        

        public function update_articulos($id,$nom_articulo,$sub_categoria,$descripcion,$estado,$autor,$fechayhora){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE articulo set
                nom_articulo = '$nom_articulo',
                sub_categoria = '$sub_categoria',
                descripcion = '$descripcion',
                estado = '$estado',
                autor = $autor
                WHERE id = $id";
            $sql=$conectar->prepare($sql);
            if($sql->execute()){
                return "ok";
             }
            return $sql->errorInfo();
        }

        public function delete_articulos($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE articulo set
                estado = 'Eliminado'
                WHERE
                id = $id";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function get_imgId($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM img WHERE id_art = $id";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_metodopago(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM met_pago WHERE estado = 'Activo'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

    }


    
