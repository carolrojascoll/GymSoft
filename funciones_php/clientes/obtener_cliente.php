<?php

include("../conexion.php");

if (isset($_POST['id_cliente'])) {

    $datos = array();
    $stmt = $conexion->prepare("SELECT * FROM clientes WHERE id_cliente = :id_cliente");
    $stmt->execute(array(
        ':id_Cliente' => $_POST["id_cliente"]
    ));
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $datos["ruc"] = $fila["ruc"];
        $datos["razon_social"] = $fila["razon_social"];
        $datos["id_ciudad"] = $fila["id_ciudad"];
        $datos["direccion"] = $fila["direccion"];
        $datos["telefono"] = $fila["telefono"];
        $datos["sexo"] = $fila["sexo"];
        $datos["f_nacimiento"] = $fila["f_nacimiento"];
    }
    echo json_encode($datos);
}
