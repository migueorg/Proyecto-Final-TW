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

if(session_status()==PHP_SESSION_NONE)
session_start();

if(!isset($_SESSION['obj'])){
    //echo "No esta creado";
    $objF = new Formularios;
    $_SESSION['obj'] = $objF;
}//else echo "Ya esta crado el objeto";

if(!isset($_SESSION['obj_editar'])){
    //echo "No esta creado";
    $objF_editar = new Formularios;
    $_SESSION['obj_editar'] = $objF_editar;
}//else echo "Ya esta crado el objeto";

if(!isset($_SESSION['objR'])){
    $objR = new Recetas;
    $_SESSION['objR'] = $objR;
}

if(!isset($_GET['p']))
    $_GET['p'] = "inicio";

HTMLinicio();
HTMLheader();

HTMLnavegacion($_GET['p']);

switch ($_GET['p']) {
    case "inicio": 
        HTMLpag_inicio(); 
        if(isset($_SESSION['obj'])) 
            unset($_SESSION['obj']); 
        if(isset($_SESSION['obj_editar'])) 
            unset($_SESSION['obj_editar']);
        if(isset($_SESSION['objR'])) 
            unset($_SESSION['objR']);
        break;

    case "registrar": simulaIndex($_SESSION['obj']); break;
    case "editar": simulaIndexEditar($_SESSION['obj_editar']); break;
    case "anadir_receta": simulaIndexAnadirReceta($_SESSION['objR']); break;
    default: HTMLpag_inicio(); break;
}

HTMLasider();
HTMLfooter();

?>