<?php
include_once __DIR__ . '/../MODELO/Profesor.php';
class abmProfesor {

    /*public function listar($condicion = "") {
        $profesor = new Profesor();
        return $profesor->listar($condicion);
    }*/

    public function encriptarNotas($datos) {
        $resultado = false;
        $usuario = new Usuario($datos);

        $idAlumno = $usuario->buscarDni($datos['dniAlumno']);
        $idProfesor = $usuario->buscarDni($datos['dniProfesor']);
        
        if ($idAlumno && $idProfesor) {
            $encriptador = new Encriptador("1234567890abcdefghijklmnopqrstuv");
            $notaEncriptada = $encriptador->encriptar($datos['valorNota']);

            $base = new BaseDatos();
            $sql = "INSERT INTO nota (valor, fecha, idAlumno_FK, idProfe_FK) 
                    VALUES (:valor, :fecha, :idAlumno, :idProfesor)";
            $stmt = $base->prepare($sql);

            if ($stmt->execute([
                ':valor' => $notaEncriptada,
                ':fecha' => $datos['fechaNota'],
                ':idAlumno' => $idAlumno,
                ':idProfesor' => $idProfesor
            ])) {
                $resultado = true;
            }
        }
        return $resultado;
    }


    public function desencriptarNotas($idAlumno) {
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


}