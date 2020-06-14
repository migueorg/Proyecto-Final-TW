<?php

require_once "registrar.php";
require_once "conexionBD.php";
require_once "claseFormularios.php";



function saneaDatosEditar(Formularios &$objF){
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
    }else if(YaExisteUsuario($_POST['correo'])){
        $objF->hayerror['correo'] = '<p class="error">El email introducido ya existe</p>';
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

    //Falta comprobar la extensión del archivo
    if(isset($_FILES['foto']) ){
        if($_FILES['foto']['error'] != 0){  
            echo "Okey, no modificas la foto";       
            $objF->modificaFoto = 'no';
            //$objF->hayerror['foto'] = '<p class="error">La foto de perfil no puede estar vacía</p>';
        } else{
            echo "CONVIERTO LA FOTO NUEVA";
            $objF->foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
            $objF->orig_name = $_FILES['foto']['name'];
            $objF->modificaFoto = 'si';
            //echo "Imagen: ".$_SESSION['nombrefotografia'];
            //$fotografia_correcto = true;
        }
    } 



}



function editarDatosListar(Formularios &$objF){
    //Principio Formulario
    echo " <form action='index.php?p=editar' method='post' enctype='multipart/form-data'>";
    

    //Imagen
    /*echo "<p>Foto: <input type='file' name='foto' accept='image/*' /></p>";
    if(isset($objF->hayerror) && array_key_exists('foto', $objF->hayerror)){
        echo $objF->hayerror['foto'];
    }*/

    echo "<img src='data:image/jpg;base64, ";
    echo base64_encode(stripslashes($objF->foto));
    echo "'width='200' />";
    echo "<p>Nombre de la foto: ".$objF->orig_name."</p>";
    
    //Nombre
    echo "<p>Nombre: <input type='text' name='nombre' 
    value='".$objF->nombre."' size='40'></p>";

    //Apellidos
    echo "<p>Apellidos: <input type='text' name='apellidos' 
    value='".$objF->apellidos."'size='40'></p>";


    //Correo
    echo "<p>Correo Electrónico: <input type='email' name='correo' 
    value='".$objF->correo."'></p>";


    //Clave
    echo "<p>Clave: <input type='text' name='clave1' 
    size='40'></p>";

    
    //Vuelve a introducir la clave
    echo "<p>Vuelve a introducir la clave: <input type='text' 
    name='clave2' size='40'></p>";


    //Dirección
    echo "<p>Dirección: <input type='text' name='direccion' 
    value='".$objF->direccion."'size='40' ></p>";


    //Telefono
    echo "<p>Teléfono: <input type='tel' name='telefono'
    value='".$objF->telefono."' ></p>";
    echo $objF->telefono;


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
      </p>
    </form>
    
    <form action='index.php'>
        <input type='submit' value='Cancelar' />
    </form>";

}




function formularioEditarBase(Formularios &$objF){

  
    //Principio Formulario
    echo " <form action='index.php?p=editar' method='post' enctype='multipart/form-data'>";
    


    echo "<img src='data:image/jpg;base64, ";
    echo base64_encode(($objF->foto));
    echo "'width='200' />";


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
    echo "<p>Clave: <input type='password' name='clave1'";
    if(isset($objF->clave1)){
        echo " value='".$objF->clave1."' size='40'></p>";
    }
    else if(isset($objF->hayerror) && array_key_exists('clave1', $objF->hayerror)){
        echo "size='40'></p>";
        echo $objF->hayerror['clave1'];
    }
    else echo "size='40'></p>";
    
    //Vuelve a introducir la clave
    echo "<p>Vuelve a introducir la clave: <input type='password' name='clave2'";
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


function confirmaEditarDatos(Formularios &$objF){
    $objF->confirmado = "si";
    //Principio Formulario
    echo " <form action='index.php?p=editar' method='post' enctype='multipart/form-data'>";
    

    //Imagen
    /*echo "<p>Foto: <input type='file' name='foto' accept='image/*' /></p>";
    if(isset($objF->hayerror) && array_key_exists('foto', $objF->hayerror)){
        echo $objF->hayerror['foto'];
    }*/

    echo "<img src='data:image/jpg;base64, ";
    if($objF->modificaFoto == 'si'){
        echo base64_encode(stripslashes($objF->foto));
    }else{
        echo base64_encode($objF->foto);
    }
    echo "'width='200' />";
    echo "<p>Nombre de la foto: ".$objF->orig_name."</p>";
    
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
    echo "<p>Clave: <input type='password' name='clave1' 
    value='".$objF->clave1."'size='40' readonly></p>";

    
    //Vuelve a introducir la clave
    //echo "<p>Vuelve a introducir la clave: <input type='text' 
    //name='clave2' value='".$objF->clave2."'size='40' readonly></p>";


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
      </p>
    </form>
    
    <form action='index.php'>
        <input type='submit' value='Cancelar' />
    </form>";

}



//Esta funcion creo que se puede borrar
function HTMLpag_editar() {
    echo "<div class='cuerpo'><main>";
    if(session_status()==PHP_SESSION_NONE)
    session_start();

    if(!isset($_SESSION['obj_edit'])){
        //echo "No esta creado";
        $objF_edit = new Formularios;
        $objF_edit->nombre=ObtenerNombre($_SESSION['email']);
        $objF_edit->apellidos=ObtenerApellidos($_SESSION['email']);
        $objF_edit->correo=$_SESSION['email'];
        $objF_edit->foto=ObtenerFoto($_SESSION['email']);
        $objF_edit->tipo=ObtenerTipoUsuario($_SESSION['email']);
        $objF_edit->direccion=ObtenerDireccion($_SESSION['email']);
        $objF_edit->telefono=ObtenerTelefono($_SESSION['email']);
        $_SESSION['obj_edit'] = $objF_edit;
        echo "holaaaaa";
    }//else echo "Ya esta crado el objeto";

    editarDatosListar($_SESSION['obj_edit']);
    unset($_SESSION['obj_edit']);

    echo "adios";
    echo "</main>";
}

//Esta funcion creo que se puede borrar
function pruebaEditar(){
    if(session_status()==PHP_SESSION_NONE)
    session_start();

    if(!isset($_SESSION['obj_edit'])){
        //echo "No esta creado";
        $objF_edit = new Formularios;
        $objF_edit->nombre=ObtenerNombre($_SESSION['email']);
        $objF_edit->apellidos=ObtenerApellidos($_SESSION['email']);
        $objF_edit->correo=$_SESSION['email'];
        $objF_edit->foto=ObtenerFoto($_SESSION['email']);
        $objF_edit->tipo=ObtenerTipoUsuario($_SESSION['email']);
        $objF_edit->direccion=ObtenerDireccion($_SESSION['email']);
        $objF_edit->telefono=ObtenerTelefono($_SESSION['email']);
        $_SESSION['obj_edit'] = $objF_edit;
    }//else echo "Ya esta crado el objeto";

    editarDatosListar($_SESSION['obj_edit']);
    //unset($_SESSION['obj_edit']);
}

function inicializaObj(Formularios &$objF){
    $objF->id=ObtenerId($_SESSION['email']);
    $objF->nombre=ObtenerNombre($_SESSION['email']);
    $objF->apellidos=ObtenerApellidos($_SESSION['email']);
    $objF->correo=$_SESSION['email'];
    $objF->foto=ObtenerFoto($_SESSION['email']);
    $objF->tipo=ObtenerTipoUsuario($_SESSION['email']);
    $objF->direccion=ObtenerDireccion($_SESSION['email']);
    $objF->telefono=ObtenerTelefono($_SESSION['email']);
    $objF->editarIniciado = 'si';
    $_SESSION['obj_editar'] = $objF;
}


function muestraDatosEditar(Formularios $objF){
    
    //echo "<h1>Datos recibidos correctamente</h1>";
    echo "<img src='data:image/jpg;base64, ";
    if($objF->modificaFoto == 'si'){
        echo base64_encode(stripslashes($objF->foto));
    }else{
        echo base64_encode($objF->foto);
    }    echo "'width='200' />";
    echo "<p>Nombre: ".$objF->nombre."</p>";
    echo "<p>Apellidos: ".$objF->apellidos."</p>";
    echo "<p>Correo: ".$objF->correo."</p>";
    echo "<p>Clave: ".$objF->clave1."</p>";
    echo "<p>Direccion: ".$objF->direccion."</p>";
    echo "<p>Telefono: ".$objF->telefono."</p>";
    echo "<p>Rol: ".$objF->rol."</p>";
    
    //echo "<p>Nombre temporal de la foto: ".$objF->tmp_name."</p>";
}

function forzarCierreSesion(){
    // La sesión debe estar iniciada
    if (session_status()==PHP_SESSION_NONE)
    session_start();     //No podemos borrar una variable que no existe, por si acaso la creo y la borro
    // Borrar variables de sesión
    //$_SESSION = array();
    session_unset();
    // Destruir sesión
    session_destroy();
}

function inicializaYRedirigeEditar(){
    $idusuario = $_POST['idUsuario'];
    $email = ObtenerEmailConID($idusuario);

    $obj_editar = new Formularios;

    $obj_editar->id=$idusuario;
    $obj_editar->nombre=ObtenerNombre($email);
    $obj_editar->apellidos=ObtenerApellidos($email);
    $obj_editar->correo=$email;
    $obj_editar->foto=ObtenerFoto($email);
    $obj_editar->tipo=ObtenerTipoUsuario($email);
    $obj_editar->direccion=ObtenerDireccion($email);
    $obj_editar->telefono=ObtenerTelefono($email);
    $obj_editar->editarIniciado = 'si';
    $obj_editar->usuarioAjeno = 'si';

    $_SESSION['obj_editar'] = $obj_editar;

    simulaIndexEditar($_SESSION['obj_editar']);
}





function simulaIndexEditar(Formularios &$objF){
    echo "<div class='cuerpo'><main>";

    if($objF->editarIniciado == 'no'){
        echo "ENtro a INICIALIZAR OBJ";
        inicializaObj($objF);
    }

    if(isset($_POST['nombre'])){
        //saneaDatos($objF);
        echo "ENTRO A SANEAR OBJ";
        saneaDatosEditar($objF);
    }

    if(isset($_SESSION['obj_editar']) && 
    isset($objF->nombre) && isset($objF->apellidos) 
    && isset($objF->correo) && isset($objF->clave2)
    && isset($objF->clave1) && $objF->confirmado == 'si'
    && $objF->coincide == true) {
        
        ActualizarUsuarioBD($objF);
        muestraDatosEditar($objF);
        unset($_SESSION['obj_edit']);
        if($objF->usuarioAjeno == 'no'){
            forzarCierreSesion();
        }
            

    }else if(isset($_SESSION['obj_editar']) 
          && isset($objF->nombre) && isset($objF->apellidos) 
          && isset($objF->correo)
          && isset($objF->clave1) && isset($objF->clave2)
          && $objF->coincide == true && isset($objF->foto)){
            
            echo "<h1>¿Desea enviar estos datos?</h1>";
        
            confirmaEditarDatos(($objF));


    }else{
        echo "<h1>Rellene los campos</h1>";
        formularioEditarBase($objF);
    }

    
    echo "</main>";

}




?>