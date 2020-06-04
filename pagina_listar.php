<?php
function HTMLpag_listarecetas(){
    require_once("conexionBD.php");
    $db = ConectarDB();    
    if($db){
        if( isset($_SESSION['tipo']) && $_SESSION['tipo']=='administrador' ){    
            $res = mysqli_query($db,"SELECT * FROM recetas ");
        }else if($_SESSION['tipo']=='colaborador'){
            $id = ObtenerId($_SESSION['email']);
            $res = mysqli_query($db,"SELECT * FROM recetas WHERE id='$id'");
        }
        echo "<section class='ingredientes'>
            <ul>";
                $ingredientes = explode(',',$tupla['nombre']);
                foreach($ingredientes as $i){
                    echo "<li>".$i."</li>";
                }
                
            echo "</ul>
        </section>";
    }
}
?>