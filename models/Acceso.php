<?php
class Acceso extends Conectar{
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
        $sql="SELECT * FROM usuario WHERE id = '$id'";
        $sql=$conectar->prepare($sql);
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
            WHERE id = $id";
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
            id = '$id'";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    /* Inicio CRUD Usuarios*/ 
}

?>