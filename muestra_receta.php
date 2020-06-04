<?php
function HTMLmostar_receta($id){
    require_once("conexionBD.php");
    $db = ConectarDB();    
    mysqli_set_charset($db,"utf8");
    if($db){    
        $res = mysqli_query($db,"SELECT * FROM recetas WHERE id='$id'");
        if($res){
            while($tupla=mysqli_fetch_array($res)){
                echo "
                        <section class='titulopequeño'>
                        <section class='titulo'>
                                <h1>{$tupla['nombre']}</h1>
                            </section>

                            <section class='subtitulo'>
                                <p>Autor:{mysqli_query($db,"SELECT nombre FROM usuarios WHERE id='$id')}</p>
                            </section>
                        </section>

                        <section class='info'><p>
                        
                            {$tupla['descripcion']}";
                        
                            $foto = $tupla['foto'];
                            echo "</p><img src='data:image/jpg;base64, ";
                            echo base64_encode($foto);
                            echo "'width='300' />";

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
                                


                                echo "</ol>";
                        
            }   
        }
    }echo "error al acceder a la BD";
}