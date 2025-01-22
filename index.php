<?php
require_once 'utils/config.php';
require_once 'utils/conexion.php';
require_once 'templates/header.php';

$error = false;

try {
    $consultaSQL = "SELECT * FROM persona";
    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute();
    $personas = $sentencia->fetchAll();
} catch (PDOException $e) {
    $error = $e->getMessage();
}

?>

<?php
if ($error) {
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="alert alert-danger"><?= $error ?></div>
            </div>
        </div>
    </div>
    <?php
}
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Listado de personas</h2>
            <hr>
            <div class="col col-md-3">
                <a href="pages/crear_persona.php" class="btn btn-success">Crear persona</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>SEXO</th>
                        <th>EDAD</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($personas && $sentencia->rowCount() > 0) {
                        foreach ($personas as $persona) {
                            ?>
                            <tr>
                                <td><?= $persona['id'] ?></td>
                                <td><?= $persona['nombre'] ?></td>
                                <td><?= $persona['apellido'] ?></td>
                                <td><?= $persona['sexo'] ?></td>
                                <td><?= $persona['edad'] ?></td>
                                <td>
                                    <a class="btn btn-danger" href="pages/eliminar_persona.php?id=<?= $persona['id'] ?>"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                        </svg></a>
                                    <a class="btn btn-primary" href="pages/editar_persona.php?id=<?= $persona['id'] ?>"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg></a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




<?php require_once 'templates/footer.php'; ?>