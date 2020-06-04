<?php
require_once("conexionBD.php");
function formularioAnadirBase(Recetas &$objR){

    //Principio Formulario
    echo " <form action='index.php?p=anadir_receta' method='post'>";

    //Titulo
    echo "<p>Titulo: <input type='text' name='nombre'";
    if(isset($objR->nombre)){
        echo " value='".$objR->nombre."' size='40'></p>";
    }
    else if(isset($objR->hayerror) && array_key_exists('nombre', $objR->hayerror)){
        echo "size='40'></p>";
        echo $objR->hayerror['nombre'];
    }
    else echo "size='40'></p>";

    //Descripcion
    echo "<p>Descripción: <textarea name='descripcion' rows='4' cols='40'";
    if(isset($objR->descripcion)){
        echo " value='".$objR->descripcion."' size='40'></p>";
    }
    else if(isset($objR->hayerror) && array_key_exists('descripcion', $objR->hayerror)){
        echo "size='40'></p>";
        echo $objR->hayerror['descripcion'];
    }
    else echo "size='short'></textarea></p>";

    //Ingredientes
    echo "<p>Ingredientes: <textarea name='ingredientes' rows='4' cols='40'";
    if(isset($objR->ingredientes)){
        echo " value='".$objR->ingredientes."' size='40'></p>";
    }
    else if(isset($objR->hayerror) && array_key_exists('ingredientes', $objR->hayerror)){
        echo "size='40'></p>";
        echo $objR->hayerror['ingredientes'];
    }
    else echo "size='short'></textarea></p>";

    //Preparacion
    echo "<p>Preparación: <textarea name='preparacion' rows='4' cols='40'";
    if(isset($objR->preparacion)){
        echo " value='".$objR->preparacion."' size='40'></p>";
    }
    else if(isset($objR->hayerror) && array_key_exists('preparacion', $objR->hayerror)){
        echo "size='40'></p>";
        echo $objR->hayerror['preparacion'];
    }
    else echo "size='short'></textarea></p>";

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
    rows='4' cols='40' value='".$objR->descripcion."' size='40'></p>";

    //Ingredientes
    echo "<p>Preparación: <textarea name='preparacion'
    rows='4' cols='40' value='".$objR->preparacion."' size='40'></p>";

    //Ingredientes
    echo "<p>Ingredientes: <textarea name='ingredientes'
    rows='4' cols='40' value='".$objR->ingredientes."' size='40'></p>";

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

    if(isset($_SESSION['obj']) && 
    isset($objR->nombre) && isset($objR->descripcion) 
    && isset($objR->ingredientes) && isset($objR->preparacion)
    && $objR->confirmado == 'si') {
        
        InsertarRecetaBD($objR);
        muestraDatosReceta($objR);
        unset($_SESSION['obj']);
            

    }else if(isset($_SESSION['obj']) 
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