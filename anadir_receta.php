<?php
require_once("conexionBD.php");
require_once "conexionBD.php";
function formularioAnadirBase(Recetas &$objR){

    //Principio Formulario
    echo " <form action='index.php?p=anadir_receta' method='post'>";

    //Titulo
    echo "<p>Titulo: <input type='text' name='nombre'";
    if(isset($objR->nombre)){
        echo " value='".$objR->nombre."' size='40'></p>";
    }
    else if(isset($objR->hayerror) && array_key_exists('nombre', $objR->hayerror)){
        echo " size='40'></p>";
        echo $objR->hayerror['nombre'];
    }
    else echo " size='40'></p>";


    //Descripcion
    echo "<p>Descripción: <textarea name='descripcion' rows='4' cols='40'";
    if(isset($objR->descripcion)){
        echo "size='40'>".$objR->descripcion."</textarea></p>";
    }
    else if(isset($objR->hayerror) && array_key_exists('descripcion', $objR->hayerror)){
        echo "size='40'></textarea></p>";
        echo $objR->hayerror['descripcion'];
    }
    else echo "size='short'></textarea></p>";

    //Ingredientes
    echo "<p>Ingredientes: <textarea name='ingredientes' rows='4' cols='40'";
    if(isset($objR->ingredientes)){
        echo "size='40'>".$objR->ingredientes."</textarea></p>";
    }
    else if(isset($objR->hayerror) && array_key_exists('ingredientes', $objR->hayerror)){
        echo "size='40'></textarea></p>";
        echo $objR->hayerror['ingredientes'];
    }
    else echo "size='short'></textarea></p>";

    //Preparacion
    echo "<p>Preparación: <textarea name='preparacion' rows='4' cols='40'";
    if(isset($objR->preparacion)){
        echo "size='40'>".$objR->preparacion."</textarea></p>";
    }
    else if(isset($objR->hayerror) && array_key_exists('preparacion', $objR->hayerror)){
        echo "size='40'></textarea></p>";
        echo $objR->hayerror['preparacion'];
    }
    else echo "size='short'></textarea></p>";

    //Categorias
    $db = conectarDB();
    $res = mysqli_query($db,"SELECT * FROM listacategorias");
    $tuplas=mysqli_fetch_all($res,MYSQLI_ASSOC);

    for( $i = 0; $i < count($tuplas); $i++){
        if(isset($_POST[ $tuplas[$i]['categoria'] ]) && empty( $_POST[ $tuplas[$i]['categoria'] ] ) ){
            echo $tuplas[$i]['categoria'];
            unset($_POST[ $tuplas[$i]['categoria'] ]);
        }
    }
    
    for($i=0; $i < count($tuplas); $i++){
        if( isset($_POST[ $tuplas[$i]['categoria'] ]) && $_POST[ $tuplas[$i]['categoria'] ] != ''){
            echo "<p>".$_POST[ $tuplas[$i]['categoria']]."<input type='checkbox' checked name='".$_POST[ $tuplas[$i]['categoria']]."' value='".$_POST[ $tuplas[$i]['categoria']]." '/></p>";
            //echo "<p><input type='hidden' name='".$_POST[ $tuplas[$i]['categoria']]."' value='".$_POST[ $tuplas[$i]['categoria']]."'/></p>";
            
        }else
            echo "<p>".$tuplas[$i]['categoria']."<input type='checkbox' name='".$tuplas[$i]['categoria']."' value='".$tuplas[$i]['categoria']."'/></p>";
    }
    
    //Cierre y botones
    echo"  <p>
        <input type='submit' value='Añadir Receta'>
        <input type='reset' value='Borrar'>
      </p>
    </form>";

}

function muestraDatosReceta(Recetas $objR){
    
    echo "<p>Título: ".$objR->nombre."</p>";
    echo "<p>Descripción: ".$objR->descripcion."</p>";
    echo "<p>Ingredientes: ".$objR->ingredientes."</p>";
    echo "<p>Preparación: ".$objR->preparacion."</p>";
    echo "<p>Categorías: ";
    //print_r(array_values($objR->categorias));
    for($i=0; $i < count($objR->categorias); $i++){
        echo ObtenerCategoria($objR->categorias[$i])." ";
    echo "</p>";
    }
}

function saneaDatosReceta(Recetas &$objR){
    //Compruebo el Titulo
    if(empty($_POST['nombre']))
        $objR->hayerror['nombre'] = '<p class="error">No ha indicado ningún título</p>';
    else if(is_numeric($_POST['nombre']))
        $objR->hayerror['nombre'] = '<p class="error">El título no puede ser un número</p>';
    else 
        $objR->nombre = $_POST['nombre'];

    //Compruebo la descripcion
    if(empty($_POST['descripcion']))
        $objR->hayerror['descripcion'] = '<p class="error">No ha indicado ninguna descripción</p>';
    else if(is_numeric($_POST['descripcion']))
        $objR->hayerror['descripcion'] = '<p class="error">La descripción no puede ser un número</p>';
    else{
        $objR->descripcion = $_POST['descripcion'];
    }

    //Compruebo los ingredientes
    if(empty($_POST['ingredientes']))
        $objR->hayerror['ingredientes'] = '<p class="error">No ha indicado ningún ingrediente</p>';
    else{
        $objR->ingredientes = $_POST['ingredientes'];
    }

    //Compruebo la preparacion
    if(empty($_POST['preparacion']))
        $objR->hayerror['preparacion'] = '<p class="error">No ha indicado ningún paso</p>';
    else{
        $objR->preparacion = $_POST['preparacion'];
    }

    $db = conectarDB();
    $res = mysqli_query($db,"SELECT * FROM listacategorias");
    $tuplas=mysqli_fetch_all($res,MYSQLI_ASSOC);

}

function confirmaDatosReceta(Recetas &$objR){
    $objR->confirmado = "si";
    //Principio Formulario
    echo " <form action='index.php?p=anadir_receta' method='post'>";
    
    //Titulo
    echo "<p>Titulo: <input type='text' name='nombre' 
    value='".$objR->nombre."' size='40' readonly></p>";

    //Descripcion
    echo "<p>Descripción: <textarea name='descripcion'
    rows='4' cols='40' size='40'>".$objR->descripcion."</textarea></p>";

    //Preparacion
    echo "<p>Preparación: <textarea name='preparacion'
    rows='4' cols='40' size='40'>".$objR->preparacion."</textarea></p>";

    //Ingredientes
    echo "<p>Ingredientes: <textarea name='ingredientes'
    rows='4' cols='40' size='40'>".$objR->ingredientes."</textarea></p>";

    $db = conectarDB();
    $res = mysqli_query($db,"SELECT * FROM listacategorias");
    $tuplas=mysqli_fetch_all($res,MYSQLI_ASSOC);

    echo "<p>Categorías: </p>";
    for( $i = 0; $i < count($tuplas); $i++){
        if( isset( $_POST[ $tuplas[$i]['categoria'] ] ) && !empty( $_POST[ $tuplas[$i]['categoria'] ] ) ){
            echo "<p>".$tuplas[$i]['categoria']."<input type='checkbox' disabled checked name='".$tuplas[$i]['categoria']."' value='".$tuplas[$i]['categoria']." '/></p>";
            echo "<p><input type='hidden' name='".$_POST[ $tuplas[$i]['categoria']]."' value='".$_POST[ $tuplas[$i]['categoria']]."'/></p>";
        }
    }

    //Asigno valores a las categorias
    for( $i = 0; $i < count($tuplas); $i++){
        if(isset($_POST[ $tuplas[$i]['categoria'] ]) && !empty( $_POST[ $tuplas[$i]['categoria'] ] ) ){
            $objR->categorias[] = $tuplas[$i]['categoria_id'];
        }
    }


    //Cierre y botones
    echo"  <p>
        <input type='submit' value='Añadir receta'>
      </p>
    </form>
    
    <form action='index.php'>
        <input type='submit' value='Cancelar' />
    </form>";

    

}

function simulaIndexAnadirReceta(Recetas &$objR){
    echo "<div class='cuerpo'><main>";
    if(isset($_POST['nombre'])){
        saneaDatosReceta($objR);
    }

    if(isset($_SESSION['objR']) && 
    isset($objR->nombre) && isset($objR->descripcion) 
    && isset($objR->ingredientes) && isset($objR->preparacion)
    && $objR->confirmado == 'si') {
        
        InsertarRecetaBD($objR);
        muestraDatosReceta($objR);
        unset($_SESSION['objR']);
        $evento_log = "El usuario ".$_SESSION['email']." a añadido una receta";
        InsertarLog($evento_log);
            

    }else if(isset($_SESSION['objR']) 
          && isset($objR->nombre) && isset($objR->descripcion) 
          && isset($objR->ingredientes)
          && isset($objR->preparacion)){
            
            echo "<h1>¿Desea enviar estos datos?</h1>";
        
            confirmaDatosReceta(($objR));


    }else{
        echo "<h1>Rellene los campos</h1>";
        formularioAnadirBase($objR);
    }

    
    echo "</main>";

}
?>