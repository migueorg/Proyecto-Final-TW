<?php

function baseSeleccionaFoto(){
        //Principio Formulario
        echo " <form action='index.php?p=inserta_imagen' method='post' enctype='multipart/form-data'>";
    

        //Imagen
        echo "<p>Foto: <input type='file' name='foto' accept='image/*' /></p>";
        $idRec = $_POST['idReceta'];
        echo"  <p>
                <input type='submit' value='Añadir esta foto'>
                <input name='nuevaFoto' type='hidden' value='nuevaFoto'>
                <input name='idReceta' type='hidden' value='$idRec'>
                <input type='reset' value='Borrar esta foto'>
            </p>
            </form>";
}


function insertaImagenBaseDatos(){

    $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
    insertaFotosReceta($_POST['idReceta'],$foto);


}

function terminarInsercion(){
    $idRec = $_POST['idReceta'];
    echo"<form action='index.php?p=ver_recetas' method='post'>
    <input type='submit' name='terminar' value='Terminar Edicion' />
    <input name='idReceta' type='hidden' value='$idRec'>
    </form>";
}


function simulaIndexInsertaImagenes(){
    echo "<div class='cuerpo'><main>";
    echo "<h1>Inserta Fotos</h1>";

    if(isset($_POST['nuevaFoto'])){
        insertaImagenBaseDatos();
        $evento_log = "El usuario ".$_SESSION['email']." ha añadido fotos a la BD";
        InsertarLog($evento_log);
    }
    
    if(isset($_POST['borrar'])){
        borraFotosReceta($_POST['idFoto']);
    }

    obtenFotosReceta($_POST['idReceta']);


    baseSeleccionaFoto();


    terminarInsercion();


    echo "</main>";

}


?>