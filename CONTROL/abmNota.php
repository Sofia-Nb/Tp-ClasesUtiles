<?php

class abmNota {

    public function agregarNota($datos){
        $objNota = new Nota();
        $resultado = $objNota->insertarNota($datos);
        return $resultado;
    }
}
    