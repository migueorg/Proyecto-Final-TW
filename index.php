<?php


require "inicio.php";
require "header.php";
require "asider.php";
require "footer.php";
require_once "nav.php";
require_once "pagina_inicio.php";
require_once "claseFormularios.php";
require_once "registrar.php";
require_once "editar.php";
require_once "anadir_receta.php";
require_once "gestionUsuarios.php";
require_once "pagina_listar.php";
require_once "log.php";
require_once "comentarios.php";
require_once "insertar_imagenes.php";

if(session_status()==PHP_SESSION_NONE)
session_start();

if(!isset($_SESSION['objU'])){
    $objF = new Formularios;
    $_SESSION['objU'] = $objF;
}

if(!isset($_SESSION['obj_editar'])){
    $objF_editar = new Formularios;
    $_SESSION['obj_editar'] = $objF_editar;
}

if(!isset($_SESSION['objR'])){
    $objR = new Recetas;
    $_SESSION['objR'] = $objR;
}

if(!isset($_GET['p']))
    $_GET['p'] = "inicio";

HTMLinicio();
HTMLheader();

HTMLnavegacion($_GET['p']);


if( isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador'){

    switchCaseAdmin($_GET['p']);


}else if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'colaborador'){

    switchCaseColab($_GET['p']);


}else{

    switchCaseCualquiera($_GET['p']);


}

HTMLasider();
HTMLfooter();

?>