<?php
function HTMLasider() {
    require_once "conexionBD.php";
    echo '<aside>';

    if(!isset($_SESSION['email'])){
        echo <<< HTML
        <section class="lateral">
            <h4 class="eliminar">Login</h4>
            <form action="validar.php" method="post">
                <p>Email:</p>
                <label ><input class="login" type="text" name="email" size="short"></label>
                <p>Clave:</p>
                <label><input class="login" type="text" name="clave"></label>
                <input type="submit" name="login" value="Login"/>
HTML;
        if(isset($_SESSION['incorrecto']))
            echo '<p class=error>Credenciales no válidas</p>';
        elseif(isset($_SESSION['rellenar']))
        echo '<p class=error>Por favor, rellene los campos</p>';
        echo <<< HTML
            </form>
        </section>
HTML;
    } else{
        echo "<section class='lateral'>";
        echo "<img src='data:image/jpg;base64, ";
        echo base64_encode($_SESSION['foto']);
        echo "'width='200' />";
        echo "<p>Bienvenido/a, ".$_SESSION['nombre'].", has iniciado sesión correctamente"."</p>";
        echo <<< HTML
        
            <form action="validar.php" method="post">
HTML;
        
        echo <<< HTML
                <input type="submit" name="logout" value="Logout"/>
                

            </form>
            <form action="editar.php" method="post">
                <input type="submit" name="editar" value="Editar"/>
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
        $db = ConectarDB();
        $res = mysqli_query($db,"SELECT id FROM recetas");
        echo "<p>El sitio contiene ".mysqli_num_rows($res)." recetas diferentes</p>";
        mysqli_close($db);
        echo <<< HTML
    </section>

    </aside>

    </div>
HTML;
unset($_SESSION['incorrecto']);
unset($_SESSION['rellenar']);
}
?>