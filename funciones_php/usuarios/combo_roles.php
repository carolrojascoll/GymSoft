<?php

    include('../conexion.php');

    $stmt = $conexion->prepare("SELECT id_rol, rol FROM roles");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    $datos = array();
    foreach ($resultado as $fila) { 
        $datos[] = array(
            'id_rol'     => $fila['id_rol'],
            'rol'        => $fila['rol']
        );
    }

    echo json_encode($datos);