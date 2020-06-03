<?php

require_once "registrar.php";
require_once "conexionBD.php";




function editarDatosListar(Formularios &$objF){
    //Principio Formulario
    echo " <form action='index.php?p=registrar' method='post' enctype='multipart/form-data'>";
    

    //Imagen
    /*echo "<p>Foto: <input type='file' name='foto' accept='image/*' /></p>";
    if(isset($objF->hayerror) && array_key_exists('foto', $objF->hayerror)){
        echo $objF->hayerror['foto'];
    }*/

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
        $_SESSION['obj_edit'] = $objF_edit;
        echo "holaaaaa";
    }//else echo "Ya esta crado el objeto";

    editarDatosListar($_SESSION['obj_edit']);
    unset($_SESSION['obj_edit']);

    echo "adios";
    echo "</main>";
}
?>