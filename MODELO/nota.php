<?php
class Nota {
    private $idNota;
    private $valor;
    private $fecha;
    private $idAlumno_FK; 
    private $idProfe_FK; 

    public function __construct($idNota, $valor, $fecha, $idAlumno_FK, $idProfe_FK) {
        $this->idNota = $idNota;
        $this->valor = $valor;
        $this->fecha = $fecha;
        $this->idAlumno_FK = $idAlumno_FK;
        $this->idProfe_FK = $idProfe_FK;
    }


    public function getIdNota() {
        return $this->idNota;
    }
    
    public function getValor() {
        return $this->valor;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getIdAlumno() {
        return $this->idAlumno_FK;
    }

    public function getIdProfe() {
        return $this->idProfe_FK;
    }

  

    public function setValor($valor) {
        $this->valor = $valor;
    }
}
?>