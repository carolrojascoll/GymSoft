<?php

include("../conexion.php");

$stmt = $conexion->prepare(
    "INSERT INTO rutina_detalle (id_rutina, orden, id_ejercicio, cant_serie, cant_repeticiones) 
VALUES(:id_rutina, :orden, :id_ejercicio, :cant_serie, :cant_repeticiones)"
);
$stmt->execute(
    array(
        ':id_rutina'            => $_POST["id_rutina"],
        ':orden'                => $_POST["orden"],
        ':id_ejercicio'         => $_POST["id_ejercicio"],
        ':cant_serie'           => $_POST["cant_serie"],
        ':cant_repeticiones'    => $_POST["cant_repeticiones"]
    )
);
