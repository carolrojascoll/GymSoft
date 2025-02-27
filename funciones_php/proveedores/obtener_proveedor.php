<?php

include("../conexion.php");

if (isset($_POST['id_proveedor'])) {

    $datos = array();
    $stmt = $conexion->prepare("SELECT * FROM proveedores WHERE id_proveedor = '" . $_POST["id_proveedor"] . "' LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $datos["ruc"] = $fila["ruc"];
        $datos["razon_social"] = $fila["razon_social"];
        $datos["id_ciudad"] = $fila["id_ciudad"];
        $datos["direccion"] = $fila["direccion"];
        $datos["telefono"] = $fila["telefono"];
    }
    echo json_encode($datos);
}
