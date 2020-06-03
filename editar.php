<?php

require_once "registrar.php";
function HTMLpag_editar() {
    if(session_status()==PHP_SESSION_NONE)
    session_start();

    if(!isset($_SESSION['obj_edit'])){
        //echo "No esta creado";
        $objF_edit = new Formularios;
        $_SESSION['obj_edit'] = $objF_edit;
    }//else echo "Ya esta crado el objeto";

    formularioRegistroBase($objF_edit);
}
?>