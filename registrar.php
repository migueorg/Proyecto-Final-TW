<?php
require_once("conexionBD.php");
function formularioRegistroBase(Formularios &$objF){

  
    //Principio Formulario
    echo " <form action='index.php?p=registrar' method='post' enctype='multipart/form-data'>";
    

    //Imagen
    echo "<p>Foto: <input type='file' name='foto' accept='image/*' /></p>";
    if(isset($objF->hayerror) && array_key_exists('foto', $objF->hayerror)){
        echo $objF->hayerror['foto'];
    }
    
    //Nombre
    echo "<p>Nombre: <input type='text' name='nombre'";
    if(isset($objF->nombre)){
        echo " value='".$objF->nombre."' size='40'></p>";
    }
    else if(isset($objF->hayerror) && array_key_exists('nombre', $objF->hayerror)){
        echo "size='40'></p>";
        echo $objF->hayerror['nombre'];
    }
    else echo "size='40'></p>";

    //Apellidos
    echo "<p>Apellidos: <input type='text' name='apellidos'";
    if(isset($objF->apellidos)){
        echo " value='".$objF->apellidos."' size='40'></p>";
    }
    else if(isset($objF->hayerror) && array_key_exists('apellidos', $objF->hayerror)){
        echo "size='40'></p>";
        echo $objF->hayerror['apellidos'];
    }else echo "size='40'></p>";

    //Correo
    echo "<p>Correo Electrónico: <input type='email' name='correo'";
    if(isset($objF->correo)){
        echo " value='".$objF->correo."'></p>";
    }
    else if(isset($objF->hayerror) && array_key_exists('correo', $objF->hayerror)){
        echo "></p>";
        echo $objF->hayerror['correo'];
    }
    else echo "></p>";

    //Clave
    echo "<p>Clave: <input type='text' name='clave1'";
    if(isset($objF->clave1)){
        echo " value='".$objF->clave1."' size='40'></p>";
    }
    else if(isset($objF->hayerror) && array_key_exists('clave1', $objF->hayerror)){
        echo "size='40'></p>";
        echo $objF->hayerror['clave1'];
    }
    else echo "size='40'></p>";
    
    //Vuelve a introducir la clave
    echo "<p>Vuelve a introducir la clave: <input type='text' name='clave2'";
    if(isset($objF->clave2)){
        echo " value='".$objF->clave2."' size='40'></p>";
    }
    else if(isset($objF->hayerror) && array_key_exists('clave2', $objF->hayerror)){
        echo "size='40'></p>";
        echo $objF->hayerror['clave2'];
    }
    else echo "size='40'></p>";

    //Vuelve a introducir las clave
    /*echo "<p>Vuelve a introducir la clave: <input type='text' name='clave2'";
    if(isset($objF->clave2)){
        echo " value='".$objF->clave2."'";
    }
    echo "size='40'></p>";*/
    if(isset($objF->hayerror) && array_key_exists('coincidencia', $objF->hayerror)){
        echo $objF->hayerror['coincidencia'];
    }

    

    //Dirección
    echo "<p>Dirección: <input type='text' name='direccion'";
    if(isset($objF->direccion)){
        echo " value='".$objF->direccion."' size='40'></p>";
    }
    else if(isset($objF->hayerror) && array_key_exists('direccion', $objF->hayerror)){
        echo "size='40'></p>";
        echo $objF->hayerror['direccion'];
    }
    else echo "size='40'></p>";

    //Telefono
    echo "<p>Teléfono: <input type='tel' name='telefono'";
    if(isset($objF->telefono)){
        echo " value='".$objF->telefono."' ></p>";
    }
    else if(isset($objF->hayerror) && array_key_exists('telefono', $objF->hayerror)){
        echo "></p>";
        echo $objF->hayerror['telefono'];
    }
    else echo "></p>";

    //Rol
    if(isset($objF->rol) && ($objF->rol == 'administrador')){
        echo"
        <p>Rol: 
        <select name='rol' readonly>
            <option value='colaborador'>Colaborador</option>
            <option value='administrador' selected>Administrador</option>
        </select></p>";
    }else{ 
        echo"<p>Rol: 
        <select name='rol'>
            <option value='colaborador' selected>Colaborador</option>
            <option value='administrador'>Administrador</option>
        </select></p>";}

    //Cierre y botones
    echo"  <p>
        <input type='submit' value='Enviar'>
        <input type='reset' value='Borrar'>
      </p>
    </form>";

}

function muestraDatos(Formularios $objF){
    echo "<main>";
    echo "<h1>Datos recibidos correctamente</h1>";
    echo "<p>Nombre: ".$objF->nombre."</p>";
    echo "<p>Apellidos: ".$objF->apellidos."</p>";
    echo "<p>Correo: ".$objF->correo."</p>";
    echo "<p>Clave: ".$objF->clave1."</p>";
    echo "<p>Direccion: ".$objF->direccion."</p>";
    echo "<p>Telefono: ".$objF->telefono."</p>";
    echo "<p>Rol: ".$objF->rol."</p>";
    echo "</main>";
}

function saneaDatos(Formularios &$objF){
    //Compruebo el Nombre
    if(empty($_POST['nombre']))
        $objF->hayerror['nombre'] = '<p class="error">No ha indicado ningún nombre</p>';
    else if(is_numeric($_POST['nombre']))
        $objF->hayerror['nombre'] = '<p class="error">El nombre no puede ser un número</p>';
    else 
        $objF->nombre = $_POST['nombre'];

    //Compruebo el Apellido
    if(empty($_POST['apellidos']))
        $objF->hayerror['apellidos'] = '<p class="error">No ha indicado ningún apellido</p>';
    else if(is_numeric($_POST['apellidos']))
        $objF->hayerror['apellidos'] = '<p class="error">El apellido no puede ser un número</p>';
    else{
        $objF->apellidos = $_POST['apellidos'];
    }

    //Compruebo el Correo
    if(empty($_POST['correo'])){
        $objF->hayerror['correo'] = '<p class="error">El email no puede estar vacío</p>';
    }else if(is_numeric($_POST['correo'])){
        $objF->hayerror['correo'] = '<p class="error">El email no puede ser un número</p>';
    }else if (filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL) == false){
        $objF->hayerror['correo'] = '<p class="error">El email no es válido</p>';
    }else{
        $objF->correo = $_POST['correo'];
    }

    //Compruebo la Clave
    if(empty($_POST['clave1'])){
        $objF->hayerror['clave1'] = '<p class="error">La clave no puede estar vacía</p>';
    }else{
        $objF->clave1 = $_POST['clave1'];
    }
    //Compruebo la Clave segunda
    if(empty($_POST['clave2'])){
        $objF->hayerror['clave2'] = '<p class="error">La clave no puede estar vacía</p>';
    }else{
        $objF->clave2 = $_POST['clave2'];
    }

    if(!empty($_POST['clave1']) && !empty($_POST['clave2'])){
        if($objF->clave1 == $objF->clave2){
            $objF->coincide = true;
            $objF->clave = $objF->clave2;
        }else{
            $objF->hayerror['coincidencia'] = '<p class="error">Las claves no coinciden</p>';
        }
    }

    //Compruebo la Dirección
    if(empty($_POST['direccion'])){
        $objF->hayerror['direccion'] = '<p class="error">La direccion no puede estar vacía</p>';
    }else{
        $objF->direccion = $_POST['direccion'];
    }

    //Compruebo el Teléfono
    if(!empty($_POST['telefono'])){
        if( preg_match('/^(\(\+[0-9]{2}\))?\s*[0-9]{3}\s*[0-9]{6}$/',$_POST['telefono']) == false ){
            $objF->hayerror['telefono'] = '<p class="error">El numero no es válido</p>';
        }/*if(!is_numeric($_POST['telefono'])){
            $objF->hayerror['telefono'] = '<p class="error">El telefono tiene que ser un número</p>';
        }*/else{
            $objF->telefono = $_POST['telefono'];
        }
    }

    $objF->rol = $_POST['rol'];



}

function anulavariables(){
    unset($_SESSION['nombre']);
    unset($_SESSION['nombre']);
    unset($_SESSION['nombre']);
    unset($_SESSION['nombre']);
    unset($_SESSION['nombre']);
}

function confirmaDatos(Formularios &$objF){
    $objF->confirmado = "si";
    //Principio Formulario
    echo " <form action='index.php?p=registrar' method='post' enctype='multipart/form-data'>";
    

    //Imagen
    /*echo "<p>Foto: <input type='file' name='foto' accept='image/*' /></p>";
    if(isset($objF->hayerror) && array_key_exists('foto', $objF->hayerror)){
        echo $objF->hayerror['foto'];
    }*/
    
    //Nombre
    echo "<p>Nombre: <input type='text' name='nombre' 
    value='".$objF->nombre."' size='40' readonly></p>";

    //Apellidos
    echo "<p>Apellidos: <input type='text' name='apellidos' 
    value='".$objF->apellidos."'size='40' readonly></p>";


    //Correo
    echo "<p>Correo Electrónico: <input type='email' name='correo' 
    value='".$objF->correo."' readonly></p>";


    //Clave
    echo "<p>Clave: <input type='text' name='clave1' 
    value='".$objF->clave1."'size='40' readonly></p>";

    
    //Vuelve a introducir la clave
    echo "<p>Vuelve a introducir la clave: <input type='text' 
    name='clave2' value='".$objF->clave2."'size='40' readonly></p>";


    //Dirección
    echo "<p>Dirección: <input type='text' name='direccion' 
    value='".$objF->direccion."'size='40' readonly></p>";


    //Telefono
    echo "<p>Teléfono: <input type='tel' name='telefono'
    value='".$objF->telefono."' readonly></p>";


    //Rol
    echo"<p>Rol: 
    <select name='rol' readonly>";
    if($objF->rol == 'administrador'){
        echo"
        <option value='colaborador'>Colaborador</option>
        <option value='administrador' selected>Administrador</option>";
    }else{
        echo"
        <option value='colaborador' selected>Colaborador</option>
        <option value='administrador'>Administrador</option>";
    }

    echo "</select></p>";

    

    //Cierre y botones
    echo"  <p>
        <input type='submit' value='Enviar'>
        <input type='reset' value='Borrar'>
      </p>
    </form>";

}









function simulaIndex(Formularios &$objF){
    echo "<div class='cuerpo'><main>";
    if(isset($_POST['nombre'])){
        saneaDatos($objF);
    }

    if(isset($_SESSION['obj']) && 
    isset($objF->nombre) && isset($objF->apellidos) 
    && isset($objF->correo) && isset($objF->telefono) 
    && isset($objF->clave1) && $objF->confirmado == 'si'
    && $objF->coincide == true) {
        
        InsertarUsuarioBD($objF);
        muestraDatos($objF);
        unset($_SESSION['obj']);
            

    }else if(isset($_SESSION['obj']) 
          && isset($objF->nombre) && isset($objF->apellidos) 
          && isset($objF->correo) && isset($objF->telefono) 
          && isset($objF->clave1) && $objF->coincide == true) {
            echo "CONFIRMAR";
        
            confirmaDatos(($objF));


    }else{
        echo "BASE";
        formularioRegistroBase($objF);
    }

    
    echo "</main>";

}

?>