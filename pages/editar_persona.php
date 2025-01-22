<?php

require_once '../utils/config.php';
require_once '../utils/conexion.php';
require_once '../templates/header.php';

$resultado = [
    "error" => false,
    "mensaje" => ''
];

if (isset($_GET['id'])) {
    try {
        $id = $_GET['id'];

        $consultaSQL = "SELECT * FROM persona WHERE id=$id";
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();

        $persona = $sentencia->fetch(PDO::FETCH_ASSOC);

        if (!$persona) {
            $resultado["error"] = true;
            $resultado["mensaje"] = "No se encontró registro";
        }

    } catch (PDOException $e) {
        $resultado["error"] = true;
        $resultado["mensaje"] = $e->getMessage();
    }
} else {
    $resultado["error"] = true;
    $resultado["mensaje"] = "No se encontró registro";
}

if (isset($_POST['guardar'])) {
    try {
        $persona = array(
            "id" => $_GET['id'],
            "nombre" => $_POST['nombre'],
            "apellido" => $_POST['apellido'],
            "sexo" => $_POST['sexo'],
            "edad" => $_POST['edad']
        );

        $consultaSQL = "UPDATE persona SET
            nombre = :nombre,
            apellido = :apellido,
            sexo = :sexo,
            edad = :edad
            WHERE id = :id
        ";

        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute($persona);
    } catch (PDOException $e) {
        $resultado["error"] = true;
        $resultado["mensaje"] = $e->getMessage();
    }

}

?>

<?php
if ($resultado["error"]) {
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="alert alert-danger"><?= $resultado["mensaje"] ?></div>
            </div>
        </div>
    </div>
    <?php
}
?>

<?php
if (isset($_POST["guardar"]) && !$resultado["error"]) {
    ?>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="alert alert-success" role="alert">El registro se actualizo correctamente</div>
                </div>
            </div>
        </div>
    <?php
}
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Editando a la persona <?= $persona['nombre'] . ' ' . $persona['apellido'] ?></h2>
            <hr>
            <form class="form" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" placeholder="Ingrese un nombre" name="nombre"
                        value="<?= $persona['nombre'] ?>" />
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" class="form-control" placeholder="Ingrese un apellido" name="apellido"
                        value="<?= $persona['apellido'] ?>" />
                </div>
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <input type="text" class="form-control" maxlength="1" placeholder="Ingrese un sexo" name="sexo"
                        value="<?= $persona['sexo'] ?>" />
                </div>
                <div class="form-group">
                    <label for="edad">Edad:</label>
                    <input type="text" class="form-control" placeholder="Ingrese un edad" name="edad"
                        value="<?= $persona['edad'] ?>" />
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