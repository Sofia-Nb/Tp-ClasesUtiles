<?php
include_once ('../structure/header.php');
require ('../../vendor/autoload.php');
require_once ('../../vendor/mitoteam/jpgraph/src/lib/jpgraph.php');
require_once ('../../vendor/mitoteam/jpgraph/src/lib/jpgraph_bar.php');
require_once ('../../vendor/mitoteam/jpgraph/src/lib/jpgraph_line.php'); // si usas líneas
require_once ('../../vendor/mitoteam/jpgraph/src/lib/jpgraph_utils.inc.php'); // según necesidad


$datos = datasubmitted();
$objAbmProfesor = new abmProfesor();
$objAbmAlumno = new abmAlumno();
$rol = (int) $datos['nombreRol'];


/*if ($rol === 2){
    $permiso = true;
}else{
    $permiso = false;
}*/

// ----------------------------------------------------------------

// LIBRERIA PHPSECLIB3

// ----------------------------------------------------------------

use phpseclib3\Crypt\AES;

// Clave secreta
$clave = 'clave12345678910'; // AES-128
$iv    = 'ivclave123456789'; // IV de 16 bytes

if ($rol == 2) { // Profesor
    $alumnos = $objAbmAlumno->buscarPorRol(1);

    // Construir la tabla HTML
    $htmlTabla = '<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>';

    foreach ($alumnos as $alumno) {
        $htmlTabla .= '<tr>
            <td>' . htmlspecialchars($alumno->getNombre()) . '</td>
            <td>' . htmlspecialchars($alumno->getEmail()) . '</td>
            <td>
                <form style="display:inline;">
                    <input type="hidden" name="id_alumno" value="' . $alumno->getDni() . '">
                    <button type="submit" class="btn btn-warning">Encriptar</button>
                </form>
                <form style="display:inline;">
                    <input type="hidden" name="id_alumno" value="' . $alumno->getDni() . '">
                    <button type="submit" class="btn btn-success">Desencriptar</button>
                </form>
            </td>
        </tr>';
    }

    $htmlTabla .= '</tbody></table>'; // <-- cierre de tabla fuera del foreach

    // Crear objeto AES
    $aes = new AES('cbc');
    $aes->setKey($clave);
    $aes->setIV($iv);

    // Cifrar y descifrar
    $textoCifrado = base64_encode($aes->encrypt($htmlTabla));

    $aes2 = new AES('cbc');
    $aes2->setKey($clave);
    $aes2->setIV($iv);

    $htmlDescifrado = $aes2->decrypt(base64_decode($textoCifrado));

    echo $htmlDescifrado;
} else { // Alumno

    // Datos del gráfico
    $data1y = [6.5,7.2,8.1,5.9,9.0];
    $data2y = [5.8,6.7,7.4,6.2,8.1];
    $data3y = [7.0,8.0,8.5,7.8,9.3];


    // Crear el gráfico
    $graph = new Graph(1200,600,'auto');
    $graph->SetScale("textlin");

    $theme_class = new UniversalTheme;
    $graph->SetTheme($theme_class);

    // Escala de notas (de 0 a 10)
    $graph->yaxis->SetTickPositions([0,2,4,6,8,10]); 
    $graph->SetScale("textlin", 0, 10); // Escala lineal de 0 a 10

    $graph->SetBox(false);
    $graph->ygrid->SetFill(false);
    $graph->xaxis->SetTickLabels(['2021','2022','2023','2024', '2025']);
    $graph->yaxis->HideLine(false);
    $graph->yaxis->HideTicks(false,false);

    // Crear barras
    $b1plot = new BarPlot($data1y);
    $b2plot = new BarPlot($data2y);
    $b3plot = new BarPlot($data3y);

    $b1plot->SetColor("white");
    $b1plot->SetFillColor("#cc1111");

    $b2plot->SetColor("white");
    $b2plot->SetFillColor("#11cccc");

    $b3plot->SetColor("white");
    $b3plot->SetFillColor("#1111cc");

    $gbplot = new GroupBarPlot([$b1plot, $b2plot, $b3plot]);
    $graph->Add($gbplot);
    $graph->title->Set("Bar Plots");

    // ------------------------------
    // Guardar el gráfico como imagen
    // ------------------------------
    $dir = './../assets/img/graficos/';
    if (!is_dir($dir)) {
    if (!mkdir($dir, 0777, true)) {
        die("No se pudo crear la carpeta: $dir");
    }
}else{
    // Nombre base de la imagen
    $baseName = 'graficoAlumno';
    $extension = '.png';
    $rutaImagen = $dir . $baseName . $extension;

    // Verificar si el archivo ya existe y renombrar si es necesario
    $counter = 1;
    while (file_exists($rutaImagen)) {
    $rutaImagen = $dir . $baseName . '_' . $counter . $extension;
    $counter++;
   }
}

    // Guardar el gráfico como archivo PNG
    $graph->Stroke($rutaImagen);

    // Mostrar el gráfico en la página, sin ocupar toda la pantalla
    echo '<div style="text-align:center; margin-top:20px;">';
    echo '<h4>Gráfico de Alumno</h4>';
    echo '<img src="' . $rutaImagen . '" alt="Gráfico de Alumno" style="width: 70%; max-width: 900px; border-radius:10px;">';
    echo '</div>';
}