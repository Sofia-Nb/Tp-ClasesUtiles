<?php
include_once '../structure/header.php';
require_once '../../vendor/mitoteam/jpgraph/src/MtJpGraph.php';
require_once '../../vendor/mitoteam/jpgraph/src/lib/jpgraph.php';
require_once '../../vendor/mitoteam/jpgraph/src/lib/jpgraph_bar.php';

$usuarioId = $usuario['idUsuario'];
$notaObj = new abmNota();
$notasArray = $notaObj->promedio($usuarioId); 

$promediosMeses = [];
for ($m = 1; $m <= 12; $m++) {
    $promediosMeses[$m] = isset($notasArray[$m]) ? $notasArray[$m] : 0;
}

$dataY = array_values($promediosMeses);

$graph = new Graph(1200,600,'auto');
$graph->SetScale("textlin",0,10);
$graph->yaxis->SetTickPositions([0,2,4,6,8,10]);
$graph->SetBox(false);
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre']);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$bplot = new BarPlot($dataY);
$bplot->SetColor("white");
$bplot->SetFillColor("#11cccc");

$graph->Add($bplot);
$graph->title->Set("Promedio de Notas por Mes");

$dir = __DIR__ . '/../assets/img/graficos/';
if (!is_dir($dir)) { mkdir($dir, 0755, true); }
$timestamp = date('Ymd_His');
$archivo = $dir . "mis_notas_$timestamp.png";
$graph->Stroke($archivo);
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Mi Información</h2>

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
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Promedio de Notas por Mes</h5>
            <img src="../assets/img/graficos/mis_notas_<?= $timestamp; ?>.png?rand=<?= rand(); ?>" alt="Gráfico de Notas" class="img-fluid">
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
