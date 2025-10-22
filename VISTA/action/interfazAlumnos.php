<?php
include_once '../structure/header.php';
require_once '../../vendor/mitoteam/jpgraph/src/MtJpGraph.php';
require_once '../../vendor/mitoteam/jpgraph/src/lib/jpgraph.php';
require_once '../../vendor/mitoteam/jpgraph/src/lib/jpgraph_bar.php';

// Datos de ejemplo (CAMBIAR POR LAS DE LA BD)
$data1y = [6.5,7.2,8.1,5.9,9.0];
$data2y = [5.8,6.7,7.4,6.2,8.1];
$data3y = [7.0,8.0,8.5,7.8,9.3];

// Se crea el gráfico
$graph = new Graph(1200,600,'auto');
$graph->SetScale("textlin",0,10);
$graph->yaxis->SetTickPositions([0,2,4,6,8,10]);  // eje Y (Notas)
$graph->SetBox(false);
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels(['2021','2022','2023','2024','2025']); // eje X (Años)
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Crear barras
$b1plot = new BarPlot($data1y);
$b2plot = new BarPlot($data2y);
$b3plot = new BarPlot($data3y);

$b1plot->SetColor("white"); $b1plot->SetFillColor("#cc1111");
$b2plot->SetColor("white"); $b2plot->SetFillColor("#11cccc");
$b3plot->SetColor("white"); $b3plot->SetFillColor("#1111cc");

$gbplot = new GroupBarPlot([$b1plot,$b2plot,$b3plot]);
$graph->Add($gbplot);
$graph->title->Set("Mis Notas");

// Guardar gráfico
$dir = __DIR__ . '/../assets/img/graficos/';
if (!is_dir($dir)) { mkdir($dir, 0755, true); }
$timestamp = date('Ymd_His');
$archivo = $dir . "mis_notas_$timestamp.png";
$graph->Stroke($archivo);


?>

<div class="container my-5">
    <h2 class="text-center mb-4">Mi Información</h2>

    <!-- Información personal -->
    <div class="card shadow-sm border-0">
        <div class="card-header text-dark">
            <h5 class="mb-0"><i class="bi bi-person-circle"></i> Datos Personales</h5>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-4 text-end fw-bold">Nombre:</div>
                <div class="col-md-8"><?= $usuario['nombre'] . ' ' . $usuario['apellido'] ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-end fw-bold">Email:</div>
                <div class="col-md-8"><?= $usuario['email'] ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-end fw-bold">DNI:</div>
                <div class="col-md-8"><?= $usuario['dni'] ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-end fw-bold">Legajo:</div>
                <div class="col-md-8"><?= $objAbmAlumno->alumnoLegajo($usuario['idUsuario']) ?></div>
            </div>
        </div>
    </div>
    <br>
    <!-- Tabla de notas -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Mis Notas</h5>
            <!-- FALTA AGREGAR NOTAS ENCRIPTADAS -->
             
            <img src="../assets/img/graficos/mis_notas_<?php echo $timestamp; ?>.png" alt="Gráfico de Notas" class="img-fluid">

        </div>
    </div>

    <br>
    <div style="text-align: center;">
    <a href="javascript:history.back()" class="btn btn-outline-primary w-50">Volver</a>
    </div>
</div>

<?php
include_once '../structure/footer.php';
?>