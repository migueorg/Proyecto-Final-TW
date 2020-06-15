<?php
function HTMLnavegacion($activo) {
echo <<< HTML
<nav>
HTML;
$items = ["Inicio", "Listado de Recetas", "Registrar Usuario"]; //texto
$links = ["inicio", "ver_recetas", "registrar"]; //url
foreach ($items as $k => $v)
echo "<li>"."<a href='index.php?p=".$links[$k]."'>".$v."</a></li>";
if(isset($_SESSION['tipo'])){
    echo "<li>"."<a href='index.php?p=ver_mis_recetas'>Ver Mis Recetas</a></li>";
    if($_SESSION['tipo']=='colaborador' || $_SESSION['tipo']=='administrador' ){
        echo "<li>"."<a href='index.php?p=anadir_receta'>Añadir nueva receta</a></li>";
    } 
    if($_SESSION['tipo']=='administrador'){
        echo "<li>"."<a href='index.php?p=gestion_usuarios'>Gestión usuarios</a></li>";
        echo "<li>"."<a href='index.php?p=ver_log'>Ver log</a></li>";
        //echo "<li>"."<a href='index.php?p=gestion_bbdd'>Gestión BBDD</a></li>";
   } 
}
echo <<< HTML
</nav>
HTML;
}
?>