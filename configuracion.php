<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');

// Ruta absoluta al directorio del proyecto (donde está este archivo)
$GLOBALS['ROOT'] = __DIR__ . '/';

// Definición de la URL base 
define('BASE_URL', '/TP-CLASESUTILES/VISTA/');

// Ruta principal
//$PRINCIPAL = "Location:http://" . $_SERVER['HTTP_HOST'] . "/TP-CLASESUTILES/VISTA/login.php";

// Guardamos el root también en sesión si querés mantener compatibilidad
$_SESSION['ROOT'] = $GLOBALS['ROOT'];

// Incluí las funciones (autoload)
include_once($GLOBALS['ROOT'] . 'UTILS/funciones.php');

?>
