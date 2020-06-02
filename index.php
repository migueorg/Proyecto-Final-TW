<?php

require "inicio.php";
require "header.php";
require "asider.php";
require "footer.php";
require "nav.php";
require "pagina_inicio.php";
require "claseFormularios.php";
require "registrar.php";

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