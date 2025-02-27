<?php

include("../conexion.php");

$query = "";
$salida = array();
$query = "SELECT cv.id_venta, c.razon_social,
CONCAT('001-001-000000', cv.num_factura) as num_factura, 
FORMAT(cv.total_venta, 0, 'de_DE') as total, DATE_FORMAT(cv.fecha, '%d/%m/%Y') as fecha,
cv.condicion, cv.pagado, CONCAT(e.nombre, ' ', e.apellido) as cajero 
FROM cabecera_venta cv JOIN clientes c ON cv.id_cliente = c.id_cliente 
JOIN entrenadores e ON cv.id_entrenador = e.id_entrenador 
WHERE cv.fecha BETWEEN :desde AND :hasta ";

if (isset($_POST["search"]["value"])) {
    $query .= ' AND c.razon_social LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= ' AND cv.num_factura LIKE "%' . $_POST["search"]["value"] . '%" ';
}

if (isset($_POST["order"])) {
    $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST["order"][0]['dir'] . ' ';
} else {
    $query .= ' ORDER BY cv.id_venta';
}

$stmt = $conexion->prepare($query);
$stmt->execute(
    array(
        ':desde'    => $_POST["desde"],
        ':hasta'    => $_POST["hasta"]
    )
);
$resultado = $stmt->fetchAll();
$datos = array();
$filtered_rows = $stmt->rowCount();
foreach ($resultado as $fila) {
    $sub_array = array();
    $sub_array[] = $fila["id_venta"];
    $sub_array[] = $fila["num_factura"];
    $sub_array[] = $fila["razon_social"];
    $sub_array[] = $fila["total"];
    $sub_array[] = $fila["fecha"];
    $sub_array[] = $fila["condicion"];
    $sub_array[] = $fila["pagado"];

    $detalleButton = '<button type="button" name="' . $fila["cajero"] . '" id="' . $fila["id_venta"] . '" 
    class="btn btn-warning bg-gradient detalle"><i class="bi bi-list-columns-reverse"></i></button>';

    $pagarButton = '<button type="button" name="pagar" id="' . $fila["id_venta"] . '" 
    class="btn btn-success pagar"';

    if ($fila["pagado"] == "Si") {
        $pagarButton .= ' disabled';
    }

    $pagarButton .= '><i class="bi bi-currency-dollar"></i></button>';
    $sub_array[] = $detalleButton;
    $sub_array[] = $pagarButton;
    $datos[] = $sub_array;
}

$salida = array(
    "draw"              => intval($_POST["draw"]),
    "recordsTotal"      => $filtered_rows,
    "recordsFiltered"   => $filtered_rows,
    "data"              => $datos
);

echo json_encode($salida);
