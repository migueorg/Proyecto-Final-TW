<?php
require_once "credenciales.php";
require_once "claseFormularios.php";
function ConectarDB(){
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD,DB_DATABASE);
    mysqli_set_charset($db,"utf8");
    if (!$db)
        return "Error de conexión a la base de datos (".mysqli_connect_errno().") : ".mysqli_connect_error();
    else
        return $db;
}

function ObtenerClave($email){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT password FROM usuarios WHERE email='{$email}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $password = $db_tupla['password'];
        return $password;
    } else
        return null;
}

function ObtenerFoto($email){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT foto FROM usuarios WHERE email='{$email}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $foto = $db_tupla['foto'];
        return $foto;
    } else
        return null;
}

function ObtenerNombre($email){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT nombre FROM usuarios WHERE email='{$email}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $nombre = $db_tupla['nombre'];
        return $nombre;
    } else
        return null;

}

function ObtenerTipoUsuario($email){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT tipo FROM usuarios WHERE email='{$email}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $tipo = $db_tupla['tipo'];
        return $tipo;
    } else
        return null;

}

function ConsultaGeneral($select,$where){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT '{$select}' FROM usuarios WHERE '{$where}'='{$where}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $celda = $db_tupla[$where];
        return $celda;
    } else
        return null;

}

//FALTA introducir foto
function InsertarUsuarioBD(Formularios $objF){
    $db=conectarDB();
    if($db){
        $id_unico = uniqid();
        $nombre = addslashes( htmlentities( ucwords( $objF->nombre ) ) );
        $apellido = addslashes( htmlentities( ucwords( $objF->apellidos ) ) );
        $correo = addslashes( htmlentities( $objF->correo ) );
        $clave = addslashes( htmlentities( password_hash( $objF->clave, PASSWORD_DEFAULT ) ) );
        $rol = addslashes( htmlentities( $objF->rol ) ) ;
        $fotillo = $objF->foto;
        
        $consulta="INSERT INTO usuarios (id, nombre, apellidos, email, password, tipo, foto) VALUES ('$id_unico','$nombre','$apellido','$correo','$clave','$rol', '$fotillo')";
        
        $res = mysqli_query($db,$consulta) or trigger_error("Query Failed! SQL: $consulta - Error: ".mysqli_error($db), E_USER_ERROR);
        
        if($res){
            echo "<h1>Insertado correctamente</h1>";
        }else{
            echo "<h1>Fallo al insertar</h1>";
            
        }
    }else
        return null;

}

?>
