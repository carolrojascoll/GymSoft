<?php

    $host = "127.0.0.1";
    $db = "gym_soft";
    $usuario = "root";
    $password = "";

    try {
        $conexion = new PDO("mysql:host=$host;dbname=$db", $usuario, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        /* Indicar que queremos que lance excepciones cuando ocurra un error */
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // tratamiento del error
        echo "Error de conexión: " . $e->GetMessage();
    }
