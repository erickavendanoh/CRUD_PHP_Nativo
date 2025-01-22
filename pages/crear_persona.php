<?php

require_once '../utils/config.php';
require_once '../utils/conexion.php';
require_once '../templates/header.php';


if (isset($_POST['guardar'])) {
    $resultado = [
        "error" => false,
        "mensaje" => 'La persona con el nombre ' . $_POST['nombre'] . ' se agrego correctamente'
    ];

    try {
        $persona = array(
            "nombre" => $_POST['nombre'],
            "apellido" => $_POST['apellido'],
            "sexo" => $_POST['sexo'],
            "edad" => $_POST['edad']
        );

        $consultaSQL = "INSERT INTO persona(nombre, apellido, sexo, edad) VALUES(:" . implode(", :", array_keys($persona)) . ")";
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute($persona);
    } catch (PDOException $e) {
        $resultado["error"] = true;
        $resultado["mensaje"] = "Hubo un error: " . $e->getMessage();
    }
}

?>

<?php
if (isset($resultado)) {
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="alert alert-<?= $resultado["error"] ? "danger" : "success" ?>" role="alert"> <?= $resultado["mensaje"] ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Crear persona</h2>
            <hr>
            <form class="form" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" placeholder="Ingrese un nombre" name="nombre" />
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" class="form-control" placeholder="Ingrese un apellido" name="apellido" />
                </div>
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <input type="text" class="form-control" maxlength="1" placeholder="Ingrese un sexo" name="sexo" />
                </div>
                <div class="form-group">
                    <label for="edad">Edad:</label>
                    <input type="text" class="form-control" placeholder="Ingrese un edad" name="edad" />
                </div>
                <div class="form-group mt-4">
                    <a href="../index.php" class="btn btn-warning" class="form-control">Volver</a>
                    <input type="submit" class="btn btn-primary" value="Guardar" name="guardar" />
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once '../templates/footer.php'; ?>