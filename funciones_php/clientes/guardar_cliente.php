<?php

include("../conexion.php");

if ($_POST["operacion"] == "Nuevo") {
    $stmt = $conexion->prepare("SELECT id_cliente, ruc FROM clientes WHERE ruc = :ruc");
    $stmt->execute(array(':ruc' => $_POST["ruc"]));
    $resultado = $stmt->fetchAll();

    if (count($resultado) > 0) {
        $info = array(
            "mensaje"   => "EL RUC O C.I INGRESADO PERTENECE A UN CLIENTE.!!!",
            "icono"     => "warning",
            "exito"     => false
        );
    } else {
        $stmt = $conexion->prepare(
            "INSERT INTO clientes (ruc, razon_social, id_ciudad, direccion, telefono, sexo, f_nacimiento)
                VALUES (:ruc, :razon_social, :id_ciudad, :direccion, :telefono, :sexo, :f_nacimiento)"
        );

        $resultado = $stmt->execute(
            array(
                ':ruc'              => $_POST["ruc"],
                ':razon_social'     => $_POST["razon"],
                ':id_ciudad'        => $_POST["ciudad"],
                ':direccion'        => $_POST["direccion"],
                ':telefono'         => $_POST["telefono"],
                ':sexo'             => $_POST["sexo"],
                ':f_nacimiento'     => $_POST["f_nacimiento"]
            )
        );

        $info = array(
            "mensaje"   => "REGISTRO INSERTADO",
            "icono"     => "success",
            "exito"     => true
        );
    }
} else {
    $stmt = $conexion->prepare("SELECT id_cliente, ruc FROM clientes WHERE id_cliente = :id_cliente");
    $stmt->execute(array(':id_cliente' => $_POST["id_cliente"]));
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $codigo = $fila["id_cliente"];
        $ruc = $fila["ruc"];
    }

    if ($ruc == $_POST["ruc"]) {
        $stmt = $conexion->prepare("UPDATE clientes SET ruc = :ruc, razon_social = :razon_social, id_ciudad = :id_ciudad,
            direccion = :direccion, telefono = :telefono, sexo = :sexo, f_nacimiento = :f_nacimiento 
            WHERE id_cliente = :id_cliente");

        $resultado = $stmt->execute(
            array(
                ':ruc'               => $_POST["ruc"],
                ':razon_social'      => $_POST["razon"],
                ':id_ciudad'         => $_POST["ciudad"],
                ':direccion'         => $_POST["direccion"],
                ':telefono'          => $_POST["telefono"],
                ':sexo'              => $_POST["sexo"],
                ':f_nacimiento'      => $_POST["f_nacimiento"],
                ':id_cliente'        => $_POST["id_cliente"]
            )
        );
        $info = array(
            "mensaje"   => "REGISTRO MODIFICADO",
            "icono"     => "success",
            "exito"     => true
        );
    } else {
        $stmt = $conexion->prepare("SELECT id_cliente, ruc FROM clientes WHERE ruc = :ruc");
        $stmt->execute(array(':ruc' => $_POST["ruc"]));
        $resultado = $stmt->fetchAll();
        if (count($resultado) > 0) {
            $info = array(
                "mensaje"   => "EL RUC O C.I INGRESADO PERTENECE A UN CLIENTE.!!!",
                "icono"     => "warning",
                "exito"     => false
            );
        } else {
            $stmt = $conexion->prepare("UPDATE clientes SET ruc = :ruc, razon_social = :razon_social, id_ciudad = :id_ciudad,
            direccion = :direccion, telefono = :telefono, sexo = :sexo, f_nacimiento = :f_nacimiento 
            WHERE id_cliente = :id_cliente");

            $resultado = $stmt->execute(
                array(
                    ':ruc'               => $_POST["ruc"],
                    ':razon_social'      => $_POST["razon"],
                    ':id_ciudad'         => $_POST["ciudad"],
                    ':direccion'         => $_POST["direccion"],
                    ':telefono'          => $_POST["telefono"],
                    ':sexo'              => $_POST["sexo"],
                    ':f_nacimiento'      => $_POST["f_nacimiento"],
                    ':id_cliente'        => $_POST["id_cliente"]
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
