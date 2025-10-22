<?php

class abmNota {
    private $idNota;
    private $valor;
    private $fecha;
    private $idAlumno;
    private $idProfesor;


    // Constructor opcional
    public function __construct($datos = []) {
        if (!empty($datos)) {
            $this->cargarDatos($datos);
        }
    }

    // Cargar datos en el objeto
    public function cargarDatos($datos) {
        $this->idNota = $datos['idNota'] ?? null;
        $this->valor = $datos['valor'] ?? null;
        $this->fecha = $datos['fecha'] ?? null;
        $this->idAlumno = $datos['idAlumno'] ?? null;
        $this->idProfesor = $datos['idProfesor'] ?? null;
    }

    // Getters y Setters
    public function getIdNota(){ 
        return $this->idNota; 
    }
    public function getValor(){ 
        return $this->valor; 
    }
    public function getFecha(){ 
        return $this->fecha; 
    }
    public function getIdAlumno(){ 
        return $this->idAlumno; 
    }
    public function getIdProfesor(){ 
        return $this->idProfesor; 
    }

    public function setValor($valor){ 
        $this->valor = $valor; 
    }
    public function setFecha($fecha){ 
        $this->fecha = $fecha; 
    }
    public function setIdAlumno($idAlumno){ 
        $this->idAlumno = $idAlumno; 
    }
    public function setIdProfesor($idProfesor){ 
        $this->idProfesor = $idProfesor; 
    }

    public function obtenerNotaDesencriptada($datos){
    $resultado = false;
    $usuario = new Usuario($datos);
    $idAlumno = $usuario->buscarDni($datos['dniAlumno']);
    $idProfesor = $usuario->buscarDni($datos['dniProfesor']);
       
    if ($idAlumno && $idProfesor) {
            $base = new BaseDatos();
            $sql = "INSERT INTO nota (valor, fecha, idAlumno_FK, idProfe_FK) 
                    VALUES (:valor, :fecha, :idAlumno, :idProfesor)";
            $stmt = $base->prepare($sql);

            if ($stmt->execute([
                ':valor' => $datos['valorNota'],
                ':fecha' => $datos['fechaNota'],
                ':idAlumno' => $idAlumno,
                ':idProfesor' => $idProfesor
            ])) {
                $resultado = true;
            }
        }
        return $resultado;
    }


    public function encriptarNota($datos) { // Encripta una sola nota
    $resultado = false;
    $usuario = new Usuario($datos);

    // Buscar IDs
    $idAlumno = $usuario->buscarDni($datos['dniAlumno']);
    $idProfesor = $usuario->buscarDni($datos['dniProfesor']);

    if ($idAlumno && $idProfesor) {
        $encriptador = new Encriptador("1234567890abcdefghijklmnopqrstuv");

        // Encriptar el valor de la nota
        $notaEncriptada = $encriptador->encriptar($datos['valorNota']);

        // Actualizar la nota existente
        $base = new BaseDatos();
        $sql = "UPDATE nota 
                SET valor = :valor 
                WHERE idAlumno_FK = :idAlumno 
                AND idProfe_FK = :idProfesor";

        $stmt = $base->prepare($sql);
        $resultado = $stmt->execute([
            ':valor' => $notaEncriptada,
            ':idAlumno' => $idAlumno,
            ':idProfesor' => $idProfesor
        ]);
    }

    return $resultado;
}

public function encriptarNotas($idAlumno) {
    $resultado = false;
    $base = new BaseDatos();
    $sql = "SELECT idNota, valor FROM nota WHERE idAlumno_FK = :idAlumno";
    $stmt = $base->prepare($sql);
    $stmt->execute([':idAlumno' => $idAlumno]);

    $encriptador = new Encriptador("1234567890abcdefghijklmnopqrstuv");
    $notas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($notas) {
        $sqlUpdate = "UPDATE nota SET valor = :valor WHERE idNota = :idNota";
        $stmtUpdate = $base->prepare($sqlUpdate);

        foreach ($notas as $fila) {
            // Evita doble encriptación
            $valor = $fila['valor'];
            if (!$this->esTextoEncriptado($valor)) {
                $notaEncriptada = $encriptador->encriptar($valor);
                $stmtUpdate->execute([
                    ':valor' => $notaEncriptada,
                    ':idNota' => $fila['idNota']
                ]);
                $resultado = true;
            }
        }
    }

    return $resultado;
}

    public function esTextoEncriptado($texto) {
    return (preg_match('/^[A-Za-z0-9\/\+=]+$/', $texto) && strlen($texto) > 16);
}



    public function desencriptarNotas($idAlumno) { // Todas las notas del alumno
    $base = new BaseDatos();
    $sql = "SELECT valor FROM nota WHERE idAlumno_FK = :idAlumno";
    $stmt = $base->prepare($sql);
    $stmt->execute([':idAlumno' => $idAlumno]);

    $notasDesencriptadas = [];
    $encriptador = new Encriptador("1234567890abcdefghijklmnopqrstuv");

    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $notaDesencriptada = $encriptador->desencriptar($fila['valor']);
        $notasDesencriptadas[] = $notaDesencriptada;
    }

    return $notasDesencriptadas; // retorna array de notas desencriptadas
}

public function desencriptarNota($datos) { // Una sola nota (depende del alumno y el profesor)
    $resultado = false;
    $usuario = new Usuario($datos);

    $idAlumno = $usuario->buscarDni($datos['dniAlumno']);
    $idProfesor = $usuario->buscarDni($datos['dniProfesor']);

    if ($idAlumno && $idProfesor) {
        $base = new BaseDatos();
        $sql = "SELECT valor FROM nota 
                WHERE idAlumno_FK = :idAlumno 
                AND idProfe_FK = :idProfesor";

        $stmt = $base->prepare($sql);
        $stmt->execute([
            ':idAlumno' => $idAlumno,
            ':idProfesor' => $idProfesor
        ]);

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fila) {
            $encriptador = new Encriptador("1234567890abcdefghijklmnopqrstuv");
            $resultado = $encriptador->desencriptar($fila['valor']);
        }
    }

    return $resultado;
}


}