<?php
class Usuario {
   
    protected $idUsuario;
    protected $dni;
    protected $email;
    protected $nombre;
    protected $apellido;
    protected $contrasenia; 
    protected $rol;

    public function __construct($idUsuario, $dni, $email, $nombre, $apellido, $contrasenia, $rol) {
        $this->idUsuario = $idUsuario;
        $this->dni = $dni;
        $this->email = $email;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->contrasenia = $contrasenia;
        $this->rol = $rol;
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
}
?>