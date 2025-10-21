<?php
class Usuario {
   
    private $idUsuario;
    private $dni;
    private $email;
    private $nombre;
    private $apellido;
    private $contrasenia; 
    private $rol;

    public function __construct($datos = []) {
        if (count($datos)) {
            $this->cargarDatos($datos);
        }
    }

    public function cargarDatos($datos) {
        if (isset($datos['idUsuario'])) $this->idUsuario = $datos['idUsuario'];
        if (isset($datos['dni'])) $this->dni = $datos['dni'];
        if (isset($datos['email'])) $this->email = $datos['email'];
        if (isset($datos['nombre'])) $this->nombre = $datos['nombre'];
        if (isset($datos['apellido'])) $this->apellido = $datos['apellido'];
        if (isset($datos['contrasenia'])) $this->contrasenia = $datos['contrasenia'];
        if (isset($datos['rol'])) $this->rol = $datos['rol'];
    }

   
    
    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getNombreCompleto() {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRol() {
        return $this->rol;
    }

  
    public function setEmail($email) {
        $this->email = $email;
    }

    public function setContrasenia($nuevoHash) {
        $this->contrasenia = $nuevoHash;
    }

    public function agregarUsuario($dni, $email, $nombre, $apellido, $contrasenia, $rol, $legajo = null, $nombreMateria = null){
    // hashear la contraseña
    $hash = new Hasher();
    $contraseniaHasheada = $hash->hash($contrasenia);
    $baseDatos = new BaseDatos();
    // insertar usuario
    $sql = "INSERT INTO usuario (dni, email, nombre, apellido, contrasenia, rol) 
    VALUES (:dni, :email, :nombre, :apellido, :contrasenia, :rol)";
    $stmt = $baseDatos->prepare($sql);
    $stmt->execute([
        ':dni' => $dni,
        ':email' => $email,
        ':nombre' => $nombre,
        ':apellido' => $apellido,
        ':contrasenia' => $contraseniaHasheada,
        ':rol' => $rol
    ]);

    $idUsuario = $baseDatos->lastInsertId();

    if ($rol === 'alumno' && $legajo !== null) {
        $sqlAlumno = "INSERT INTO alumno (idUsuario, legajo) VALUES (:idUsuario, :legajo)";
        $stmtAlumno = $baseDatos->prepare($sqlAlumno);
        $stmtAlumno->execute([
            ':idUsuario' => $idUsuario,
            ':legajo' => $legajo
        ]);
    } elseif ($rol === 'profe' && $nombreMateria !== null) {
        $sqlProfe = "INSERT INTO profe (idUsuario, nombreMateria) VALUES (:idUsuario, :nombreMateria)";
        $stmtProfe = $baseDatos->prepare($sqlProfe);
        $stmtProfe->execute([
            ':idUsuario' => $idUsuario,
            ':nombreMateria' => $nombreMateria
        ]);
    }

    }

    public function buscarUsuario($datos){
    $email = $datos['email'];
    $contra = $datos['contrasenia'];
    $res = false;

    $baseDatos = new BaseDatos();
    $hash = new Hasher();

    // Consulta segura usando prepared statement
    $sql = "SELECT * FROM usuario WHERE email = :email";
    $stmt = $baseDatos->prepare($sql);
    $stmt->execute([':email' => $email]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si se encontró un usuario y la contraseña coincide
    if ($usuario && $hash->verify($contra, $usuario["contrasenia"])) {
        $res = $usuario;
    }

    return $res;
}

}
?>