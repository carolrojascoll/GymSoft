<?php

include("../conexion.php");
include("../funciones.php");

$query = "";
$salida = array();
$query =
"SELECT p.ruc, p.razon_social, p.direccion, c.ciudad, p.telefono 
FROM clientes p INNER JOIN ciudades c ON p.id_ciudad = c.id_ciudad ";

if (isset($_POST["search"]["value"])) {
    $query .= ' WHERE p.ruc LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= ' OR p.razon_social LIKE "%' . $_POST["search"]["value"] . '%" ';
}

if (isset($_POST["order"])) {
    $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST["order"][0]['dir'] . ' ';
} else {
    $query .= ' ORDER BY p.id_cliente';
}

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();
$datos = array();
$filtered_rows = $stmt->rowCount();
foreach ($resultado as $fila) {
    $sub_array = array();
    $sub_array[] = $fila["ruc"];
    $sub_array[] = $fila["razon_social"];
    $sub_array[] = $fila["ciudad"];
    $sub_array[] = $fila["direccion"];
    $sub_array[] = $fila["telefono"];
    $sub_array[] = '<button type="button" name="enviarCliente" id="' . $fila["ruc"] . '" 
        class="btn btn-success btn-xs enviarCliente"><i class="bi bi-check-square"></i></button>';

    $datos[] = $sub_array;
}

$salida = array(
    "draw"              => intval($_POST["draw"]),
    "recordsTotal"      => $filtered_rows,
    "recordsFiltered"   => $stmt->rowCount(),
    "data"              => $datos
);

echo json_encode($salida);
