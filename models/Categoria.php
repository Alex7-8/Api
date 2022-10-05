<?php
    class Categoria extends Conectar{
        public function get_articulos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM articulos WHERE estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_articulos_des(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM articulos WHERE estado = 0";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_articulos_x_id($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM articulos WHERE id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_articulos($nombre_articulo,$categoria,$sub_categoria,$descripcion,$enlace){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO articulos(id,nombre_articulo,categoria,sub_categoria,descripcion,enlace,estado) VALUES (NULL,?,?,?,?,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $nombre_articulo);
            $sql->bindValue(2, $categoria);
            $sql->bindValue(3, $sub_categoria);
            $sql->bindValue(4, $descripcion);
            $sql->bindValue(5, $enlace);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_articulos($id,$nombre_articulo,$categoria,$sub_categoria,$descripcion,$enlace,$estado){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE articulos set
                nombre_articulo = ?,
                categoria = ?,
                sub_categoria = ?,
                descripcion = ?,
                enlace = ?,
                estado = ?,
                WHERE 
                id = ?
                ";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $nombre_articulo);
            $sql->bindValue(2, $categoria);
            $sql->bindValue(3, $sub_categoria);
            $sql->bindValue(4, $descripcion);
            $sql->bindValue(5, $enlace);
            $sql->bindValue(6, $estado);
            $sql->bindValue(7, $id);
            $sql->execute();
         return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_articulos($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE articulos set
                estado = '0'
                WHERE
                id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

    }
