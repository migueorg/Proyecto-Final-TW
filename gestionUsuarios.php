<?php


function aplicaValidar(){
    if(isset($_POST['Validar'])){
        ValidaUsuarioTmp($_POST['idUsuario']);
    }
}



function muestraPendientes(){
    echo "<div class='cuerpo'><main>";
    echo "<h1>Lista de usuarios pendientes:</h1>";
    $res = RecuperaUsuariosTmp();
    if($res){
        while($tupla=mysqli_fetch_array($res)){
            echo "<h3>Datos del usuario: </h3>";
            echo "<p>Nombre: {$tupla['nombre']}, Apellidos: {$tupla['apellidos']}, Correo: {$tupla['email']}, Direccion: {$tupla['direccion']}, Telefono: {$tupla['telefono']},Admitido: {$tupla['verificado']}</p>";
            echo "
                <form action='index.php?p=gestion_usuarios' method='post'>
                    <input type='submit' name='Validar'cvalue='Validar' />
                    <input name='idUsuario' type='hidden' value='{$tupla['id']}'>
                </form>";
        }
    }
    //echo "</main>";
}

function muestraDefinitivos(){
    echo "<h1>Lista de usuarios ya verificados:</h1>";
    $res = RecuperaUsuarios();
    if($res){
        while($tupla=mysqli_fetch_array($res)){
            echo "<h3>Datos del usuario: </h3>";
            echo "<p>Nombre: {$tupla['nombre']}, Apellidos: {$tupla['apellidos']}, Correo: {$tupla['email']}, Direccion: {$tupla['direccion']}, Telefono: {$tupla['telefono']}, Tipo: {$tupla['tipo']}</p>";
            if($_SESSION['email'] != $tupla['email']){
                echo "
                <form action='index.php?p=gestion_usuarios' method='post'>
                    <input type='submit' name='Borrar' value='Borrar' />
                    <input name='idUsuario' type='hidden' value='{$tupla['id']}'>
                </form>";
                
                echo "
                <form action='index.php?p=inicializa_editar' method='post'>
                    <input type='submit' name='Editar' value='Editar' />
                    <input name='idUsuario' type='hidden' value='{$tupla['id']}'>
                </form>";
            }
        }
    }
    echo "</main>";
}


function simulaIndexGestionUsuarios(){
    if(isset($_POST['Borrar'])){
        BorrarUsuario($_POST['idUsuario']);
    }
    aplicaValidar();
    muestraPendientes();
    muestraDefinitivos();
}

function switchCaseAdmin($entrada){
    switch ($entrada) {
        case "inicio": 
            HTMLpag_inicio(); 
            if(isset($_SESSION['objU'])) 
                unset($_SESSION['objU']); 
            if(isset($_SESSION['obj_editar'])) 
                unset($_SESSION['obj_editar']);
            if(isset($_SESSION['objR'])) 
                unset($_SESSION['objR']);
            break;

        case "registrar": simulaIndex($_SESSION['objU']); break;
        case "ver_recetas": simulaIndexListaRecetas();break;
        case "editar": simulaIndexEditar($_SESSION['obj_editar']); break;
        case "anadir_receta": simulaIndexAnadirReceta($_SESSION['objR']); break;
        case "gestion_usuarios": simulaIndexGestionUsuarios(); break;
        case "editar_receta": simulaIndexEditarReceta($_SESSION['objR']);break;
        case "ver_log": HTMLpag_log();break;
        case "ver_mis_recetas": simulaIndexListaMisRecetas(); break;
        case "nuevo_coment": simulaIndexComentario(); break;
        case "inicializa_editar": inicializaYRedirigeEditar(); break;
        default: HTMLpag_inicio(); break;
    }
}

function switchCaseColab($entrada){
    switch ($entrada) {
        case "inicio": 
            HTMLpag_inicio(); 
            if(isset($_SESSION['objU'])) 
                unset($_SESSION['objU']); 
            if(isset($_SESSION['obj_editar'])) 
                unset($_SESSION['obj_editar']);
            if(isset($_SESSION['objR'])) 
                unset($_SESSION['objR']);
            break;

        case "registrar": simulaIndex($_SESSION['objU']); break;
        case "ver_recetas": simulaIndexListaRecetas();break;
        case "editar": simulaIndexEditar($_SESSION['obj_editar']); break;
        case "anadir_receta": simulaIndexAnadirReceta($_SESSION['objR']); break;
        case "editar_receta": simulaIndexEditarReceta($_SESSION['objR']);break;
        case "ver_mis_recetas": simulaIndexListaMisRecetas(); break;
        case "nuevo_coment": simulaIndexComentario(); break;
        default: HTMLpag_inicio(); break;
    }
}

function switchCaseCualquiera($entrada){
    switch ($entrada) {
        case "inicio": 
            HTMLpag_inicio(); 
            if(isset($_SESSION['objU'])) 
                unset($_SESSION['objU']); 
            break;

        case "registrar": simulaIndex($_SESSION['obj']); break;
        case "ver_recetas": simulaIndexListaRecetas();break;

        default: HTMLpag_inicio(); break;
    }
}


?>