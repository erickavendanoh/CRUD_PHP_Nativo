<?php

    require_once 'config.php';

    try{
        $conexion = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        //echo "The connection to database $dbname was succesfully";
    }catch(PDOException $e){
        die("Could not connect to database" . $e->getMessage());
    }

?>