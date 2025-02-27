<?php

include("../conexion.php");

$salida = array();

$stmt = $conexion->prepare(
    "SELECT CONCAT(e.nombre,' ',e.apellido) AS entrenador
    FROM usuarios u INNER JOIN entrenadores e ON u.id_entrenador = e.id_entrenador 
    WHERE ruc_ci = '" . $_POST["ruc"] . "' LIMIT 1"
);

$stmt->execute();
$resultado = $stmt->fetchAll();

if (count($resultado) > 0) {
    foreach ($resultado as $fila) {
        $salida["mensaje"] = $fila["entrenador"] . " YA CUENTA CON UN USUARIO Y CONTRASEÑA.!!!";
        $salida["tiene"]   = true;
    }
} else {

    $stmt = $conexion->prepare(
        "SELECT id_entrenador, CONCAT(nombre, ' ',apellido) as entrenador
            FROM entrenadores 
            WHERE ruc_ci = '" . $_POST["ruc"] . "' LIMIT 1"
    );
    $stmt->execute();
    $datos = $stmt->fetchAll();
    foreach ($datos as $fila) {
        $salida["tiene"]            = false;
        $salida["id_entrenador"]    = $fila["id_entrenador"];
        $salida["entrenador"]       = $fila["entrenador"];
    }
}


echo json_encode($salida);
