<?php
require_once 'conexionBD.php';
$db=ConectarDB();
if(session_status()==PHP_SESSION_NONE)
    session_start();


if(isset($_POST['login'])){
    if(isset($_POST['email']) && isset($_POST['clave'])){
        if(!empty($_POST['email']) && !empty($_POST['clave'])){
            $email=$_POST['email'];
            $clave=$_POST['clave'];
            $hash = ObtenerClave($email);
            if(password_verify ($clave , $hash)){ 
                $_SESSION['email']=$email;
                $_SESSION['nombre']=ObtenerNombre($email);
                $_SESSION['foto']=ObtenerFoto($email);
                $_SESSION['tipo']=ObtenerTipoUsuario($email);
                $evento_log = "El usuario ".$email." se ha logueado";
                InsertarLog($evento_log);
            } else{
                $_SESSION['incorrecto'] = true;
                $evento_log = "El usuario ".$email." se ha logueado sin éxito";
                InsertarLog($evento_log);
            }
        } else{
            $_SESSION['rellenar'] = true;
        }
    } 
}
else{
    // La sesión debe estar iniciada
    if (session_status()==PHP_SESSION_NONE)
    session_start(); 
    $evento_log = "El usuario ".$_SESSION['email']." ha salido del sistema";
    InsertarLog($evento_log);
    // Borrar variables de sesión
    //$_SESSION = array();
    session_unset();
    // Destruir sesión
    session_destroy();
}
mysqli_close($db);
header('Location: index.php');
?>

