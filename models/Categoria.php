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

        public function insert_articulos($nom_articulo,$sub_categoria,$descripcion,$autor,$fechayhora){
            $conectar= parent::conexion();
            parent::set_names();
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
            ?,
            ?,
            ?,
            '1',
            ?,
            ?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $nom_articulo);
            $sql->bindValue(2, $sub_categoria);
            $sql->bindValue(3, $descripcion);
            $sql->bindValue(4, $autor);
            $sql->bindValue(5, $fechayhora);
            $sql->execute();

            
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
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


        public function insert_arti($nom_articulo,$sub_categoria,$descripcion,$autor,$fechayhora,$enlace,$fecha,$hora){
            $conectar= parent::conexion();
            parent::set_names();
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
            ?,
            ?,
            ?,
            '1',
            ?,
            ?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(2, $nom_articulo);
            $sql->bindValue(2, $sub_categoria);
            $sql->bindValue(3, $descripcion);
            $sql->bindValue(4, $autor);
            $sql->bindValue(5, $fechayhora);
            $sql->execute();

            $sqlI = "SELECT max(id) id from articulo";
            $sqlI=$conectar->prepare($sqlI);
            $sqlI->execute();
            $res = $sqlI->fetchAll(PDO::FETCH_ASSOC);
            $id_art = $res[0];


            $sql="INSERT INTO img
            (id_img,
            id_art,
            enlace,
            fecha,
            hora)
            VALUES 
            (NULL,
            ?,
            ?,
            ?,
            ?,)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_art);
            $sql->bindValue(2, $enlace);
            $sql->bindValue(3, $fecha);
            $sql->bindValue(4, $hora);

            $sql->execute();

            return $resultado=$id_art->fetchAll(PDO::FETCH_ASSOC);
            
        }



    }


    
