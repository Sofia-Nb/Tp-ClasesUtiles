<?php
require 'vendor/autoload.php'; //invoco el autoload de composer para cargar las librerias

use phpseclib3\Crypt\AES;

class Encriptador {
    private $cifrado;

    public function __construct($key) {
        // incializo el el cifrado/algortimo en modo CBC (modo de operación por bloques)
        $this->cifrado = new AES('cbc');
        $this->cifrado->setKey($key);
    }

    /**
    *Funcion que encripta un mensaje, primero lo cifra con AES en modo CBC y despues lo codifica en base64 para poder enviarlo como texto seguro
    *@param string $textoPlano
    *@return string
    */
    public function encriptar($textoPlano) {
        //saco 16 bytes randoms
        $iv = random_bytes(16);
        //los aisgno al IV(vector de inicializacion) para asegurar que cada cifrado es unico
        $this->cifrado->setIV($iv);
        $codificado = $this->cifrado->encrypt($textoPlano);
        return base64_encode($iv . $codificado);
    }

    /**
    *Funcion que desencripta un mensaje, se decodifica desde base64 para obtener la encriptacion y despues se desencripta con AES en modo CBC
    *@param string $textoCifrado
    *@return string
    */
    public function desencriptar($textoCifrado) {
        $datos = base64_decode($textoCifrado);

        $iv = substr($datos, 0, 16); //obtengo el IV que son los primeros 16 bytes(0 al 15)
        $cifrado = substr ($datos, 16); //obtengo el resto del mensaje a partir del byte 16

        $this->cifrado->setIV($iv); //seteo el IV para poder descifrar
        return $this->cifrado->decrypt($cifrado);
    }
}
