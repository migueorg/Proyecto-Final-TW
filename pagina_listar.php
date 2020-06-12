<?php
require_once("conexionBD.php");
function HTMLpag_listarecetas(){
    
    $db = ConectarDB();    
    if($db){
        if( isset($_SESSION['tipo']) && $_SESSION['tipo']=='administrador' ){    //Si soy administrador busco todas las recetas
            $res = mysqli_query($db,"SELECT * FROM recetas ");
        }else if($_SESSION['tipo']=='colaborador'){
            $id = ObtenerId($_SESSION['email']);
            $res = mysqli_query($db,"SELECT * FROM recetas WHERE idautor='".$id."'");    //Si soy colaborador busco solo mis recetas
            $autor = $_SESSION['nombre'];
        }       
        
        $tupla=mysqli_fetch_all($res,MYSQLI_ASSOC);

        echo "<div class='cuerpo'><main>
            <ul>";
                for($i=0; $i < count($tupla); $i++){
                    $array_nombres[] = $tupla[$i]['nombre'];
                    $array_autor[] = $tupla[$i]['idautor'];
                    $autor = ObtenerAutor($array_autor[$i]);
                    echo "<li class='botoneslista'><p>Título receta:</p><p>".$array_nombres[$i]."</p>";
                    echo "<p>Autor:</p><p>".$autor."</p>";
                    echo "<div><form action='index.php?p=editar_receta' method='post'>";
                    echo "<input type='submit' name='editar' value='Editar'/></form>";
                    echo "<form action='index.php?p=ver_receta' method='post'>";
                    echo "<input type='submit' name='ver' value='Ver'/></form>";
                    echo "<form action='index.php?p=borrar_receta' method='post'>";
                    echo "<input type='submit' name='borrar' value='Borrar'/></form></div>";
                    echo "</li>";
                }
                
            echo "</ul></main>";
    }
}
?>