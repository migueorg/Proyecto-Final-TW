<?php
require_once("conexionBD.php");
function HTMLmostar_receta($id){
    //echo "<div class='cuerpo'><main>";
    $db = ConectarDB();
    $res = mysqli_query($db,"SELECT * FROM recetas WHERE id='$id'");

    if($res){
        while($tupla=mysqli_fetch_array($res)){    
            $autor = ObtenerAutor($tupla['idautor']);
            $idReceta = $tupla['id'];
            echo "
                    <section class='titulopequeño'>
                    <section class='titulo'>
                            <h1>{$tupla['nombre']}</h1>
                        </section>

                        <section class='subtitulo'>
                            <p>Autor: $autor</p>
                        </section>
                    </section>

                    <section class='info'><p>
                    
                        {$tupla['descripcion']}";
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

                            $preparacion = explode(',',$tupla['preparacion']);
                            foreach($preparacion as $i){
                                echo "<li>".$i."</li>";
                            }

                    echo "</ol>
                    </section>";

                    echo "<section class='comentarios'>
                        <h1>Zona de Comentarios:</h1>";
                    listaComentariosReceta($idReceta); 
                    echo"<form action='index.php?p=nuevo_coment' method='post'>
                            <input type='submit' name='comentar' value='Comentar' />
                            <input name='idReceta' type='hidden' value='$idReceta'>
                        </form>
                    </section>";
                    
        }   
    }

        //echo "</main>";
}

?>