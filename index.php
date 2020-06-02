<?php

require "inicio.php";
require "header.php";
require "asider.php";
require "footer.php";
require_once "nav.php";
require_once "pagina_inicio.php";
require_once "claseFormularios.php";
require_once "registrar.php";

if(session_status()==PHP_SESSION_NONE)
session_start();

if(!isset($_SESSION['obj'])){
    //echo "No esta creado";
    $objF = new Formularios;
    $_SESSION['obj'] = $objF;
}//else echo "Ya esta crado el objeto";

if(!isset($_GET['p']))
    $_GET['p'] = "inicio";

HTMLinicio();
HTMLheader();

HTMLnavegacion($_GET['p']);

switch ($_GET['p']) {
    case "inicio": HTMLpag_inicio(); if(isset($_SESSION['obj'])) unset($_SESSION['obj']); break;
    case "registrar": simulaIndex($_SESSION['obj']); break;
    //Ojo con ese 
    default: HTMLpag_inicio(); break;
}

HTMLasider();
HTMLfooter();

?>