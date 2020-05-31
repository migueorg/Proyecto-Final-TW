<?php
if(session_status()==PHP_SESSION_NONE)
    session_start();
    
if(isset($_POST['login'])){

    if(isset($_POST['usuario']) && isset($_POST['clave'])){
        if(!empty($_POST['usuario']) && !empty($_POST['clave'])){
            $usuario=$_POST['usuario'];
            $clave=$_POST['clave'];
            if($usuario=='admin' && $clave=='clave')
                $_SESSION['usuario']=$usuario;
        }
    }

}
else{
// La sesión debe estar iniciada
if (session_status()==PHP_SESSION_NONE)
session_start();     //No podemos borrar una variable que no existe, por si acaso la creo y la borro
// Borrar variables de sesión
//$_SESSION = array();
session_unset();
// Destruir sesión
session_destroy();
}
header('Location: index.php');
?>

