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
//    switch ($_GET['p']) {
//        case "inicio": 
//            HTMLpag_inicio(); 
//            if(isset($_SESSION['objU'])) 
//                unset($_SESSION['objU']); 
//            if(isset($_SESSION['obj_editar'])) 
//                unset($_SESSION['obj_editar']);
//            if(isset($_SESSION['objR'])) 
//                unset($_SESSION['objR']);
//            break;
//
//        case "registrar": simulaIndex($_SESSION['objU']); break;
//        case "ver_recetas": simulaIndexListaRecetas();break;
//        case "editar": simulaIndexEditar($_SESSION['obj_editar']); break;
//        case "anadir_receta": simulaIndexAnadirReceta($_SESSION['objR']); break;
//        case "gestion_usuarios": simulaIndexGestionUsuarios(); break;
//        case "editar_receta": simulaIndexEditarReceta($_SESSION['objR']);break;
//        case "ver_log": HTMLpag_log();break;
//        case "ver_mis_recetas": simulaIndexListaMisRecetas(); break;
//        case "nuevo_coment": simulaIndexComentario(); break;
//        case "inicializa_editar": inicializaYRedirigeEditar(); break;
//        default: HTMLpag_inicio(); break;
//    }

}else if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'colaborador'){

    switchCaseColab($_GET['p']);
//    switch ($_GET['p']) {
//        case "inicio": 
//            HTMLpag_inicio(); 
//            if(isset($_SESSION['objU'])) 
//                unset($_SESSION['objU']); 
//            if(isset($_SESSION['obj_editar'])) 
//                unset($_SESSION['obj_editar']);
//            if(isset($_SESSION['objR'])) 
//                unset($_SESSION['objR']);
//            break;
//
//        case "registrar": simulaIndex($_SESSION['objU']); break;
//        case "ver_recetas": simulaIndexListaRecetas();break;
//        case "editar": simulaIndexEditar($_SESSION['obj_editar']); break;
//        case "anadir_receta": simulaIndexAnadirReceta($_SESSION['objR']); break;
//        case "editar_receta": simulaIndexEditarReceta($_SESSION['objR']);break;
//        case "ver_mis_recetas": simulaIndexListaMisRecetas(); break;
//        case "nuevo_coment": simulaIndexComentario(); break;
//        default: HTMLpag_inicio(); break;
//    }

}else{

    switchCaseColab($_GET['p']);
//    switch ($_GET['p']) {
//        case "inicio": 
//            HTMLpag_inicio(); 
//            if(isset($_SESSION['objU'])) 
//                unset($_SESSION['objU']); 
//            break;
//
//        case "registrar": simulaIndex($_SESSION['objU']); break;
//        case "ver_recetas": simulaIndexListaRecetas();break;
//
//        default: HTMLpag_inicio(); break;
//    }

}

HTMLasider();
HTMLfooter();

?>