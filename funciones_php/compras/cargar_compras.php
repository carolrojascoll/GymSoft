<?php

include("../conexion.php");

$query = "";
$salida = array();
$query = "SELECT c.id_compra, c.num_factura, p.razon_social, 
FORMAT(c.total_compra, 0, 'de_DE') as total, 
DATE_FORMAT(c.fecha, '%d/%m/%Y') as fecha, c.condicion, c.pagado, c.anulado 
FROM cabecera_compra c JOIN proveedores p on c.id_proveedor = p.id_proveedor 
WHERE c.fecha BETWEEN :desde AND :hasta ";

if (isset($_POST["search"]["value"])) {
    $query .= ' AND p.razon_social LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= ' AND c.num_factura LIKE "%' . $_POST["search"]["value"] . '%" ';
}

if (isset($_POST["order"])) {
    $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST["order"][0]['dir'] . ' ';
} else {
    $query .= ' ORDER BY c.id_compra';
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
    $sub_array[] = $fila["id_compra"];
    $sub_array[] = $fila["num_factura"];
    $sub_array[] = $fila["razon_social"];
    $sub_array[] = $fila["total"];
    $sub_array[] = $fila["fecha"];
    $sub_array[] = $fila["condicion"];
    $sub_array[] = $fila["pagado"];
    $sub_array[] = $fila["anulado"];

    $detalleButton = '<button type="button" name="detalle" id="' . $fila["id_compra"] . '" 
    class="btn btn-warning bg-gradient detalle"><i class="bi bi-list-columns-reverse"></i></button>';
    
    $anularButton = '<button type="button" name="anular" id="' . $fila["id_compra"] . '" 
    class="btn btn-danger anular"';
    
    $pagarButton = '<button type="button" name="pagar" id="' . $fila["id_compra"] . '" 
    class="btn btn-success pagar"';
    
    if ($fila["pagado"] == "Si" || $fila["anulado"] == "Si") {  
        $pagarButton .= ' disabled';
        $anularButton .= ' disabled';
    }

    $anularButton .= '><i class="bi bi-dash-circle"></i></button>';
    $pagarButton .= '><i class="bi bi-currency-dollar"></i></button>';
    $sub_array[] = $detalleButton;
    $sub_array[] = $anularButton;
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
