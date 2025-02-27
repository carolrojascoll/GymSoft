<?php

    include('../conexion.php');

    $stmt = $conexion->prepare("SELECT id_marca, marca FROM marcas");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    $datos = array();
    foreach ($resultado as $fila) { 
        $datos[] = array(
            'id_marca'     => $fila['id_marca'],
            'marca'        => $fila['marca']
        );
    }

    echo json_encode($datos);