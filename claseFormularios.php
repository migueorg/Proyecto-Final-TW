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
}

class Recetas {
    public $id;
    public $idautor;
    public $nombre;
    public $descripcion;
    public $ingredientes;
    public $preparacion;
}
?>