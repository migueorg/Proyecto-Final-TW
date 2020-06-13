<?php


function formularioComentario(){

    //Principio Formulario
    echo " <form action='index.php?p=nuevo_coment' method='post'>";
    
    //Descripcion
    echo "<p>Comentario: 
    <textarea name='mensaje' rows='4' cols='40'size='40'></textarea></p>";

    //Cierre y botones
    echo"<p>
        <input type='submit' value='Comentar'>
        <input name='idReceta' type='hidden' value='".$_POST['idReceta']."'></form>
      </p>
    </form>";
    
}

function formularioConfirmarComentario($mensaje){

    //Principio Formulario
    echo " <form action='index.php?p=nuevo_coment' method='post'>";
    
    //Descripcion
    echo "<p>Comentario: 
    <textarea name='mensaje' rows='4' cols='40'size='40'readonly>$mensaje</textarea></p>";

    //Cierre y botones
    echo"<p>
        <input type='submit' value='Confirmar'>";
        if(isset($_POST['idReceta'])){
            echo "<input name='idReceta' type='hidden' value='".$_POST['idReceta']."'>
            <input name='confirmado' type='hidden' value='si'></form>";
        }
        else if(isset($_POST['idComentario'])){
            echo "<input name='idComentario' type='hidden' value='".$_POST['idComentario']."'>
            <input name='confirmaBorrado' type='hidden' value='si'></form>";
        }
        
      echo "</p>
    </form>";
    
}

function confirmaBorrarComentario($idComentario){
    $res = obtenerComentario($idComentario);
    echo "<h1>¿Confirmas que deseas borrar este comentario?</h1>";
    formularioConfirmarComentario($res['mensaje']);
}


function simulaIndexComentario(){
    echo "<div class='cuerpo'><main>";
    
    if(isset($_POST['confirmaBorrado'])){
        borrarComentario($_POST['idComentario']);
    }else if(isset($_POST['borrar'])){    
        confirmaBorrarComentario($_POST['idComentario']);
    }else if(isset($_POST['mensaje']) && isset($_POST['confirmado'])){
        insertaComentario($_POST['mensaje'],$_POST['idReceta']);
    }else if(isset($_POST['mensaje'])){
        echo "<h1>¿Confirmas ingresar estos datos?</h1>";
        formularioConfirmarComentario($_POST['mensaje']);
    }else{
        formularioComentario();
    }

    
    echo "</main>";
}

?>