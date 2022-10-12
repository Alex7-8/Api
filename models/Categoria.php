<?php
    class Categoria extends Conectar{
        /* Inicio CRUD Articulo*/
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
        /* Fin CRUD Articulo*/

        /* Inicio CRUD Img*/
        public function get_img(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM img";
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

            /* Fin CRUD Img*/

        /* Inicio CRUD Metodo de Pago*/
        public function get_metodopago(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM met_pago WHERE estado = 'Activo'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        /* Fin CRUD Metodo de Pago*/

        /* Inicio CRUD Usuarios*/ 
    public function get_usuario(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM usuario WHERE estado = 'Activo'";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_usuario_des(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM usuario WHERE estado = 'Inactivo'";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_usuario_x_id($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM usuario WHERE id_user = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_usuario($nombre,$apellido,$correo,$pass,$tip_user,$estado){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO articulos(nombre,apellido,correo,pass,tip_user,estado) 
        VALUES 
        (NULL,'$nombre','$apellido','$correo','$pass','$pass','$tip_user','$estado');";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
        }
        return $sql->errorInfo();
    }

    public function update_usuario($id,$nombre,$apellido,$correo,$pass,$tip_user,$estado){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE articulos set
            nombre = '$nombre',
            apellido = '$apellido',
            correo = '$correo',
            pass = '$pass',
            tip_user = '$tip_user',
            estado = '$estado'
            WHERE id_user = $id";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
         }
        return $sql->errorInfo();
    }

    public function delete_usuario($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE usuario set
            estado = 'Inactivo'
            WHERE
            id_user = $id";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    /* Fin CRUD Usuarios*/ 

    /* Inicio CRUD Tipo de Usuario*/
    public function get_tipouser(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM tipo_usuario";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_tipouser_x_id($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM tipo_usuario WHERE id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert_tipouser($rol,$fecha_sus){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO tipo_usuario(id,rol,fecha_sus)) 
        VALUES 
        (NULL,'$rol','$fecha_sus');";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
        }
        return $sql->errorInfo();
    }
    public function update_tipouser($id,$rol,$fecha_sus)
    {
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE articulos set
            rol = '$rol',
            fecha_sus = '$fecha_sus'
            WHERE id = $id"; 
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
         }
        return $sql->errorInfo();
    }
    public function delete_tipouser($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="DELETE FROM tipo_usuario WHERE id = $id";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /* Fin CRUD Tipo de Usuario*/

    /* Inicio CRUD Sub_Categoria*/
    public function get_subcategoria(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM sub_categoria WHERE estado = 'Activo'";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_subcategoria_x_id($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM sub_categoria WHERE nombre_sub = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert_subcategoria($nombre_sub,$id_categoria,$descripcion,$estado){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO sub_categoria(nombre_sub,id_categoria,descripcion,estado) 
        VALUES 
        ('$nombre_sub','$id_categoria','$descripcion','$estado');";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
        }
        return $sql->errorInfo();
    }
    public function update_subcategoria($nombre_sub,$id_categoria,$descripcion,$estado){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE sub_categoria set
            nombre_sub = '$nombre_sub',
            id_categoria = '$id_categoria',
            descripcion = '$descripcion',
            estado = '$estado'
            WHERE nombre_sub = $nombre_sub";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
         }
        return $sql->errorInfo();
    }
    public function delete_subcategoria($nombre_sub){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE sub_categoria set
            estado = 'Inactivo'
            WHERE
            nombre_sub = $nombre_sub";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    /* Fin CRUD Sub_Categoria*/

    /* Inicio CRUD Categoria*/
    public function get_categoria(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM categoria WHERE estado = 'Activo'";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_categoria_des(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM categoria WHERE estado = 'Inactivo'";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_categoria_x_id($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM categoria WHERE id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert_categoria($nombre,$descripcion,$estado){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO categoria(nombre_categoria,descripcion,estado) 
        VALUES 
        ('$nombre','$descripcion','$estado');";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
        }
        return $sql->errorInfo();
    }
    public function update_categoria($id,$nombre,$descripcion,$estado){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE categoria set
            nombre_categoria = '$nombre',
            descripcion = '$descripcion',
            estado = '$estado'
            WHERE id = $id";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
         }
        return $sql->errorInfo();
    }
    public function delete_categoria($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE categoria set
            estado = 'Inactivo'
            WHERE
            id = $id";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    /* Fin CRUD Categoria*/

     /*suscripcion*/
     public function get_suscripcion(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM suscripcion ";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    
    
    }
    /*fin*/
}

