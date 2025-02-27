<?php

    include('../conexion.php');

    $stmt = $conexion->prepare("SELECT id_ejercicio, ejercicio FROM ejercicios");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    $datos = array();
    foreach ($resultado as $fila) { 
        $datos[] = array(
            'id_ejercicio'     => $fila['id_ejercicio'],
            'ejercicio'        => $fila['ejercicio']
        );
    }

    echo json_encode($datos);