<?php

require_once "registrar.php";
require_once "conexionBD.php"
function HTMLpag_editar() {
    if(session_status()==PHP_SESSION_NONE)
    session_start();

    if(!isset($_SESSION['obj_edit'])){
        //echo "No esta creado";
        $objF_edit = new Formularios;
        $_SESSION['obj_edit'] = $objF_edit;
        $objF_edit->$nombre=ObtenerNombre($_SESSION['email']);
        $objF_edit->$apellidos=ObtenerApellidos($_SESSION['email']);
        $objF_edit->$correo=$_SESSION['email'];
        $objF_edit->$foto=ObtenerFoto($_SESSION['email']);
        $objF_edit->$tipo=ObtenerTipoUsuario($_SESSION['email']);
        $objF_edit->$direccion=ObtenerDireccion($_SESSION['email']);

    }//else echo "Ya esta crado el objeto";

    formularioRegistroBase($objF_edit);
}
?>