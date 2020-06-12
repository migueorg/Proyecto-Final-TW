<?php
require_once("conexionBD.php");
require_once("muestra_receta.php");

function HTMLpag_listarecetas(){
    
    $db = ConectarDB();    
    if($db){
        $res = mysqli_query($db,"SELECT * FROM recetas ");
        MenuListar($res);
    }
}

function simulaIndexListaRecetas(){
    if(isset($_POST['idReceta'])){
        HTMLmostar_receta($_POST['idReceta']);
    }else{
        HTMLpag_listarecetas();
    }
}
?>