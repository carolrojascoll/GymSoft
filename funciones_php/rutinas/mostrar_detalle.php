<?php

include("../conexion.php");

$stmt = $conexion->prepare("SELECT rd.orden ,e.ejercicio, rd.cant_serie, rd.cant_repeticiones
FROM rutina_detalle rd INNER JOIN ejercicios e ON rd.id_ejercicio = e.id_ejercicio
WHERE rd.id_rutina = :id_rutina ORDER BY 1");
$stmt->execute(array(':id_rutina' => $_POST["id_rutina"]));
$resultado = $stmt->fetchAll();
$datos = array();
$filtered_rows = $stmt->rowCount();
foreach ($resultado as $fila) {
    $sub_array = array();
    $sub_array[] = $fila["orden"];
    $sub_array[] = $fila["ejercicio"];
    $sub_array[] = $fila["cant_serie"];
    $sub_array[] = $fila["cant_repeticiones"];
    $datos[] = $sub_array;
}

$salida = array(
    "draw"              => intval($_POST["draw"]),
    "recordsTotal"      => $filtered_rows,
    "recordsFiltered"   => $stmt->rowCount(),
    "data"              => $datos
);

echo json_encode($salida);
