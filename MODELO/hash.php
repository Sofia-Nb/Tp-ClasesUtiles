<?php


class Hasher
{
    private $options;

    public function __construct()
    {
        $this->options = [
            'memory_cost' => 65536, // 64 MB
            'time_cost'   => 4,     // 4 iteraciones
            'threads'     => 2      // 2 hilos
        ];
    }

    // Generar el hash
    public function hash($password)
    {
        return password_hash($password, PASSWORD_ARGON2ID, $this->options);
    }

    // Verificar la contraseña
    public function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }

    // Rehashear si cambian los parámetros o el algoritmo
    public function needsRehash($hash)
    {
        return password_needs_rehash($hash, PASSWORD_ARGON2ID, $this->options);
    }
}

