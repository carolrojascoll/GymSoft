<?php

include("../conexion.php");

$stmt = $conexion->prepare(
"SELECT FORMAT(dc.cantidad, 0, 'de_DE') as cant, CONCAT(a.descripcion, ' ', m.marca) as descripcion,
FORMAT(dc.precio, 0, 'de_DE') as precio, FORMAT(dc.subtotal_iva0, 0, 'de_DE') as iva0,
FORMAT(dc.subtotal_iva5, 0, 'de_DE') as iva5, FORMAT(dc.subtotal_iva10, 0, 'de_DE') as iva10
FROM detalle_compra dc JOIN articulos a on dc.id_articulo = a.id_articulo
JOIN marcas m ON dc.id_marca = m.id_marca 
WHERE dc.id_compra = :id_compra"
);

$stmt->execute(array(':id_compra' => $_POST["id_compra"]));
$resultado = $stmt->fetchAll();
$filtered_rows = $stmt->rowCount();
foreach ($resultado as $fila) {
    $sub_array = array();
    $sub_array[] = $fila["cant"];
    $sub_array[] = $fila["descripcion"];
    $sub_array[] = $fila["precio"];
    $sub_array[] = $fila["iva0"];
    $sub_array[] = $fila["iva5"];
    $sub_array[] = $fila["iva10"];
    $datos[] = $sub_array;
}

$salida = array(
    "draw"              => intval($_POST["draw"]),
    "recordsTotal"      => $filtered_rows,
    "recordsFiltered"   => $stmt->rowCount(),
    "data"              => $datos,
);

echo json_encode($salida);
