<?php
require_once('Usuario.php'); 
class Alumno extends Usuario {
    
    private $legajo;

    public function __construct($idUsuario, $dni, $email, $nombre, $apellido, $contrasenia, $rol, $legajo) {
        
        parent::__construct($idUsuario, $dni, $email, $nombre, $apellido, $contrasenia, $rol);
        
        $this->legajo = $legajo;
    }


    public function getLegajo() {
        return $this->legajo;
    }

    public function setLegajo($legajo) {
        $this->legajo = $legajo;
    }

    
}
?>