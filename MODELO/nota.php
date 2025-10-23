<?php
class Nota {
    private $idNota;
    private $valor;
    private $fecha;
    private $idAlumno_FK; 
    private $idProfe_FK; 

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
        $this->idAlumno_FK = $datos['idAlumno_FK'] ?? null;
        $this->idProfe_FK = $datos['idProfe_FK'] ?? null;
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
        return $this->idAlumno_FK; 
    }
    public function getIdProfesor(){ 
        return $this->idProfe_FK; 
    }

    public function setValor($valor){ 
        $this->valor = $valor; 
    }
    public function setFecha($fecha){ 
        $this->fecha = $fecha; 
    }
    public function setIdAlumno($idAlumno_FK){ 
        $this->idAlumno_FK = $idAlumno_FK; 
    }
    public function setIdProfesor($idProfesor){ 
        $this->idProfe_FK = $idProfesor; 
    }

    public function insertarNota($datos) {
    $resultado = false;
    $usuario = new Usuario($datos);

    // Buscar IDs del alumno y profesor
    $idAlumno = $usuario->buscarDni($datos['dniAlumno']);
    $idProfesor = $usuario->buscarDni($datos['dniProfesor']);

    if ($idAlumno && $idProfesor) {
        $valorNota = $datos['valorNota'];
        $fechaNota = $datos['fechaNota'] ?? date('Y-m-d'); // si no viene, usar fecha actual

        $base = new BaseDatos();
        $sql = "INSERT INTO nota (valor, fecha, idAlumno_FK, idProfe_FK) 
                VALUES (:valor, :fecha, :idAlumno, :idProfesor)";
        $stmt = $base->prepare($sql);

        if ($stmt->execute([
            ':valor' => $valorNota,
            ':fecha' => $fechaNota,
            ':idAlumno' => $idAlumno,
            ':idProfesor' => $idProfesor
        ])){
        $resultado = true;
        }
    }

    return $resultado;
}


    public function encriptarUnaNota($datos) { // Encripta una sola nota
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

public function encriptarTodasNotas($idAlumno) {
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

    public function desencriptarTodasNotas($idAlumno) { // Todas las notas del alumno
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

    return $notasDesencriptadas;
}


public function desencriptarUnaNota($datos) { // Una sola nota (depende del alumno y el profesor)
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

public function obtenerPromedioPorMes($idAlumno) {
    $base = new BaseDatos();
    $mesNotas = [];
    $promedio = [];
    $notasDesencriptadas = [];

    $sql = "SELECT MONTH(fecha) as mes, valor as nota
            FROM nota 
            WHERE idAlumno_FK = :idAlumno";
    $stmt = $base->prepare($sql);
    $stmt->execute([':idAlumno' => $idAlumno]);
    $mesValor = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $encriptador = new Encriptador("1234567890abcdefghijklmnopqrstuv");
    foreach ($mesValor as $i => $fila) {
        $mesValor[$i]['nota'] = $encriptador->desencriptar($fila['nota']);
    }

    foreach ($mesValor as $fila) {
        $mes = $fila['mes'];
        $nota = $fila['nota'];

        if (!isset($mesNotas[$mes])) {
            $mesNotas[$mes] = [];
        }

        $mesNotas[$mes][] = $nota;

    }

    foreach ($mesNotas as $mes => $notas) {
        $promedio[$mes] = array_sum($notas) / count($notas);
    }
    return $promedio;
}
}