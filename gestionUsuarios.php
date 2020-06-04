<?php


function muestraPendientes(){
    echo "<div class='cuerpo'><main>";
    echo "<h1>Lista de usuarios pendientes</h1>";
    $res = RecuperaUsuariosTmp();
    if($res){
        while($tupla=mysqli_fetch_array($res)){
            echo "<h3>Datos del usuario: </h3>";
            echo "<p>Nombre: {$tupla['nombre']}, Apellidos: {$tupla['apellidos']}, Correo: {$tupla['email']}, Direccion: {$tupla['direccion']}, Telefono: {$tupla['telefono']},Admitido: {$tupla['verificado']}</p>";
        }
    }
    echo "</main>";
}






?>