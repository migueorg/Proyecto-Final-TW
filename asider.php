<?php
function HTMLasider() {
echo <<< HTML
<aside>


HTML;
if(!isset($_SESSION['usuario'])){
echo <<< HTML
<section class="lateral">
<h4 class="eliminar">Login</h4>
<form action="validar.php" method="post">
<label><span>Usuario:</span><input type="text" name="usuario" size="short"></label>
<label><span>Clave:</span><input type="text" name="clave"></label>
<input type="submit" name="login" value="Login"/>
</form>
</section>
HTML;
}
else{
echo <<< HTML
<section class="lateral">
<form action="validar.php" method="post">
HTML;
echo "<p>Bienvenido, ".$_SESSION['usuario'].", has iniciado sesión correctamente"."</p>";
echo <<< HTML
<input type="submit" name="logout" value="Logout"/>
</form>
</section>   
HTML;
}
echo <<< HTML
<section class="lateral eliminar">
<h4>+ valoradas</h4>
<ol>
<li>Risotto de calabaza
y champiñones</li>
<li>Pollo al salmorejo</li>
<li>Ensalada de
espinacas y mango</li>
</ol> 
</section>

<section class="lateral eliminar">
<h4>nº recetas</h4>
HTML;
$db = mysqli_connect("localhost","josepablomm1920","L6UEeYVf","josepablomm1920");
mysqli_set_charset($db,"utf8");
$res = mysqli_query($db,"SELECT Título,Autor,Categoría FROM web_recetas");
echo "<p>El sitio contiene ".mysqli_num_rows($res)." recetas diferentes</p>";
mysqli_close($db);
echo <<< HTML
</section>

</aside>

</div>
HTML;
}
?>