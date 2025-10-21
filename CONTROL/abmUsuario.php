<?php

class abmUsuario{

    public function usuarioExiste($datos){
        $objUsuarios = new Usuario();
        $respuesta =  $objUsuarios->buscarUsuario($datos);
        return $respuesta;
    }
    
    public function insertarUser($datos){
        $objUsuario = new Usuario();
        $objUsuario->agregarUsuario($datos);
     }
}