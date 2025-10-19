<?
class abmProfesor {

    public function listar($condicion = "") {
        $profesor = new Profesor();
        return $profesor->listar($condicion);
    }
    
    public function encriptarNotas($nota, $fecha, $idAlumno, $idProfesor) {
        $encriptador = new Encriptador("1234567890abcdefghijklmnopqrstuv");
        $notaEncriptada = $encriptador->encriptar($nota);

        $base = new BaseDatos();
        $sql = "INSERT INTO nota (valor, fecha, idAlumno_FK, idProfe_FK) 
                VALUES (:valor, :fecha, :idAlumno, :idProfe)";
        $stmt = $base->prepare($sql);
        $stmt->execute([
            ':valor' => $notaEncriptada,
            ':fecha' => $fecha,
            ':idAlumno' => $idAlumno,
            ':idProfe' => $idProfesor
        ]);
    }

}