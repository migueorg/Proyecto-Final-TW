<?php
function HTMLmostar_receta($id){
    require_once("conexionBD.php");
    $db = ConectarDB();
    $res = mysqli_query($db,"SELECT * FROM recetas WHERE id='$id'");
    $tuplas = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $_SESSION['nombre'] = $tuplas[0]['nombre'];
    if($res){
        if( !isset($_POST['confirmar'])){

                if(!isset($_POST['titulo2'])){
                    echo "<label><span><br>Título:</span><input type='text' name='titulo2' value='".$tuplas[0]['Título']."' size='short'></label>";
                } else {
                    if( !empty($_POST['titulo2']) ){
                        echo "<label><span><br>Título:</span><input type='text' name='titulo2' value='".$_POST['titulo2']."' size='short'></label>";
                        $titulo = $_POST['titulo2'];
                    } else {
                        if(empty($_POST['titulo2'])){
                            echo "<label><span>Título:</span><input type='text' name='titulo2' size='short'></label>";
                            echo '<p class=error>No ha indicado ningún valor</p>';
                            $titulo_correcto = false;  
                        } else {
                            echo "<label><span>Título:</span><input type='text' name='titulo2' size='short'></label>";
                        }
                    }

                }

                echo "<input type='hidden' name='id' value='".$id."'/>";

                if(!isset($_POST['autor2'])){
                    echo "<label><span><br>Título:</span><input type='text' name='autor2' value='".$tuplas[0]['Autor']."' size='short'></label>";
                } else {
                    if( !empty($_POST['autor2']) ){
                        echo "<label><span><br>Autor:</span><input type='text' name='autor2' value='".$_POST['autor2']."' size='short'></label>";
                        $autor = $_POST['autor2'];
                    } else {
                        if(empty($_POST['autor2'])){
                            echo "<label><span>Autor:</span><input type='text' name='autor2' size='short'></label>";
                            echo '<p class=error>No ha indicado ningún valor</p>';
                            $autor_correcto = false;  
                        } else {
                            echo "<label><span>Título:</span><input type='text' name='autor2' size='short'></label>";
                        }
                    }

                }


                if(!isset($_POST['categoria2'])){
                    echo "<label><span><br>Categoría:</span><input type='text' name='categoria2' value='".$tuplas[0]['Categoría']."' size='short'></label>";
                } else {
                    if( !empty($_POST['categoria2']) ){
                        echo "<label><span><br>Categoría:</span><input type='text' name='categoria2' value='".$_POST['categoria2']."' size='short'></label>";
                        $categoria = $_POST['categoria2'];
                    } else {
                        if(empty($_POST['categoria2'])){
                            echo "<label><span>Categoría:</span><input type='text' name='categoria2' size='short'></label>";
                            echo '<p class=error>No ha indicado ningún valor</p>';
                            $categoria_correcto = false;  
                        } else {
                            echo "<label><span>Categoría:</span><input type='text' name='categoria2' size='short'></label>";
                        }
                    }

                }

                if(!isset($_POST['descripcion2'])){
                    echo "<label><span><br>Descripción:</span><textarea name='descripcion2' size='short'>".$tuplas[0]['Descripción']."</textarea></label>";
                } else {
                    if( !empty($_POST['autor2']) ){
                        echo "<label><span><br>Descripción:</span><textarea name='descripcion2' size='short'>".$_POST['categoria2']."</textarea></label>";
                        $descripcion = $_POST['descripcion2'];
                    } else {
                        if(empty($_POST['descripcion2'])){
                            echo "<label><span>Descripción:</span><textarea name='descripcion2' size='short'></textarea></label>";
                            echo '<p class=error>No ha indicado ningún valor</p>';
                            $descripcion_correcto = false;  
                        } else {
                            echo "<label><span>Descripción:</span><textarea name='descripcion2' size='short'></textarea></label>";
                        }
                    }

                }

                if(!isset($_POST['ingredientes2'])){
                    echo "<label><span><br>Ingredientes:</span><textarea name='ingredientes2' size='short'>".$tuplas[0]['Ingredientes']."</textarea></label>";
                } else {
                    if( !empty($_POST['ingredientes2']) ){
                        echo "<label><span><br>Ingredientes:</span><textarea name='ingredientes2' size='short'>".$_POST['ingredientes2']."</textarea></label>";
                        $ingredientes = $_POST['ingredientes2'];
                    } else {
                        if(empty($_POST['ingredientes2'])){
                            echo "<label><span>Ingredientes:</span><textarea name='ingredientes2' size='short'></textarea></label>";
                            echo '<p class=error>No ha indicado ningún valor</p>';
                            $ingredientes_correcto = false;  
                        } else {
                            echo "<label><span>Ingredientes:</span><textarea name='ingredientes2' size='short'></textarea></label>";
                        }
                    }

                }

                if(!isset($_POST['preparacion2'])){
                    echo "<label><span><br>Preparación:</span><textarea name='preparacion2' size='short'>".$tuplas[0]['Preparación']."</textarea></label>";
                } else {
                    if( !empty($_POST['preparacion2']) ){
                        echo "<label><span><br>Preparación:</span><textarea name='preparacion2' size='short'>".$_POST['preparacion2']."</textarea></label>";
                        $preparacion = $_POST['preparacion2'];
                    } else {
                        if(empty($_POST['preparacion2'])){
                            echo "<label><span>Preparación:</span><textarea name='preparacion2' size='short'></textarea></label>";
                            echo '<p class=error>No ha indicado ningún valor</p>';
                            $preparacion_correcto = false;  
                        } else {
                            echo "<label><span>Preparación:</span><textarea name='preparacion2' size='short'></textarea></label>";
                        }
                    }

                }


                if(isset($_SESSION['fotografia2'])){
                    echo "<label><span><br>Fotografía:</span><img src='data:image/jpg;base64,"; echo base64_encode($tuplas[0]['Fotografía']); echo "' width='60px'/>'</label>";
                  
                } else {
                    if(isset($_FILES['fotografia2'])){
                        if($_FILES['fotografia2']['error'] != 0){
                            echo "<label><span>Fotografía:</span><input type='file' name='fotografia2' size='short'></label>";
                            $fotografia_correcto = false;
                        }
                        else{
                            $_SESSION['fotografia2'] = file_get_contents($_FILES['fotografia2']['tmp_name']);
                        }
                          

                    }
                    else{
                        echo "<label><span>fotografia:</span><input type='file' name='fotografia2' size='short'></label>";
                        $fotografia_correcto = false;
                    }
                }


            }
        }
}