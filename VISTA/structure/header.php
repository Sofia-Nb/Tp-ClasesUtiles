<?php
include_once(__DIR__ . '../../../configuracion.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/bootstrap-5.1.3-dist/css/bootstrap.css">
    <title>TP5 - Programación Web Dinámica</title>
</head>
<body>
    <header>
        <nav>
            <h1 align="center">TP5 - Programación Web Dinámica</h1>
            <ul>
             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
            <a class="text-decoration-none text-dark" href="<?= BASE_URL ?>login.php">Login</a>
            </ul>
            <hr>
        </nav>
       
    </header>
