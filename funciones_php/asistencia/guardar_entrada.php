<?php

include("../conexion.php");

    $stmt = $conexion->prepare(
        "INSERT INTO asistencia (id_cliente, entrada, salida, fecha) 
            VALUES(:id_cliente, NOW(), null, CURDATE());"
    );
    $stmt->execute(
        array(
            ':id_cliente'       => $_POST["id_cliente"]
        )
    );
    $info = array(
        "mensaje"       => "ENTRADA REGISTRADA",
        "icono"         => "success"
    );

    echo json_encode($info);