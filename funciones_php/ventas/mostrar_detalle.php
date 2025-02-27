<?php

include("../conexion.php");

$stmt = $conexion->prepare(
"SELECT FORMAT(dv.cantidad, 0, 'de_DE') as cant, CONCAT(a.descripcion, ' ', m.marca) as descripcion,
FORMAT(dv.precio, 0, 'de_DE') as precio, FORMAT(dv.subtotal_iva0, 0, 'de_DE') as iva0,
FORMAT(dv.subtotal_iva5, 0, 'de_DE') as iva5, FORMAT(dv.subtotal_iva10, 0, 'de_DE') as iva10
FROM detalle_venta dv JOIN articulos a on dv.id_articulo = a.id_articulo
JOIN marcas m ON dv.id_marca = m.id_marca 
WHERE dv.id_venta = :id_venta"
);

$stmt->execute(array(':id_venta' => $_POST["id_venta"]));
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
