<?php

include("../conexion.php");

$stmt = $conexion->prepare("SELECT MAX(id_rutina)+ 1 FROM rutina_cabecera");
$stmt->execute();
$resultado = $stmt->fetchAll();
foreach ($resultado as $fila) {
    if($fila[0] == null){
        $id_rutina = 1;
    } else {
        $id_rutina = $fila[0];
    }
}

$valor = array("result" => $id_rutina);

echo json_encode($valor);
