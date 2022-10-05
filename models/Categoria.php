<?php
    class Categoria extends Conectar{
        public function get_articulos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM articulos";
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

        public function insert_articulos($nombre,$categoria,$sub_cat,$des,$enlace){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_categoria(id,nombre_articulo,categoria,sub_categoria,descripcion,enlace,estado) VALUES (NULL,?,?,?,?,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $nombre);
            $sql->bindValue(2, $categoria);
            $sql->bindValue(3, $sub_cat);
            $sql->bindValue(4, $des);
            $sql->bindValue(5, $enlace);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_categoria($cat_id,$cat_nom,$cat_obs){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_categoria set
                cat_nom = ?,
                cat_obs = ?
                WHERE
                cat_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_nom);
            $sql->bindValue(2, $cat_obs);
            $sql->bindValue(3, $cat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_categoria($cat_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_categoria set
                est = '0'
                WHERE
                cat_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

    }
?>