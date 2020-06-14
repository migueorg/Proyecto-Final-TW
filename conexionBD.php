<?php
require_once "credenciales.php";
require_once "claseFormularios.php";
function ConectarDB(){
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD,DB_DATABASE);
    mysqli_set_charset($db,"utf8");
    if (!$db)
        return "Error de conexión a la base de datos (".mysqli_connect_errno().") : ".mysqli_connect_error();
    else
        return $db;
}

function ObtenerEmailConID($idusuario){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT email FROM usuarios WHERE id='{$idusuario}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $id = $db_tupla['email'];
        return $id;
    } else
        return null;
}

function ObtenerId($email){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT id FROM usuarios WHERE email='{$email}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $id = $db_tupla['id'];
        return $id;
    } else
        return null;
}

function ObtenerClave($email){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT password FROM usuarios WHERE email='{$email}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $password = $db_tupla['password'];
        return $password;
    } else
        return null;
}

function ObtenerFoto($email){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT foto FROM usuarios WHERE email='{$email}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $foto = $db_tupla['foto'];
        return $foto;
    } else
        return null;
}

function ObtenerCategoria($id){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT categoria FROM listacategorias WHERE categoria_id='{$id}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $categoria = $db_tupla['categoria'];
        return $categoria;
    } else
        return null;
}

function ObtenerNombre($email){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT nombre FROM usuarios WHERE email='{$email}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $nombre = $db_tupla['nombre'];
        return $nombre;
    } else
        return null;
}

function ObtenerNombreR($id){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT nombre FROM recetas WHERE id='{$id}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $nombre = $db_tupla['nombre'];
        return $nombre;
    } else
        return null;
}

function ObtenerIdAutorR($id){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT idautor FROM recetas WHERE id='{$id}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $salida = $db_tupla['idautor'];
        return $salida;
    } else
        return null;
}

function ObtenerDescripcionR($id){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT descripcion FROM recetas WHERE id='{$id}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $salida = $db_tupla['descripcion'];
        return $salida;
    } else
        return null;
}

function ObtenerIngredientesR($id){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT ingredientes FROM recetas WHERE id='{$id}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $salida = $db_tupla['ingredientes'];
        return $salida;
    } else
        return null;
}

function ObtenerPreparacionR($id){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT preparacion FROM recetas WHERE id='{$id}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $salida = $db_tupla['preparacion'];
        return $salida;
    } else
        return null;
}

function ObtenerAutor($id){ //Obtiene el nombre según el id del autor
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT nombre FROM usuarios WHERE id='{$id}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $autor = $db_tupla['nombre'];
        return $autor;
    } else
    echo "NULLLL";
        return null;

}

function ObtenerApellidos($email){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT apellidos FROM usuarios WHERE email='{$email}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $apellidos = $db_tupla['apellidos'];
        return $apellidos;
    } else
        return null;

}

function ObtenerTipoUsuario($email){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT tipo FROM usuarios WHERE email='{$email}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $tipo = $db_tupla['tipo'];
        return $tipo;
    } else
        return null;

}

function ObtenerDireccion($email){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT direccion FROM usuarios WHERE email='{$email}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $direccion = $db_tupla['direccion'];
        return $direccion;
    } else
        return null;

}

function ObtenerTelefono($email){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT telefono FROM usuarios WHERE email='{$email}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $telefono = $db_tupla['telefono'];
        return $telefono;
    } else
        return null;

}

function YaExisteUsuario($nuevo_user){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT email FROM usuarios WHERE email='{$nuevo_user}'");
    $db_tupla = mysqli_fetch_assoc($res);
    $antiguo = $db_tupla['email'];
    if( $antiguo == $nuevo_user ){
        return true;
    } else
        return false;
}


function ConsultaGeneral($select,$where){
    $db=ConectarDB();
    $res = mysqli_query($db,"SELECT '{$select}' FROM usuarios WHERE '{$where}'='{$where}'");
    if( $res ){
        $db_tupla = mysqli_fetch_assoc($res);
        $celda = $db_tupla[$where];
        return $celda;
    } else
        return null;

}


function RecuperaUsuariosTmp(){
    $db=ConectarDB();
    $consultatmp = "SELECT * FROM usuarios_pendientes WHERE verificado='no'";
    $res = mysqli_query($db,$consultatmp) or trigger_error("Query Failed! SQL: $consultatmp - Error: ".mysqli_error($db), E_USER_ERROR);
    return $res;
}

function RecuperaUsuarios(){
    $db=ConectarDB();
    $consultatmp = "SELECT * FROM usuarios";
    $res = mysqli_query($db,$consultatmp) or trigger_error("Query Failed! SQL: $consultatmp - Error: ".mysqli_error($db), E_USER_ERROR);
    return $res;
}

function ValidaUsuarioTmp($id_rol){
    $db=ConectarDB();
    $consultatmp = "UPDATE usuarios SET tipo='administrador' WHERE id = '$id_rol'";
    $consultatmp2 = "DELETE FROM usuarios_pendientes WHERE id = '$id_rol'";
    
    $res = mysqli_query($db,$consultatmp) or trigger_error("Query Failed! SQL: $consultatmp - Error: ".mysqli_error($db), E_USER_ERROR);

    if($res){
        $res2 = mysqli_query($db,$consultatmp2) or trigger_error("Query Failed! SQL: $consultatmp2 - Error: ".mysqli_error($db), E_USER_ERROR);
        if($res2){
            echo "<h1>Validación exitosa</h1>";
        }
    }
    
}

function InsertarUsuarioBD(Formularios $objF){
    $db=conectarDB();
    if($db){
        $id_unico = uniqid();
        $nombre = addslashes( htmlentities( ucwords( $objF->nombre ) ) );
        $apellido = addslashes( htmlentities( ucwords( $objF->apellidos ) ) );
        $correo = addslashes( htmlentities( $objF->correo ) );
        $clave = addslashes( htmlentities( password_hash( $objF->clave, PASSWORD_DEFAULT ) ) );
        $rol = addslashes( htmlentities( $objF->rol ) ) ;
        $fotillo = $objF->foto;
        $direccion = addslashes( htmlentities( ucwords( $objF->direccion ) ) );
        $telefono = addslashes( htmlentities( ucwords( $objF->telefono ) ) );
        
        $consulta="INSERT INTO usuarios (id, nombre, apellidos, email, password, tipo, foto, direccion, telefono) VALUES ('$id_unico','$nombre','$apellido'
        ,'$correo','$clave','colaborador', '$fotillo', '$direccion', '$telefono')";
        //Los usuarios registrados siempre van a entrar como colaboradores
        
        $res = mysqli_query($db,$consulta) or trigger_error("Query Failed! SQL: $consulta - Error: ".mysqli_error($db), E_USER_ERROR);
        
        //Si ha solicitado ser administrador, será colaorador hasta que lo acepten
        if($rol == 'administrador'){
            $consulta2="INSERT INTO usuarios_pendientes (id, nombre, apellidos, email, password, foto, direccion, telefono, verificado) VALUES ('$id_unico','$nombre','$apellido'
            ,'$correo','$clave','$fotillo', '$direccion', '$telefono','no')";
        
            $res2 = mysqli_query($db,$consulta2) or trigger_error("Query Failed! SQL: $consulta2 - Error: ".mysqli_error($db), E_USER_ERROR);

            if($res2){
                echo "<h1>Usuario insertado correctamente a la lista de temporales</h1>";
            }else echo "<h1>Fallo al insertar a la lista de temporales</h1>";   
    
        }

        if($res){
            echo "<h1>Usuario insertado correctamente</h1>";
        }else{
            echo "<h1>Fallo al insertar</h1>";
            
        }
    }else
        return null;

}

function ActualizarUsuarioBD(Formularios $objF){
    $db=conectarDB();
    if($db){
        $id_unico = $objF->id;
        $nombre = addslashes( htmlentities( ucwords( $objF->nombre ) ) );
        $apellido = addslashes( htmlentities( ucwords( $objF->apellidos ) ) );
        $correo = addslashes( htmlentities( $objF->correo ) );
        $clave = addslashes( htmlentities( password_hash( $objF->clave, PASSWORD_DEFAULT ) ) );
        $rol = addslashes( htmlentities( $objF->rol ) ) ;
        $fotillo = $objF->foto;
        $direccion = addslashes( htmlentities( ucwords( $objF->direccion ) ) );
        $telefono = addslashes( htmlentities( ucwords( $objF->telefono ) ) );
        
        $consulta=
        "UPDATE usuarios 
        SET nombre = '$nombre',
            apellidos = '$apellido', 
            email = '$correo', 
            password = '$clave', 
            tipo = '$rol',
            direccion = '$direccion', 
            telefono = '$telefono' 
            WHERE id = '$id_unico'";

        $consulta_con_foto=
        "UPDATE usuarios 
        SET nombre = '$nombre',
            apellidos = '$apellido', 
            email = '$correo', 
            password = '$clave', 
            tipo = '$rol',
            foto = '$fotillo',
            direccion = '$direccion', 
            telefono = '$telefono' 
            WHERE id = '$id_unico'";
        
        if($objF->modificaFoto == 'si') $consulta = $consulta_con_foto;

        $res = mysqli_query($db,$consulta) or trigger_error("Query Failed! SQL: $consulta - Error: ".mysqli_error($db), E_USER_ERROR);
        
        if($res){
            echo "<h1>Usuario insertado correctamente</h1>";
        }else{
            echo "<h1>Fallo al insertar</h1>";
            
        }
    }else
        return null;

}

function BorrarUsuario($id){
    $db=conectarDB();
    if($db){
        $consulta="DELETE FROM usuarios WHERE id='$id'";

        $res = mysqli_query($db,$consulta) or trigger_error("Query Failed! SQL: $consulta - Error: ".mysqli_error($db), E_USER_ERROR);

        if($res){
            echo "<h1>Usuario borrado correctamente</h1>";
        }else{
            echo "<h1>Fallo al borrar</h1>";
        }
    } 
}


function InsertarRecetaBD(Recetas $objR){
    $db=conectarDB();
    if($db){
        $id_unico = uniqid();
        $id_autor = ObtenerId($_SESSION['email']);
        $nombre = addslashes( htmlentities( ucwords( $objR->nombre ) ) );
        $descripcion = addslashes( htmlentities($objR->descripcion ) );
        $ingredientes = addslashes( htmlentities($objR->ingredientes ) );
        $preparacion = addslashes( htmlentities($objR->ingredientes ) );

        $consulta="INSERT INTO recetas (id, idautor, nombre, descripcion, ingredientes, preparacion) VALUES ('$id_unico', '$id_autor','$nombre','$descripcion'
        ,'$ingredientes','$preparacion')";

        for($i=0; $i < count($objR->categorias); $i++){
            $categoria_id = $objR->categorias[$i];
            $consulta_categorias="INSERT INTO categorias (receta_id, categoria_id) VALUES ('$id_unico', '$categoria_id')";
            $res = mysqli_query($db,$consulta_categorias);
            if(!$res){
                echo "<h1>Fallo al insertar</h1>";
            }
        }

        $res = mysqli_query($db,$consulta) or trigger_error("Query Failed! SQL: $consulta - Error: ".mysqli_error($db), E_USER_ERROR);

        if($res){
            echo "<h1>Receta insertada correctamente</h1>";
        }else{
            echo "<h1>Fallo al insertar</h1>";
        }
    }else
        return null;

}

function InsertarLog($evento){
    $db=conectarDB();
    if($db){
        $fecha = date('l jS \of F Y h:i:s A');

        $consulta="INSERT INTO log (fecha, descripcion) VALUES ('$fecha', '$evento')";

        $res = mysqli_query($db,$consulta) or trigger_error("Query Failed! SQL: $consulta - Error: ".mysqli_error($db), E_USER_ERROR);

    }else
        return null;

}

function MenuListarLog(){
    $db = ConectarDB();
    $res = mysqli_query($db,"SELECT * FROM log ");
    $tuplas=mysqli_fetch_all($res,MYSQLI_ASSOC);
    echo "<div class='cuerpo'><main><h1>Log del sistema</h1><ul>";
        for($i=0; $i < count($tuplas); $i++){
            echo "<li class='botoneslista'>";
            echo "<p>".$tuplas[$i]['fecha']."</p>";
            echo "<p>".$tuplas[$i]['descripcion']."</p>";
            echo "</li>";
        }
    echo "</ul></main>";
}

function ActualizarRecetaBD(Recetas $objR){
    $db=conectarDB();
    if($db){
        $id_unico = $objR->id;//uniqid();
        $nombre = addslashes( htmlentities( ucwords( $objR->nombre ) ) );
        $descripcion = addslashes( htmlentities($objR->descripcion ) );
        $ingredientes = addslashes( htmlentities($objR->ingredientes ) );
        $preparacion = addslashes( htmlentities($objR->ingredientes ) );

        $consulta=
        "UPDATE recetas 
        SET nombre = '$nombre',
            descripcion = '$descripcion', 
            ingredientes = '$ingredientes',
            preparacion = '$preparacion'
            WHERE id = '$id_unico'";


        $res = mysqli_query($db,$consulta) or trigger_error("Query Failed! SQL: $consulta - Error: ".mysqli_error($db), E_USER_ERROR);
        
        if($res){
            echo "<h1>Receta actualizada correctamente</h1>";
        }else{
            echo "<h1>Fallo al actualizar</h1>";
            
        }
    }else
        return null;

}

function BorrarReceta($idReceta){

    $db=conectarDB();
    if($db){

        $consulta="DELETE FROM recetas WHERE id='$idReceta' ";
        $res = mysqli_query($db,$consulta) or trigger_error("Query Failed! SQL: $consulta - Error: ".mysqli_error($db), E_USER_ERROR);

        if($res){
            echo "<h1>Receta borrada correctamente</h1>";
        }else{
            echo "<h1>Fallo al borrar</h1>";
        }
    }

}

function MenuListar($db){
    $tuplas=mysqli_fetch_all($db,MYSQLI_ASSOC);

    echo "<h1>Listado general de recetas</h1>";
    
        echo "<ul>";
            for($i=0; $i < count($tuplas); $i++){
                $array_nombres[] = $tuplas[$i]['nombre'];
                $array_autor[] = $tuplas[$i]['idautor'];
                $autor = ObtenerAutor($array_autor[$i]);
                echo "<li class='botoneslista'><p>Título receta:</p><p>".$array_nombres[$i]."</p>";
                echo "<p>Autor:</p><p>".$autor."</p>";
                echo "<div><form action='index.php?p=ver_recetas' method='post'>";
                echo "<input type='submit' name='ver' value='Ver'/>";
                echo "<input name='idReceta' type='hidden' value='{$tuplas[$i]['id']}'></form>";
                if( isset($_SESSION['tipo']) && $_SESSION['tipo']=='administrador' ){
                    echo "<form action='index.php?p=editar_receta' method='post'>";
                    echo "<input type='submit' name='editar' value='Editar'/>";
                    echo "<input name='idReceta' type='hidden' value='{$tuplas[$i]['id']}'></form>";
                    echo "<form action='index.php?p=ver_recetas' method='post'>";
                    echo "<input type='submit' name='borrar' value='Borrar'/>";
                    echo "<input name='idReceta' type='hidden' value='{$tuplas[$i]['id']}'></form>";
                }
                echo "</div></li>";
            }
    echo "</ul>";
}

function insertaComentario($mensaje,$idReceta){
    $db=conectarDB();
    if($db){

        $idComentario = uniqid();
        $idAutor = $_SESSION['id'];
        $nombre = $_SESSION['nombre'];
        //$mensaje = $_POST['mensaje'];
        //$idReceta = $_POST['idreceta'];

        $consulta="INSERT INTO comentarios (idcomentario,idautor,nombre,mensaje,idreceta) 
                    VALUES ('$idComentario','$idAutor','$nombre','$mensaje','$idReceta') ";
        
        $res = mysqli_query($db,$consulta) or trigger_error("Query Failed! SQL: $consulta - Error: ".mysqli_error($db), E_USER_ERROR);

        if($res){
            echo "<h1>Comentario añadido correctamente</h1>";
        }else{
            echo "<h1>Fallo al comentar</h1>";
        }
    }
}

function listaComentariosReceta($idReceta){
    $db=conectarDB();
    if($db){
        $res = mysqli_query($db,"SELECT * FROM comentarios WHERE idreceta='$idReceta'");
        
        if($res){
            while ($tupla=mysqli_fetch_array($res)){
                echo "<h2>Comentario:</h2>";
                echo "<p>Usuario: {$tupla['nombre']}</p>";
                echo "<p>Comentario: {$tupla['mensaje']}</p>";
                if(isset($_SESSION['tipo'])){
                    if($_SESSION['tipo'] == 'administrador' || $_SESSION['id'] == $tupla['idautor']){
                        $idComentario = $tupla['idcomentario'];
                        echo"<form action='index.php?p=nuevo_coment' method='post'>
                        <input type='submit' name='borrar' value='Borrar Comentario' />
                        <input name='idComentario' type='hidden' value='$idComentario'>
                        </form>";
                    }
                }
            }
        }
    }
}

function obtenerComentario($idComentario){
    $db=conectarDB();
    $salida = null;
    if($db){
        $res = mysqli_query($db,"SELECT * FROM comentarios WHERE idcomentario='$idComentario'");
        
        if($res){
            $salida = mysqli_fetch_assoc($res);
        }
    }
    return $salida;
}

function borrarComentario($idComentario){
    $db=conectarDB();
    if($db){
        $res = mysqli_query($db,"DELETE FROM comentarios WHERE idcomentario='$idComentario'");
        
        if($res){
            echo "<h1>Comentario Borrado Correctamente</h1>";
        }else{
            echo "<h1>Fallo al borrar</h1>";
        }
    }
}


function obtenFotosReceta($idReceta){
    $db=conectarDB();
    if($db){
        $res = mysqli_query($db,"SELECT imagen FROM fotos WHERE idreceta='$idReceta'");

        if($res){
            while($tupla=mysqli_fetch_array($res)){
                echo "<section class='foto'>";
                echo "<img src='data:image/jpg;base64, ";
                echo base64_encode($tupla['imagen']);
                echo "'width='200' />";
                //Mas adelante aqui va el boton borrar
                //Para discriminar de cuando las estas añadiendo puedes usar un if con algun post
            }
        }

    }

}

function obtenFotosRecetaMain($idReceta){
    $db=conectarDB();
    if($db){
        $res = mysqli_query($db,"SELECT imagen FROM fotos WHERE idreceta='$idReceta'");

        if($res){
            $tupla=mysqli_fetch_array($res);
            while($tupla=mysqli_fetch_array($res)){
                echo "<section class='foto'>";
                echo "<img src='data:image/jpg;base64, ";
                echo base64_encode($tupla['imagen']);
                echo "'width='200' />";
            }
        }

    }

}

function obtenFotoTitulo($idReceta){
    $db=conectarDB();
    if($db){
        $res = mysqli_query($db,"SELECT imagen FROM fotos WHERE idreceta='$idReceta'");

        if($res){
            $tupla=mysqli_fetch_array($res);
            echo "<section class='foto'>";
            echo "<img src='data:image/jpg;base64, ";
            echo base64_encode($tupla['imagen']);
            echo "'width='200' />";
            
        }

    }
}

function insertaFotosReceta($idReceta,$foto){
    $db=conectarDB();
    if($db){

        $consulta="INSERT INTO fotos (idreceta, imagen) VALUES ('$idReceta','$foto')";

        $res = mysqli_query($db,$consulta) or trigger_error("Query Failed! SQL: $consulta - Error: ".mysqli_error($db), E_USER_ERROR);

        if($res){
            //echo "Okay";
        }

    }

}

?>
