<?php

include("../conexion.php");
include("../funciones.php");

$query = "";
$salida = array();
$query =
    "SELECT e.id_entrenador, e.ruc_ci, CONCAT(e.nombre,' ',e.apellido) as nombre,
c.`ciudad`, e.`direccion`, e.`telefono`, e.`sexo`, 
TIMESTAMPDIFF(YEAR, e.fecha_nac, CURDATE()) as fecha_nac,
FORMAT(e.sueldo_bruto, 0, 'de_DE') AS sueldo_bruto, e.horas_trabajo
FROM entrenadores e INNER JOIN ciudades c ON e.id_ciudad = c.id_ciudad ";

if (isset($_POST["search"]["value"])) {
    $query .= 'WHERE e.ruc_ci LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR e.nombre LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR e.apellido LIKE "%' . $_POST["search"]["value"] . '%" ';
}

if (isset($_POST["order"])) {
    $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST["order"][0]['dir'] . ' ';
} else {
    $query .= ' ORDER BY e.id_entrenador';
}

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();
$datos = array();
$filtered_rows = $stmt->rowCount();
foreach ($resultado as $fila) {
    $sub_array = array();
    $sub_array[] = $fila["id_entrenador"];
    $sub_array[] = $fila["ruc_ci"];
    $sub_array[] = $fila["nombre"];
    $sub_array[] = $fila["ciudad"];
    $sub_array[] = $fila["direccion"];
    $sub_array[] = $fila["telefono"];
    $sub_array[] = $fila["sexo"];
    $sub_array[] = $fila["fecha_nac"];
    $sub_array[] = $fila["sueldo_bruto"];
    $sub_array[] = $fila["horas_trabajo"];
    $sub_array[] = '<button type="button" name="editar" id="' . $fila["id_entrenador"] . '" 
        class="btn btn-primary btn-xs editar"><i class="bi bi-pencil-square"></i></button>';
    $sub_array[] = '<button type="button" name="borrar" id="' . $fila["id_entrenador"] . '" 
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
