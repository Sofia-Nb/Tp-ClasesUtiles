<?php

class abmNota {

    public function encriptarNota($datos){
        $objNota = new Nota();
        $res = $objNota->encriptarUnaNota($datos);
        return $res;
    }

}
    