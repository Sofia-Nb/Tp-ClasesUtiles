<?php

class abmNota {

    public function agregarNota($datos){
        $objNota = new Nota();
        $resultado = $objNota->insertarNota($datos);
        return $resultado;
    }

    public function encriptarNota($datos){
        $objNota = new Nota();
        $res = $objNota->encriptarUnaNota($datos);
        return $res;
    }
}
    