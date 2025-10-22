<?php
include_once '../structure/header.php';
$datos = datasubmitted();
$objAbmNotas = new abmNota();
$resultado = $objAbmNotas->agregarNota($datos);

if ($resultado) { // si la nota existe
    $objAbmNotas->encriptarNota($datos); // se encripta la nota
    ?>
    <div class='container text-center mt-5'>
            <div class='alert alert-success'>
                <h4>Nota cargada correctamente</h4>
                <p>Nota: <?php echo $datos['valorNota'] ?> </p>
                <a href='javascript:history.back()' class='btn btn-outline-primary mt-3'>Volver</a>
            </div>
        </div>
    <?php
} else {
    ?>
    <div class='container text-center mt-5'>
        <div class='alert alert-warning'>
            <h4>Alumno o profesor no encontrado</h4>
            <p>Verifique los DNIs ingresados</p>
            <a href='javascript:history.back()' class='btn btn-outline-primary mt-3'>Volver</a>
        </div>
    </div>
    <?php
}


include_once '../structure/footer.php';