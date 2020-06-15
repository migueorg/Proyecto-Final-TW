<?php
require_once("conexionBD.php");
function HTMLmostar_receta($id){
    //echo "<div class='cuerpo'><main>";
    $db = ConectarDB();
    $res = mysqli_query($db,"SELECT * FROM recetas WHERE id='$id'");
    $cat = mysqli_query($db,"SELECT * FROM categorias WHERE receta_id='$id'");
    if($res){
        while($tupla=mysqli_fetch_array($res)){ 
            $tuplacat = mysqli_fetch_array($cat);
            $autor = ObtenerAutor($tupla['idautor']);
            $idReceta = $tupla['id'];
            echo "
                    <section class='titulopequeño'>
                    <section class='titulo'>
                            <h1>{$tupla['nombre']}</h1>
                        </section>

                        <section class='subtitulo'>
                            <p>Autor: $autor</p>";
                            echo "<p>";
                            //echo $tuplacat['categoria_id'];
                            //for($i=0; $i < count($tuplacat['categoria_id']); $i++){
                                echo ObtenerCategoria($tuplacat['categoria_id'])." ";
                            //}
                            echo "</p>";
                        echo "</section>
                    </section>";

                    echo "<section class='info'>";
                    
                    echo   "{$tupla['descripcion']}";
                    obtenFotoTitulo($idReceta);

                    /*
                        $foto = $tupla['Fotografía'];
                        echo "</p><img src='data:image/jpg;base64, ";
                        echo base64_encode($foto);
                        echo "'width='300' />";
                    */
                    echo "</section>

                    <section class='ingredientes'>
                        <ul>";
                            $ingredientes = explode(',',$tupla['ingredientes']);
                            foreach($ingredientes as $i){
                                echo "<li>".$i."</li>";
                            }
                            
                        echo "</ul>
                    </section>

                    <section class='pasos'>
                        <ol>";

                            $preparacion = explode('.',$tupla['preparacion']);
                            foreach($preparacion as $i){
                                echo "<li>".$i."</li>";
                            }

                    echo "</ol>
                    </section>";

                echo "<section class='galeria'>";
                    obtenFotosRecetaMain($idReceta);
                echo "</section>";

                echo "<div class='abajo'>";
                    echo "<section class='comentarios'>";
                        listaComentariosReceta($idReceta); 
                    echo "</section>";
                echo "</div>";

                if(isset($_SESSION['email'])){

                    echo"<form action='index.php?p=nuevo_coment' method='post'>
                    <input type='submit' name='comentar' value='Comentar' />
                    <input name='idReceta' type='hidden' value='$idReceta'>
                    </form>
                    </section>";
                }
                    
        }   
    }

        //echo "</main>";
}

?>