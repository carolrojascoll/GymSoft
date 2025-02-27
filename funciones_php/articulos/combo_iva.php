<?php

    include('../conexion.php');

    $stmt = $conexion->prepare("SELECT id_iva, CONCAT(tipo_iva, ' %') as tipo_iva FROM iva");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    $datos = array();
    foreach ($resultado as $fila) { 
        $datos[] = array(
            'id_iva'     => $fila['id_iva'],
            'tipo_iva'        => $fila['tipo_iva']
        );
    }

    echo json_encode($datos);