<?php

include("../conexion.php");

if (isset($_POST['id_ejercicio'])) {
    $datos = array();
    $stmt = $conexion->prepare("SELECT * FROM ejercicios WHERE id_ejercicio = '" . $_POST["id_ejercicio"] . "' LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $datos["ejercicio"] = $fila["ejercicio"];
    }

    echo json_encode($datos);
}
