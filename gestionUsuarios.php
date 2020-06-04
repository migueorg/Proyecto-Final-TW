<?php


function aplicaValidar(){
    if(isset($_POST['idUsuario'])){
        ValidaUsuarioTmp($_POST['idUsuario']);
    }
}



function muestraPendientes(){
    echo "<div class='cuerpo'><main>";
    echo "<h1>Lista de usuarios pendientes</h1>";
    $res = RecuperaUsuariosTmp();
    if($res){
        while($tupla=mysqli_fetch_array($res)){
            echo "<h3>Datos del usuario: </h3>";
            echo "<p>Nombre: {$tupla['nombre']}, Apellidos: {$tupla['apellidos']}, Correo: {$tupla['email']}, Direccion: {$tupla['direccion']}, Telefono: {$tupla['telefono']},Admitido: {$tupla['verificado']}</p>";
            echo "
                <form action='index.php?p=gestion_usuarios' method='post'>
                    <input type='submit' value='Validar' />
                    <input name='idUsuario' type='hidden' value='{$tupla['id']}'>
                </form>";
        }
    }
    echo "</main>";
}


function simulaIndexGestionUsuarios(){
    aplicaValidar();
    muestraPendientes();
}



?>