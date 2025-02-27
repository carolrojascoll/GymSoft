<?php

include("../conexion.php");
include("../funciones.php");

$query = "";
$salida = array();
$query =
"SELECT c.`id_cliente`, c.`ruc`, c.`razon_social`, cs.`ciudad`, c.`direccion`, c.`telefono`, c.`sexo`, 
        TIMESTAMPDIFF(YEAR, c.f_nacimiento, CURDATE()) as f_nacimiento
        FROM clientes c INNER JOIN ciudades cs ON c.id_ciudad = cs.id_ciudad";

if (isset($_POST["search"]["value"])) {
    $query .= ' WHERE c.ruc LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR c.razon_social LIKE "%' . $_POST["search"]["value"] . '%" ';
}

if (isset($_POST["order"])) {
    $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST["order"][0]['dir'] . ' ';
} else {
    $query .= ' ORDER BY c.id_cliente';
}

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();
$datos = array();
$filtered_rows = $stmt->rowCount();
foreach ($resultado as $fila) {
    $sub_array = array();
    $sub_array[] = $fila["id_cliente"];
    $sub_array[] = $fila["ruc"];
    $sub_array[] = $fila["razon_social"];
    $sub_array[] = $fila["ciudad"];
    $sub_array[] = $fila["direccion"];
    $sub_array[] = $fila["telefono"];
    $sub_array[] = $fila["sexo"];
    $sub_array[] = $fila["f_nacimiento"];
    $sub_array[] = '<button type="button" name="editar" id="' . $fila["id_cliente"] . '" 
        class="btn btn-primary btn-xs editar"><i class="bi bi-pencil-square"></i></button>';
    $sub_array[] = '<button type="button" name="borrar" id="' . $fila["id_cliente"] . '" 
        class="btn btn-danger btn-xs borrar"><i class="bi bi-trash3"></i></button>';
    $datos[] = $sub_array;
}

$salida = array(
    "draw"              => intval($_POST["draw"]),
    "recordsTotal"      => $filtered_rows,
    "recordsFiltered"   => obtener_clientes(),
    "data"              => $datos
);

echo json_encode($salida);
