<?php

include("../conexion.php");
include("../funciones.php");

$query = "";
$salida = array();
$query =
    "SELECT c.razon_social,
DATE_FORMAT(a.`entrada`,'%H:%i') AS entrada,
DATE_FORMAT(a.`salida`,'%H:%i') AS salida,
TIME_FORMAT(TIMEDIFF(a.salida, a.entrada), '%H:%i') AS tiempo,
DATE_FORMAT(a.`fecha`, '%d/%m/%Y') AS fecha 
FROM asistencia a INNER JOIN clientes c ON a.id_cliente = c.id_cliente
WHERE a.fecha BETWEEN '" . $_POST["desde"] . "'
AND '" . $_POST["hasta"] . "'";

if (isset($_POST["search"]["value"])) {
    $query .= ' AND c.razon_social LIKE "%' . $_POST["search"]["value"] . '%" ';
}

if (isset($_POST["order"])) {
    $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST["order"][0]['dir'] . ' ';
} else {
    $query .= ' ORDER BY a.fecha';
}

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();
$datos = array();
$filtered_rows = $stmt->rowCount();
foreach ($resultado as $fila) {
    $sub_array = array();
    $sub_array[] = $fila["razon_social"];
    $sub_array[] = $fila["entrada"];
    $sub_array[] = $fila["salida"];
    $sub_array[] = $fila["tiempo"];
    $sub_array[] = $fila["fecha"];
    $datos[] = $sub_array;
}

$salida = array(
    "draw"              => intval($_POST["draw"]),
    "recordsTotal"      => $filtered_rows,
    "recordsFiltered"   => $filtered_rows,
    "data"              => $datos
);

echo json_encode($salida);
