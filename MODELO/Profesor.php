<?php
require_once('Usuario.php'); 

class Profe extends Usuario {
    private $nombreMateria;

    public function __construct($datos = [], $nombreMateria = null) {
        parent::__construct($datos);
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