<?php
require_once('Usuario.php'); 

class Profe extends Usuario {
    
    private $nombreMateria;

    
    public function __construct($idUsuario, $dni, $email, $nombre, $apellido, $contrasenia, $rol, $nombreMateria) {
        
        parent::__construct($idUsuario, $dni, $email, $nombre, $apellido, $contrasenia, $rol);
        
      
        $this->nombreMateria = $nombreMateria;
    }


    public function getNombreMateria() {
        return $this->nombreMateria;
    }

    public function setNombreMateria($nombreMateria) {
        $this->nombreMateria = $nombreMateria;
    }
}
?>