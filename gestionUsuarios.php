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



?>