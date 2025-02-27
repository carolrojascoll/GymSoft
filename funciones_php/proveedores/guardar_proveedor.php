<?php

include("../conexion.php");

if ($_POST["operacion"] == "Nuevo") {
    $stmt = $conexion->prepare("SELECT id_proveedor, ruc FROM proveedores WHERE ruc = :ruc");
    $stmt->execute(array(':ruc' => $_POST["ruc"]));
    $resultado = $stmt->fetchAll();

    if (count($resultado) > 0) {
        $info = array(
            "mensaje"   => "EL RUC O C.I INGRESADO PERTENECE A UN PROVEEDOR.!!!",
            "icono"     => "warning",
            "exito"     => false
        );
    } else {
        $stmt = $conexion->prepare(
            "INSERT INTO proveedores (ruc, razon_social, id_ciudad, direccion, telefono)
                VALUES (:ruc, :razon_social, :id_ciudad, :direccion, :telefono)"
        );

        $resultado = $stmt->execute(
            array(
                ':ruc'              => $_POST["ruc"],
                ':razon_social'     => $_POST["razon"],
                ':id_ciudad'        => $_POST["ciudad"],
                ':direccion'        => $_POST["direccion"],
                ':telefono'         => $_POST["telefono"],
            )
        );

        $info = array(
            "mensaje"   => "REGISTRO INSERTADO",
            "icono"     => "success",
            "exito"     => true
        );
    }
} else {
    $stmt = $conexion->prepare("SELECT id_proveedor, ruc FROM proveedores WHERE id_proveedor = :id_proveedor");
    $stmt->execute(array(':id_proveedor' => $_POST["id_proveedor"]));
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $codigo = $fila["id_proveedor"];
        $ruc = $fila["ruc"];
    }

    if ($ruc == $_POST["ruc"]) {
        $stmt = $conexion->prepare("UPDATE proveedores SET ruc = :ruc, razon_social = :razon_social, id_ciudad = :id_ciudad,
            direccion = :direccion, telefono = :telefono WHERE id_proveedor = :id_proveedor");

        $resultado = $stmt->execute(
            array(
                ':ruc'               => $_POST["ruc"],
                ':razon_social'      => $_POST["razon"],
                ':id_ciudad'         => $_POST["ciudad"],
                ':direccion'         => $_POST["direccion"],
                ':telefono'          => $_POST["telefono"],
                ':id_proveedor'        => $_POST["id_proveedor"]
            )
        );
        $info = array(
            "mensaje"   => "REGISTRO MODIFICADO",
            "icono"     => "success",
            "exito"     => true
        );
    } else {
        $stmt = $conexion->prepare("SELECT id_proveedor, ruc FROM proveedores WHERE ruc = :ruc");
        $stmt->execute(array(':ruc' => $_POST["ruc"]));
        $resultado = $stmt->fetchAll();
        if (count($resultado) > 0) {
            $info = array(
                "mensaje"   => "EL RUC O C.I INGRESADO PERTENECE A UN PROVEEDOR.!!!",
                "icono"     => "warning",
                "exito"     => false
            );
        } else {
            $stmt = $conexion->prepare("UPDATE proveedores SET ruc = :ruc, razon_social = :razon_social, id_ciudad = :id_ciudad,
            direccion = :direccion, telefono = :telefono WHERE id_proveedor = :id_proveedor");

            $resultado = $stmt->execute(
                array(
                    ':ruc'               => $_POST["ruc"],
                    ':razon_social'      => $_POST["razon"],
                    ':id_ciudad'         => $_POST["ciudad"],
                    ':direccion'         => $_POST["direccion"],
                    ':telefono'          => $_POST["telefono"],
                    ':id_proveedor'        => $_POST["id_proveedor"]
                )
            );
            $info = array(
                "mensaje"   => "REGISTRO MODIFICADO",
                "icono"     => "success",
                "exito"     => true
            );
        }
    }
}


echo json_encode($info);
