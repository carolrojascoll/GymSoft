<?php

include("../conexion.php");

if (isset($_POST['id_entrenador'])) {

    $datos = array();
    $stmt = $conexion->prepare("SELECT * FROM entrenadores WHERE id_entrenador = '" . $_POST["id_entrenador"] . "' LIMIT 1;");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $datos["ruc_ci"] = $fila["ruc_ci"];
        $datos["nombre"] = $fila["nombre"];
        $datos["apellido"] = $fila["apellido"];
        $datos["id_ciudad"] = $fila["id_ciudad"];
        $datos["direccion"] = $fila["direccion"];
        $datos["telefono"] = $fila["telefono"];
        $datos["sexo"] = $fila["sexo"];
        $datos["fecha_nac"] = $fila["fecha_nac"];
        $datos["sueldo_bruto"] = $fila["sueldo_bruto"];
        $datos["horas_trabajo"] = $fila["horas_trabajo"];
    }
    echo json_encode($datos);
}
