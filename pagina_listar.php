<?php
require_once("conexionBD.php");
function HTMLpag_listarecetas(){
    
    $db = ConectarDB();    
    if($db){
        
        /*if( isset($_SESSION['tipo']) && $_SESSION['tipo']=='administrador' ){    //Si soy administrador busco todas las recetas
            $res = mysqli_query($db,"SELECT * FROM recetas ");
        }else if($_SESSION['tipo']=='colaborador'){
            $id = ObtenerId($_SESSION['email']);
            $res = mysqli_query($db,"SELECT * FROM recetas WHERE idautor='".$id."'");    //Si soy colaborador busco solo mis recetas
            $autor = $_SESSION['nombre'];
        }*/       
        
        $res = mysqli_query($db,"SELECT * FROM recetas ");
        MenuListar($res);
    }
}
?>