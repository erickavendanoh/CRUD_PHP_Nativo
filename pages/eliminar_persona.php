<?php
    require_once '../utils/config.php';
    require_once '../utils/conexion.php';
    require_once '../templates/header.php';

    $resultado = [
        "error" => false,
        "mensaje" => ''
    ];

    try{
        $id = $_GET['id'];

        $consultaSQL = "DELETE FROM persona WHERE id=$id";
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();

        header('Location: ../index.php');
    }catch(PDOException $e){
        $resultado["error"] = true;
        $resultado["mensaje"] = $e->getMessage();
    }

?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="alert alert-danger" role="alert"><?= $resultado["mensaje"] ?></div>
        </div>
    </div>
</div>