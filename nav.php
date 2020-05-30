<?php
function HTMLnavegacion($activo) {
echo <<< HTML
<nav>
HTML;
$items = ["Inicio", "Lista recetas", "Contacto"]; //texto
$links = ["inicio", "lista_recetas", "contacto"]; //url
foreach ($items as $k => $v)
echo "<li>"."<a href='index.php?p=".$links[$k]."'>".$v."</a></li>";
if(isset($_SESSION['usuario']))
echo "<li>"."<a href='index.php?p=anadir_receta'>Añadir receta</a></li>";
echo <<< HTML
</nav>
HTML;
}
?>