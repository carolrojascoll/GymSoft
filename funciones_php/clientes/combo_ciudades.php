<?php

    include('../conexion.php');

    $stmt = $conexion->prepare("SELECT id_ciudad, ciudad FROM ciudades");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    $datos = array();
    foreach ($resultado as $fila) { 
        $datos[] = array(
            'id_ciudad'     => $fila['id_ciudad'],
            'ciudad'        => $fila['ciudad']
        );
    }

    echo json_encode($datos);