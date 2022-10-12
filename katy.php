<?php
class katy extends Conectar { 

    public function get_categoria(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM categoria WHERE estado = 'Activo' ";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function get_categoria_id($id){
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
        $sql="INSERT INTO categoria(id,nombre, descripcion,estado) VALUES (NULL,?,?,?);";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $descripcion);
        $sql->bindValue(3, $estado);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function update_categoria($id,$nombre,$descripcion,$estado){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE articulos set
            nombre = ?,
            descripcion = ?,
            estado = ?
            WHERE 
            id = ?
            ";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $descripcion);
        $sql->bindValue(3, $estado);
        $sql->bindValue(4, $id);
        $sql->execute();
     return $resultado=$sql->fetchAll();
    }
    
    public function delete_categoria($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE categoria set
            estado = 'Inactivo'
            WHERE
            id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /*suscripcion*/
    public function get_suscripcion(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM suscripcion ";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    
    
    }
}