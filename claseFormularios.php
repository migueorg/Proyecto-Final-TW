<?php

class Formularios {
    public $id;
    public $nombre;
    public $apellidos;
    public $correo;
    public $clave;
    public $clave1;
    public $clave2;
    public $direccion;
    public $telefono;
    public $rol;
    public $confirmado;
    public $hayerror = []; 
    public $contador = 0;
    public $coincide = false;
    public $foto;
    public $tmp_name;
    public $orig_name;

    public $editarIniciado = 'no';
    public $modificaFoto;

    public $usuarioAjeno = 'no';
}

class Recetas {
    public $id;
    public $idautor;
    public $nombre;
    public $descripcion;
    public $ingredientes;
    public $preparacion;
    public $editarIniciado = 'no';
    //public $confirmado;
    public $primeraVez = 'si';
    public $confirmado;
    public $categorias = [];
}
?>