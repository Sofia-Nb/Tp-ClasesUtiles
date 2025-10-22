<?php
class Usuario {
   
    private $idUsuario;
    private $dni;
    private $email;
    private $nombre;
    private $apellido;
    private $contrasenia; 
    private $rol;

    public function __construct($idUsuario = null, $dni = null, $email = null, $nombre = null, $apellido = null, $contrasenia = null, $rol = null) {
        // Si el primer parámetro es un array, usamos cargarDatos
        if (is_array($idUsuario)) {
            $this->cargarDatos($idUsuario);
        } else {
            // Si no es array, asignamos directamente
            $this->idUsuario = $idUsuario;
            $this->dni = $dni;
            $this->email = $email;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->contrasenia = $contrasenia;
            $this->rol = $rol;
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


    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setContrasenia($nuevoHash) {
        $this->contrasenia = $nuevoHash;
    }

    public function setRol($rol) {
        $this->rol = $rol;
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

    public function buscarDni($dni) {
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

    public function buscarUsuarioId($id) {
    $baseDatos = new BaseDatos();
    $sql = "SELECT * FROM usuario WHERE idUsuario = :id";
    $stmt = $baseDatos->prepare($sql);
    $stmt->execute([':id' => $id]);
    $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuarioData) {
        // Crear un objeto Usuario y cargarle los datos
        $objUsuario = new Usuario();
        $objUsuario->setIdUsuario($usuarioData['idUsuario']);
        $objUsuario->setDni($usuarioData['dni']);
        $objUsuario->setEmail($usuarioData['email']);
        $objUsuario->setNombre($usuarioData['nombre']);
        $objUsuario->setApellido($usuarioData['apellido']);
        $objUsuario->setContrasenia($usuarioData['contrasenia']);
        $objUsuario->setRol($usuarioData['rol']);

        return $objUsuario;
    }

    return false; 
}

 public function buscarPorRol($rol) {
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuario WHERE rol = '$rol'";
        $cant = $base->Ejecutar($sql);

        $arreglo = [];
        if ($cant > 0) {
            while ($fila = $base->Registro()) {
                $obj = new Alumno();
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