<?php
require_once("conexionBD.php");
require_once("muestra_receta.php");

function HTMLpag_listarecetas(){

    $db = ConectarDB();    
    if($db){
        $res = mysqli_query($db,"SELECT * FROM recetas ");
        MenuListar($res);
    }
}

function HTMLpag_listaMisRecetas(){
    $id = $_SESSION['id'];
    $db = ConectarDB();    
    if($db){
        $res = mysqli_query($db,"SELECT * FROM recetas WHERE idautor='$id'");
        MenuListar($res);
    }
}


function formularioEditarRecetaBase(Recetas &$objR){
    $objR->primeraVez = "no";
    //Principio Formulario
    echo " <form action='index.php?p=editar_receta' method='post'>";

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
        echo " size='40'>".$objR->ingredientes." </textarea></p>";
    }
    else if(isset($objR->hayerror) && array_key_exists('ingredientes', $objR->hayerror)){
        echo "size='40'></textarea></p>";
        echo $objR->hayerror['ingredientes'];
    }
    else echo "size='short'></textarea></p>";

    //Preparacion
    echo "<p>Preparación: <textarea name='preparacion' rows='4' cols='40'";
    if(isset($objR->preparacion)){
        echo " size='40'>".$objR->preparacion."</textarea></p>";
    }
    else if(isset($objR->hayerror) && array_key_exists('preparacion', $objR->hayerror)){
        echo "size='40'></textarea></p>";
        echo $objR->hayerror['preparacion'];
    }
    else echo "size='short'></textarea></p>";

    //Cierre y botones
    echo"  <p>
        <input type='submit' value='Actualizar Receta'>
      </p>
    </form>";

    echo "<form action='index.php?p=inserta_imagen' method='post'>
        <input type='submit' value='Insertar Imágenes' />
        <input name='idReceta' type='hidden' value='$objR->id'>
    </form>";

}

function confirmaEditarDatosReceta(Recetas &$objR){
    $objR->confirmado = "si";
    
    //Principio Formulario
    echo " <form action='index.php?p=editar_receta' method='post'>";
    
    //Titulo
    echo "<p>Titulo: <input type='text' name='nombre' 
    value='".$objR->nombre."' size='40' readonly></p>";

    //Descripcion
    echo "<p>Descripción: <textarea name='descripcion'
    rows='4' cols='40' size='40' readonly>".$objR->descripcion."</textarea></p>";

    //Ingredientes
    echo "<p>Preparación: <textarea name='preparacion'
    rows='4' cols='40' size='40' readonly>".$objR->preparacion."</textarea></p>";

    //Ingredientes
    echo "<p>Ingredientes: <textarea name='ingredientes'
    rows='4' cols='40'  size='40' readonly>".$objR->ingredientes."</textarea></p>";

    //Cierre y botones
    echo"  <p>
        <input type='submit' value='Confirmar Editar Receta'>
      </p>
    </form>
    
    <form action='index.php'>
        <input type='submit' value='Cancelar' />
    </form>";

}

function inicializaObjR(Recetas &$objR){
    $objR->id=$_POST['idReceta'];
    $objR->idautor=ObtenerIdAutorR($_POST['idReceta']);
    $objR->nombre=ObtenerNombreR($_POST['idReceta']);
    $objR->descripcion=ObtenerDescripcionR($_POST['idReceta']);
    $objR->ingredientes=ObtenerIngredientesR($_POST['idReceta']);
    $objR->preparacion=ObtenerPreparacionR($_POST['idReceta']);
    $objR->editarIniciado = 'si';
    $_SESSION['objR'] = $objR;
    echo "finalizo";
}

function simulaIndexEditarReceta(Recetas $objR){

    echo "<div class='cuerpo'><main>";

    if($objR->editarIniciado == 'no'){
        inicializaObjR($objR);
    }

    if(isset($_POST['nombre'])){
        saneaDatosReceta($objR);
    }

    if(isset($_SESSION['objR']) && 
    isset($objR->nombre) && isset($objR->descripcion) 
    && isset($objR->ingredientes) && isset($objR->preparacion)
    && $objR->confirmado == 'si') {
        
        ActualizarRecetaBD($objR);
        muestraDatosReceta($objR);
        unset($_SESSION['objR']);
            

    }else if(isset($_SESSION['objR']) 
          && isset($objR->nombre) && isset($objR->descripcion) 
          && isset($objR->ingredientes)
          && isset($objR->preparacion)
          && $objR->primeraVez == 'no'){
            
            echo "<h1>¿Seguro que desea enviar estos datos?</h1>";
        
            confirmaEditarDatosReceta(($objR));


    }else{
        echo "<h1>Edite los campos</h1>";
        formularioEditarRecetaBase($objR);
    }

    
    echo "</main>";

}

function simulaIndexListaRecetas(){
    echo "<div class='cuerpo'><main>";

    if(isset($_POST['ver'])){

        HTMLmostar_receta($_POST['idReceta']);

    //}else if(isset($_POST['editar'])){
    //    echo "Le has dado a editar";

    }else if(isset($_POST['borrar'])){

        BorrarReceta($_POST['idReceta']);
        HTMLpag_listarecetas();

    }else{
        HTMLpag_listarecetas();
    }

    echo "</main>";
}

function simulaIndexListaMisRecetas(){
    echo "<div class='cuerpo'><main>";

    if(isset($_POST['ver'])){

        HTMLmostar_receta($_POST['idReceta']);

    }else if(isset($_POST['borrar'])){

        BorrarReceta($_POST['idReceta']);
        HTMLpag_listaMisRecetas();

    }else{
        HTMLpag_listaMisRecetas();
    }

    echo "</main>";
}

?>