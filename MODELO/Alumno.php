<?php
require_once('Usuario.php'); 
class Alumno extends Usuario {
    
    private $legajo;

    // Constructor con parámetros opcionales
    public function __construct($idUsuario = null, $dni = null, $email = null, $nombre = null, $apellido = null, $contrasenia = null, $rol = null, $legajo = null) {
        parent::__construct($idUsuario, $dni, $email, $nombre, $apellido, $contrasenia, $rol);
        $this->legajo = $legajo;
    }


    public function getLegajo() {
        return $this->legajo;
    }

    public function setLegajo($legajo) {
        $this->legajo = $legajo;
    }

        public function listar($condicion = "") {
        $arreglo = [];
        $base = new BaseDatos();

        $sql = "SELECT * FROM alumno";
        if ($condicion != "") {
            $sql .= " WHERE " . $condicion;
        }
        $cant = $base->Ejecutar($sql);
        if ($cant > 0) {
            while ($fila = $base->Registro()) {
                $obj = new Alumno();
                $obj->cargarDatos($fila);
                $arreglo[] = $obj;
            }
        }
        return $arreglo;
    }

    // Nuevo método
    public function buscarLegajo($idUsuario) {
        $base = new BaseDatos();
        $sql = "SELECT legajo FROM alumno WHERE idUsuario = :id";
        $stmt = $base->prepare($sql);
        $stmt->execute(['id' => $idUsuario]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila && isset($fila['legajo'])) {
            $this->legajo = $fila['legajo']; // asigna al objeto
            return $this->legajo;
        }

        return null;
    }

}
?>