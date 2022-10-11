<?php
    class Categoria extends Conectar{
        public function get_articulos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM articulo WHERE estado = '1' ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_articulos_des(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM articulo WHERE estado = '0'";
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
            $nom_articulo,
            $sub_categoria,
            $descripcion,
            $estado,
            $autor,
            '2022-10-10 00:00:00.000')";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $sql->errorInfo();
        }
        

        public function update_articulos($id,$nom_articulo,$sub_categoria,$descripcion,$estado,$autor,$fechayhora){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE articulo set
                nom_articulo = ?,
                sub_categoria = ?,
                descripcion = ?,
                estado = ?,
                autor = ?,
                fechayhora = ?
                WHERE
                id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $nom_articulo);
            $sql->bindValue(2, $sub_categoria);
            $sql->bindValue(3, $descripcion);
            $sql->bindValue(4, $estado);
            $sql->bindValue(5, $autor);
            $sql->bindValue(6, $fechayhora);
            $sql->bindValue(7, $id);
            $sql->execute();
         return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_articulos($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE articulo set
                estado = '0'
                WHERE
                id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id);
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
    }


    
