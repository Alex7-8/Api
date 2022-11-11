<?php
    class Categoria extends Conectar{
/* Inicio CRUD Articulo*/
        public function get_articulos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM articulo WHERE estado = 'Publicado'";
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

        public function insert_articulos($nom_articulo,$sub_categoria,$descripcion,$estado,$autor,$estilo){
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
            fechayhora,
            estilo) 
            VALUES
            (NULL,
            '$nom_articulo',
            '$sub_categoria',
            '$descripcion',
            '$estado',
            $autor,
            '$fecha',
            '$estilo')";
            $sql=$conectar->prepare($sql);
            if($sql->execute()){
                return "ok";
             }
            return $sql->errorInfo();
        }

        
        public function update_articulos($id,$nom_articulo,$sub_categoria,$descripcion,$estado,$autor,$estilo){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE articulo set
                nom_articulo = '$nom_articulo',
                sub_categoria = '$sub_categoria',
                descripcion = '$descripcion',
                estado = '$estado',
                autor = $autor
                estilo = '$estilo'
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
            if($sql->execute()){
                return "ok";
             }
            return $sql->errorInfo();
        }

        public function get_articulos_proc(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="select art.id,art.nom_articulo,art.sub_categoria,art.descripcion,art.estado,art.autor,art.fechayhora,ig.id_img,art.estilo,ig.id_art,ig.enlace,ig.fecha,ig.hora,ig.estado,usu.id_user,usu.nombre,usu.apellido from articulo art INNER JOIN img ig, usuario usu where art.estado = 'Publicado' and ig.id_art=art.id and usu.id_user = art.autor";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_articulos_pr($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="select art.id,art.nom_articulo,art.sub_categoria,art.descripcion,art.estado,art.autor,art.fechayhora,ig.id_img,art.estilo,ig.id_art,ig.enlace,ig.fecha,ig.hora,ig.estado,usu.id_user,usu.nombre,usu.apellido from articulo art INNER JOIN img ig, usuario usu where art.estado = 'Publicado' and ig.id_art=art.id and usu.id_user = art.autor and art.id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function insert_articulos_proc($nom_articulo,$sub_categoria,$descripcion,$estado,$autor,$enlace,$estilo){
            date_default_timezone_set('America/Guatemala');
            $conectar= parent::conexion();
            parent::set_names();
            // No Publicado Eliminado Archivado
            $fecha = date('Y-m-d H:i:s');
            $fechaimg = date('Y-m-d');
            $hora = date('H:i:s');
            $sql="CALL INSERT_ARTICULOS(?,?,?,?,?,?,?,?,?,?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $nom_articulo);
            $sql->bindValue(2, $sub_categoria);
            $sql->bindValue(3, $descripcion);
            $sql->bindValue(4, $estado);
            $sql->bindValue(5, $autor);
            $sql->bindValue(6, $fecha);
            $sql->bindValue(7, $enlace);
            $sql->bindValue(8, $fechaimg);
            $sql->bindValue(9, $hora);
            $sql->bindValue(10, $estado);
            $sql->bindValue(11, $estilo);
            if($sql->execute()){
                return "ok";
             }
            return $sql->errorInfo();
        }
        public function delete_articulos_proc($id,$id_img){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE articulo set
                estado = 'Eliminado'
                WHERE
                id = $id";
            $sql=$conectar->prepare($sql);
            if($sql->execute()){
                $sql="UPDATE img SET
                estado = 'Eliminado'
               WHERE id_img = $id_img";
            $sql=$conectar->prepare($sql);
            if($sql->execute()){
                return "ok";
            }
            }
            return $sql->errorInfo();
        }
        public function Activar_articulos($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE articulo set
                estado = 'Publicado'
                WHERE
                id = $id";
            $sql=$conectar->prepare($sql);
            if($sql->execute()){
                return "ok";
             }
            return $sql->errorInfo();
        }


        public function update_articulosIMG($id,$nom_articulo,$sub_categoria,$descripcion,$estado,$autor,$estilo,$id_img,$enlace,$fecha,$hora,$est){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE articulo set
                nom_articulo = '$nom_articulo',
                sub_categoria = '$sub_categoria',
                descripcion = '$descripcion',
                estado = '$estado',
                autor = $autor,
                fechayhora,
                estilo = '$estilo',
                WHERE id = $id";
            $sql=$conectar->prepare($sql);
            
            if($sql->execute()){
                return "ok";
                $sql=" UPDATE img SET
            id_art = '$id',
            enlace  = '$enlace',
            fecha = '$fecha',
            hora = '$hora',
            estado = '$est'
            WHERE id_img = $id_img";
            $sql=$conectar->prepare($sql);
            if($sql->execute()){
                return "ok";
             }
            return $sql->errorInfo();
             
            }
            return $sql->errorInfo();
        }
/* Fin CRUD Articulo*/

/* Inicio CRUD Img*/
 public function get_img(){
 $conectar= parent::conexion();
 parent::set_names();
 $sql="SELECT * FROM img WHERE estado = 'Publicado' ";
 $sql=$conectar->prepare($sql);
 $sql->execute();
 return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
 }
 public function get_img_Des(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM img WHERE estado = 'Eliminado' || estado = 'Archivado' || estado = 'No Publicado' ";
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
        public function insert_img($id_art,$enlace){
            date_default_timezone_set('America/Guatemala');
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO img
            (id_img,
            id_art,
            enlace,
            fecha,
            hora,
            estado)
            VALUES
            (NULL,
            '$id_art',
            '$enlace',
            '$fecha',
            '$hora',
            'Publicado')";
            $sql=$conectar->prepare($sql);
            if($sql->execute()){
                return "ok";
             }
            return $sql->errorInfo();
        }
        public function update_img($id_img,$id_art,$enlace,$estado){
            date_default_timezone_set('America/Guatemala');
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $conectar= parent::conexion();
            parent::set_names();
            $sql=" UPDATE img SET
            id_art = '$id_art',
            enlace  = '$enlace',
            fecha = '$fecha',
            hora = '$hora',
            estado = '$estado'
            WHERE id_img = $id_img";
            $sql=$conectar->prepare($sql);
            if($sql->execute()){
                return "ok";
             }
            return $sql->errorInfo();
        }
        public function delete_img($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE img SET
            estado = 'Eliminado'
             WHERE id_img = $id";
            $sql=$conectar->prepare($sql);
            if($sql->execute()){
                return "ok";
             }
            return $sql->errorInfo();
        }

/* Fin CRUD Img*/
/* Inicio CRUD Pago*/
        public function get_pago(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM pago WHERE estado = 'Activo'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_pago_Des(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM pago WHERE estado = 'Inactivo' || estado = 'Eliminado'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_pagoId($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM pago WHERE id_metP = $id";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function insert_pago($id_metP,$nombtarjeta,$numtarjeta,$vencimiento,$cvv){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO pago
            (id_metP,
            nombtarjeta,
            numtarjeta,
            vencimiento,
            cvv,
            estado)
            VALUES
            ('$id_metP',
            '$nombtarjeta',
            '$numtarjeta',
            '$vencimiento',
            '$cvv',
            'Activo')";
            $sql=$conectar->prepare($sql);
            if($sql->execute()){
                return "ok";
             }
            return $sql->errorInfo();
        }
        public function update_pago($id_metP,$nombtarjeta,$numtarjeta,$vencimiento,$cvv,$estado){
            $conectar= parent::conexion();
            parent::set_names();
            $sql=" UPDATE pago SET
            nombtarjeta = '$nombtarjeta',
            numtarjeta = '$numtarjeta',
            vencimiento = '$vencimiento',
            cvv = '$cvv',
            estado = '$estado'
            WHERE id_metP = $id_metP";
            $sql=$conectar->prepare($sql);
            if($sql->execute()){
                return "ok";
             }
            return $sql->errorInfo();
        }
        public function delete_pago($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE pago SET
            estado = 'Eliminado'
             WHERE id_metP = $id";
            $sql=$conectar->prepare($sql);
            if($sql->execute()){
                return "ok";
             }
            return $sql->errorInfo();
        }
/* Fin CRUD Pago*/
/* Inicio CRUD Metodo de Pago*/
        public function get_metodopago(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM met_pago WHERE estado = 'Activo'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_metodopago_Des(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM met_pago WHERE estado = 'Inactivo' || estado = 'Eliminado'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_metodopago_x_id($id_metP){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM met_pago WHERE id_metP = $id_metP";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function insert_metodopago($id_user,$nombre,$apellido,$telefono,$correo,$pais,$direccion,$nit){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO met_pago
            (id_metP,
            id_user,
            nombre,
            apellido,
            telefono,
            correo,
            pais,
            direccion,
            nit,
            estado)
            VALUES
            (
            NULL,
            '$id_user',
            '$nombre',
            '$apellido',
            '$telefono',
            '$correo',
            '$pais',
            '$direccion',
            '$nit',
            'Activo')";
            $sql=$conectar->prepare($sql);
            if($sql->execute()){
                return "ok";
             }
            return $sql->errorInfo();
        }
        public function update_metodopago($id_metP,$id_user,$nombre,$apellido,$telefono,$correo,$pais,$direccion,$nit,$estado){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE met_pago SET
            id_user = '$id_user',
            nombre = '$nombre',
            apellido = '$apellido',
            telefono = '$telefono',
            correo = '$correo',
            pais = '$pais',
            direccion = '$direccion',
            nit = '$nit',
            estado = '$estado'
            WHERE id_metP = $id_metP";
            $sql=$conectar->prepare($sql);
            if($sql->execute()){
                return "ok";
             }
            return $sql->errorInfo();
        }
        public function delete_metodopago($id_metP){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE met_pago SET
            estado = 'Eliminado'
            WHERE id_metP = $id_metP";
            $sql=$conectar->prepare($sql);
            if($sql->execute()){
                return "ok";
             }
            return $sql->errorInfo();
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

    public function insert_usuario($usuario,$nombre,$apellido,$correo,$pass,$tip_user,$img,$descripcion){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO usuario(id_user,usuario,nombre,apellido,correo,pass,tip_user,estado,img,descripcion) 
        VALUES 
        (NULL,'$usuario','$nombre','$apellido','$correo','$pass','$tip_user','Activo','$img','$descripcion');";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
        }
        return $sql->errorInfo();
    }

    public function update_usuario($id_user,$nombre,$apellido,$correo,$pass,$tip_user,$estado,$img,$descripcion){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE usuario set
            nombre = '$nombre',
            apellido = '$apellido',
            correo = '$correo',
            pass = '$pass',
            tip_user = '$tip_user',
            estado = '$estado',
            img = '$img',
            descripcion = '$descripcion'
            WHERE id_user = $id_user";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
         }
        return $sql->errorInfo();
    }

    public function update_usuario_adm($id_user,$nombre,$apellido,$correo,$pass,$tip_user,$estado,$img,$descripcion){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE usuario set
            nombre = '$nombre',
            apellido = '$apellido',
            correo = '$correo',
            pass = '$pass',
            tip_user = '$tip_user',
            estado = '$estado',
            img = '$img',
            descripcion = '$descripcion'
            WHERE id_user = $id_user";
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
        if($sql->execute()){
            return "ok";
         }
        return $sql->errorInfo();
    }
    public function get_user_inner(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT usu.id_user, usu.usuario, usu.nombre, usu.apellido, usu.correo, tp.rol, usu.estado, usu.img FROM usuario as usu INNER JOIN tipo_usuario as tp WHERE usu.estado='Activo' AND tp.id = usu.tip_user";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_user_x_innerId($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT usu.id_user,usu.usuario, usu.nombre, usu.apellido, usu.correo,usu.pass,tp.rol, usu.estado, usu.img, usu.descripcion FROM usuario as usu INNER JOIN tipo_usuario as tp WHERE usu.id_user='$id' AND tp.id = usu.tip_user";
        $sql=$conectar->prepare($sql);
       // $sql->bindValue(1, $id);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_user_inner_Des(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT usu.id_user, usu.usuario,usu.nombre, usu.apellido, usu.correo, tp.rol, usu.estado, usu.img FROM usuario as usu INNER JOIN tipo_usuario as tp WHERE usu.estado='Inactivo' AND tp.id = usu.tip_user";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function Activar_usuario($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE usuario set
            estado = 'Activo'
            WHERE
            id_user = $id";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
         }
        return $sql->errorInfo();
    }
    public function get_user($usu,$pass){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM usuario WHERE usuario = ? AND pass = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $usu);
        $sql->bindValue(2, $pass);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_usern($usu,$pass){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM usuario WHERE usuario = ? AND pass = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $usu);
        $sql->bindValue(2, $pass);
        if($sql->execute() != null){
            return "ok";
         }
            return $sql->errorInfo();
         
        //return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }


    public function insert_us($usuario,$nombre,$apellido,$correo,$pass,$tip_user,$img,$descripcion,$telefono,$pais,$direccion,$nit,$nombtarjeta,$numtarjeta,$vencimiento,$cvv){
        date_default_timezone_set('America/Guatemala');
        $conectar= parent::conexion();
        parent::set_names();
        // No Publicado Eliminado Archivado
        $fecha = date('Y-m-d H:i:s');
        $fechaimg = date('Y-m-d');
        $hora = date('H:i:s');
        $sql="CALL INSERT_Us(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $usuario);
        $sql->bindValue(2, $nombre);
        $sql->bindValue(3, $apellido);
        $sql->bindValue(4, $correo);
        $sql->bindValue(5, $pass);
        $sql->bindValue(6, $tip_user);
        $sql->bindValue(7, 'Activo');
        $sql->bindValue(8, $img);
        $sql->bindValue(9, $descripcion);
        $sql->bindValue(10, $telefono);
        $sql->bindValue(11, $pais);
        $sql->bindValue(12, $direccion);
        $sql->bindValue(13, $nit);
        $sql->bindValue(14, $nombtarjeta);
        $sql->bindValue(15, $numtarjeta);
        $sql->bindValue(16, $vencimiento);
        $sql->bindValue(17, $cvv);
      
        if($sql->execute()){
            return "ok";
         }
        return $sql->errorInfo();
    }
/* Fin CRUD Usuarios*/ 

/* Inicio CRUD Tipo de Usuario*/
    public function get_tipouser(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM tipo_usuario WHERE estado = 'Activo'";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function get_tipouserDes(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM tipo_usuario WHERE estado = 'Inactivo'";
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
    public function insert_tipouser($rol){
        date_default_timezone_set('America/Guatemala');
        $fecha_sus = date("Y-m-d H:i:s");
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO tipo_usuario(id,rol,fecha_sus,estado) 
        VALUES 
        (NULL,'$rol','$fecha_sus','Activo');";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
        }
        return $sql->errorInfo();
    }
    public function update_tipouser($id,$rol,$estado) {
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE tipo_usuario set
            rol = '$rol',
            estado = '$estado'
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
        $sql="UPDATE tipo_usuario set
            estado = 'Inactivo'
            WHERE
            id = $id";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
         }
        return $sql->errorInfo();
    }

/* Fin CRUD Tipo de Usuario*/

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
 public function insert_categoria($nombre,$descripcion){
    $conectar= parent::conexion();
    parent::set_names();
    $sql="INSERT INTO categoria(nombre,descripcion,estado) 
    VALUES 
    ('$nombre','$descripcion','Activo');";
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
        nombre = '$nombre',
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
    if($sql->execute()){
        return "ok";
     }
    return $sql->errorInfo();
 }
/* Fin CRUD Categoria*/

/* Inicio CRUD Sub_Categoria*/
public function get_categor($nombre){
    $conectar= parent::conexion();
    parent::set_names();
    $sql="SELECT nombre FROM categoria INNER JOIN subcategoria ON categoria.id = subcategoria.id_categoria where nombre_sub='$nombre'";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $retorno=$sql->fetchAll(PDO::FETCH_ASSOC);
}

    public function get_subcategoria(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM subcategoria WHERE estado = 'Activo'";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_subcategoria_des(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM subcategoria WHERE estado = 'Inactivo'";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_subcategoria_x_id($nomb){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM subcategoria WHERE nombre_sub = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $nomb);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert_subcategoria($nombre_sub,$id_categoria,$descripcion){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO subcategoria(nombre_sub,id_categoria,descripcion,estado) 
        VALUES 
        ('$nombre_sub','$id_categoria','$descripcion','Activo');";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
        }
        return $sql->errorInfo();
    }
    public function update_subcategoria($nombre_sub,$id_categoria,$descripcion,$estado){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE subcategoria set
            nombre_sub = '$nombre_sub',
            id_categoria = '$id_categoria',
            descripcion = '$descripcion',
            estado = '$estado'
            WHERE nombre_sub = '$nombre_sub'";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
         }
        return $sql->errorInfo();
    }
    public function delete_subcategoria($nomb){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE subcategoria set
            estado = 'Inactivo'
            WHERE
            nombre_sub = '$nomb'";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
         }
        return $sql->errorInfo()+$nomb;
    }
/* Fin CRUD Sub_Categoria*/

   
/*suscripcion*/
    public function get_suscripcion(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM suscripcion WHERE estado = 'Activo'";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
     }
    public function get_suscripcion_des(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM suscripcion WHERE estado = 'Inactivo'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
    public function get_suscripcion_x_id($id_sus){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM suscripcion WHERE id_sus = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id_sus);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

    }
    public function insert_suscripcion($id_user){
        date_default_timezone_set('America/Guatemala');
        $fecha_sus = date('Y-m-d');
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO suscripcion(id_sus,id_user,fecha_sus,estado) 
        VALUES 
        (NULL,'$id_user','$fecha_sus','Activo');";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
        }
        return $sql->errorInfo();
    }
    public function update_suscripcion($id_sus,$id_user,$fecha,$estado){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE suscripcion set
            fecha_sus = '$fecha',
            estado = '$estado'
            WHERE id_sus = '$id_sus'";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
         }
        return $sql->errorInfo();
    }
    public function delete_suscripcion($id_sus){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE suscripcion SET  
        estado = 'Inactivo' WHERE id_sus = $id_sus";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
         }
        return $sql->errorInfo();
    }
/*fin*/

/* Inicio CR Acceso*/
    public function get_acceso(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM acceso";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_acceso_x_id($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM acceso WHERE id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
     return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert_acceso($id_user,$id_art,$direccion,$direccion2,$conteo){
        $conectar = parent::conexion();
        parent::set_names();
        $sql="INSERT INTO 
        acceso(
        id,
        id_user,
        id_art,
        direccion,
        direccion2,
        conteo) VALUES 
        (Null,
        '$id_user',
        '$id_art',
        '$direccion',
        '$direccion2',
        '$conteo');";
         $sql=$conectar->prepare($sql);
         if($sql->execute()){
             return "ok";
         }
         return $sql->errorInfo();
    }
    public function update_acceso($id,$id_user,$id_art,$direccion,$direccion2,$conteo){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE acceso set
            id_user = '$id_user',
            id_art = '$id_art',
            direccion = '$direccion',
            direccion2 = '$direccion2',
            conteo = '$conteo'
            WHERE id = $id";
        $sql=$conectar->prepare($sql);
        if($sql->execute()){
            return "ok";
         }
        return $sql->errorInfo();
    }
    
/* Fin CRU Acceso*/
    
/* Inicio CR Bitacora*/
    public function get_bitacora(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM bitacora";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_bitacora_x_id($id_bit){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM bitacora WHERE id_bit = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id_bit);
        $sql->execute();
     return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert_bitacora($id_art,$id_user,$cambios){
        date_default_timezone_set('America/Guatemala');
        $fecha_mod = date('Y-m-d H:i:s');
        $conectar = parent::conexion();
        parent::set_names();
        $sql="INSERT INTO 
        bitacora(
        id_bit,
        id_art,
        id_user,
        cambios,
        fecha_mod) VALUES
        (Null,
        '$id_art',
        '$id_user',
        '$cambios',
        '$fecha_mod');";
         $sql=$conectar->prepare($sql);
         if($sql->execute()){
             return "ok";
         }
         return $sql->errorInfo(); 
    }

/* Fin CR Bitacora*/

}

