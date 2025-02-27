<?php

include("../conexion.php");
include("../funciones.php");

$query = "";
$salida = array();
$query =
"SELECT a.codigo, a.descripcion, m.marca, 
CONCAT(i.tipo_iva, ' %') as iva,
FORMAT(a.precio_compra, 0, 'de_DE') as precio_compra 
FROM articulos a INNER JOIN marcas m ON a.id_marca = m.id_marca
INNER JOIN iva i ON a.id_iva = i.id_iva";

if (isset($_POST["search"]["value"])) {
    $query .= ' WHERE a.codigo LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR a.descripcion LIKE "%' . $_POST["search"]["value"] . '%" ';
}

if (isset($_POST["order"])) {
    $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST["order"][0]['dir'] . ' ';
} else {
    $query .= ' ORDER BY id_articulo';
}

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();
$datos = array();
$filtered_rows = $stmt->rowCount();
foreach ($resultado as $fila) {
    $sub_array = array();
    $sub_array[] = $fila["codigo"];
    $sub_array[] = $fila["descripcion"];
    $sub_array[] = $fila["marca"];
    $sub_array[] = $fila["iva"];
    $sub_array[] = $fila["precio_compra"];
    $sub_array[] = '<button type="button" name="enviarArt" id="' . $fila["codigo"] . '" 
        class="btn btn-success btn-xs enviarArt"><i class="bi bi-check-square"></i></button>';
    $datos[] = $sub_array;
}

$salida = array(
    "draw"              => intval($_POST["draw"]),
    "recordsTotal"      => $filtered_rows,
    "recordsFiltered"   => obtener_articulos(),
    "data"              => $datos
);

echo json_encode($salida);
