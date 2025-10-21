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

    public function agregarUsuario($datos){
    // hashear la contraseña
    $contrasenia = $datos['contrasenia'];
    $hash = new Hasher();
    $contraseniaHasheada = $hash->hash($contrasenia);
    $baseDatos = new BaseDatos();
    // insertar usuario
    $sql = "INSERT INTO usuario (dni, email, nombre, apellido, contrasenia, rol) 
    VALUES (:dni, :email, :nombre, :apellido, :contrasenia, :tipoUsuario)";
    $stmt = $baseDatos->prepare($sql);
    $stmt->execute([
        ':dni' => $datos['dni'],
        ':email' => $datos['email'],
        ':nombre' => $datos['nombre'],
        ':apellido' => $datos['apellido'],
        ':contrasenia' => $contraseniaHasheada,
        ':tipoUsuario' => $datos['tipoUsuario']
    ]);

    $idUsuario = $baseDatos->lastInsertId();

    if ($datos['tipoUsuario'] === 'alumno' && $datos['legajo'] !== null) {
        $sqlAlumno = "INSERT INTO alumno (idUsuario, legajo) VALUES (:idUsuario, :legajo)";
        $stmtAlumno = $baseDatos->prepare($sqlAlumno);
        $stmtAlumno->execute([
            ':idUsuario' => $idUsuario,
            ':legajo' => $datos['legajo']
        ]);
    } elseif ($datos['tipoUsuario'] === 'profe' && $datos['nombreMateria'] !== null) {
        $sqlProfe = "INSERT INTO profe (idUsuario, nombreMateria) VALUES (:idUsuario, :nombreMateria)";
        $stmtProfe = $baseDatos->prepare($sqlProfe);
        $stmtProfe->execute([
            ':idUsuario' => $idUsuario,
            ':nombreMateria' => $datos['nombreMateria']
        ]);
    }

    }

    public function buscarUsuario($datos){
        $email = $datos['email'];
        $contra = $datos['contrasenia'];
        $res = false;

        $baseDatos = new BaseDatos();
        $hash = new Hasher();

        $sql = "SELECT * FROM usuario WHERE email = :email";
        $stmt = $baseDatos->prepare($sql);
        $stmt->execute([':email' => $email]);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && $hash->verify($contra, $usuario["contrasenia"])) {
            $res = $usuario;
        }
        return $res;
    }

    public function buscarId($dni) {
        $baseDatos = new BaseDatos();
        $res = false;
        $sql = "SELECT idUsuario FROM usuario WHERE dni = :dni";
        $stmt = $baseDatos->prepare($sql);
        $stmt->execute([':dni' => $dni]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario) {
            $res = $usuario['idUsuario'];
        }
        return $res;
    }

}
?>