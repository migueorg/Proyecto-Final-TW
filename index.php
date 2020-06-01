<?php

require "inicio.php";
require "header.php";
require "asider.php";
require "footer.php";
require "nav.php";
require "pagina_inicio.php";

if(session_status()==PHP_SESSION_NONE)
session_start();

if(!isset($_GET['p']))
    $_GET['p'] = "inicio";

HTMLinicio();
HTMLheader();

HTMLnavegacion($_GET['p']);

switch ($_GET['p']) {
    case "inicio": HTMLpag_inicio(); break;

    default: HTMLpag_inicio(); break;
}

HTMLasider();
HTMLfooter();

?>