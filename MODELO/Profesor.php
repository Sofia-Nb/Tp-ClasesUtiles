<?php
class Profesor {
    private $idProfesor;
    private $nombre;
    private $apellido;
    private $dni;
    private $email;
    private $telefono;
    private $especialidad;
        private $idRol;

    public function __construct($datos = []) {
        if (count($datos)) {
            $this->cargarDatos($datos);
        }
    }

    public function cargarDatos($datos) {
        if (isset($datos['idProfesor'])) $this->idProfesor = $datos['idProfesor'];
        if (isset($datos['nombre'])) $this->nombre = $datos['nombre'];
        if (isset($datos['apellido'])) $this->apellido = $datos['apellido'];
        if (isset($datos['dni'])) $this->dni = $datos['dni'];
        if (isset($datos['email'])) $this->email = $datos['email'];
        if (isset($datos['telefono'])) $this->telefono = $datos['telefono'];
        if (isset($datos['especialidad'])) $this->especialidad = $datos['especialidad'];
        if (isset($datos['idRol'])) $this->idRol = $datos['idRol'];
    }

    // Getters y Setters
    public function getIdProfesor(){ 
        return $this->idProfesor; 
    }
    public function setIdProfesor($idProfesor){ 
        $this->idProfesor = $idProfesor; 
    }

    public function getNombre(){ 
        return $this->nombre; 
    }
    public function setNombre($nombre){ 
        $this->nombre = $nombre; 
    }

    public function getApellido(){ 
        return $this->apellido; 
    }
    public function setApellido($apellido){ 
        $this->apellido = $apellido; 
    }

    public function getDni(){ 
        return $this->dni; 
    }
    public function setDni($dni){
        $this->dni = $dni; 
    }

    public function getEmail(){ 
        return $this->email; 
    }
    public function setEmail($email){ 
        $this->email = $email; 
    }

    public function getTelefono(){ 
        return $this->telefono; 
    }
    public function setTelefono($telefono){ 
        $this->telefono = $telefono; 
    }

    public function getEspecialidad(){ 
        return $this->especialidad; 
    }
    public function setEspecialidad($especialidad){ 
        $this->especialidad = $especialidad; 
    }

    public function getIdRol(){ 
        return $this->idRol; 
    }
    public function setIdRol($idRol){ 
        $this->idRol = $idRol; 
    }

    // =====================
    // Métodos de base de datos
    // =====================

    public function listar($condicion = "") {
        $arreglo = [];
        $base = new BaseDatos();

        $sql = "SELECT * FROM profesor";
        if ($condicion != "") {
            $sql .= " WHERE " . $condicion;
        }
        $cant = $base->Ejecutar($sql);
        if ($cant > 0) {
            while ($fila = $base->Registro()) {
                $obj = new Profesor();
                $obj->cargarDatos($fila);
                $arreglo[] = $obj;
            }
        }
        return $arreglo;
    }

    public function buscarPorRol($rol) {
        $base = new BaseDatos();
        $sql = "SELECT * FROM profesor WHERE idRol = '$rol'";
        $cant = $base->Ejecutar($sql);

        if ($cant > 0) {
            while ($fila = $base->Registro()) {
                $obj = new Profesor();
                $obj->cargarDatos($fila);
                $arreglo[] = $obj;
            }
            return $arreglo;
        } else {
            return null;
        }
    }
}
?>
