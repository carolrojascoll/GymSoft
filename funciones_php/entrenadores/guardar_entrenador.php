<?php

include("../conexion.php");

if ($_POST["operacion"] == "Nuevo") {
    $stmt = $conexion->prepare("SELECT id_entrenador, ruc_ci FROM entrenadores WHERE ruc_ci = :ruc_ci");
    $stmt->execute(array(':ruc_ci' => $_POST["ruc"]));
    $resultado = $stmt->fetchAll();

    if (count($resultado) > 0) {
        $info = array(
            "mensaje"        => "EL CI O RUC INGRESADO YA PERTENECE A OTRO ENTRENADOR.!!!",
            "icono"          => "warning",
            "focus"          => "#ruc",
            "exito"          => false
        );
    } else {
        $stmt = $conexion->prepare(
            "INSERT INTO entrenadores (ruc_ci, nombre, apellido, id_ciudad, direccion, 
                telefono, sexo, fecha_nac, sueldo_bruto, horas_trabajo) 
                VALUES (:ruc_ci, :nombre, :apellido, :id_ciudad, :direccion, :telefono, :sexo, :fecha_nac,
                :sueldo_bruto, :horas_trabajo)"
        );

        $resultado = $stmt->execute(
            array(
                ':ruc_ci'               => $_POST["ruc"],
                ':nombre'               => $_POST["nombre"],
                ':apellido'             => $_POST["apellido"],
                ':id_ciudad'            => $_POST["ciudad"],
                ':direccion'            => $_POST["direccion"],
                ':telefono'             => $_POST["telefono"],
                ':sexo'                 => $_POST["sexo"],
                ':fecha_nac'            => $_POST["fecha_nac"],
                ':sueldo_bruto'         => $_POST["sueldo_bruto"],
                ':horas_trabajo'        => $_POST["horas_trabajo"]
            )
        );

        $info = array(
            "mensaje"    => "REGISTRO INSERTADO",
            "icono"      => "success",
            "exito"      => true
        );
    }
} else {
    $stmt = $conexion->prepare("SELECT id_entrenador, ruc_ci FROM entrenadores WHERE id_entrenador = :id_entrenador");
    $stmt->execute(array(':id_entrenador' => $_POST["id_entrenador"]));
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $codigo = $fila["id_entrenador"];
        $ci_ruc = $fila["ruc_ci"];
    }
    if ($ci_ruc == $_POST["ruc"]) {
        $stmt = $conexion->prepare("UPDATE entrenadores SET ruc_ci = :ruc_ci,nombre = :nombre, apellido = :apellido, 
            id_ciudad = :id_ciudad, direccion = :direccion, telefono = :telefono, sexo = :sexo, 
            fecha_nac = :fecha_nac, sueldo_bruto = :sueldo_bruto, horas_trabajo = :horas_trabajo
            WHERE id_entrenador = :id_entrenador");

        $resultado = $stmt->execute(
            array(
                ':ruc_ci'               => $_POST["ruc"],
                ':nombre'               => $_POST["nombre"],
                ':apellido'             => $_POST["apellido"],
                ':id_ciudad'            => $_POST["ciudad"],
                ':direccion'            => $_POST["direccion"],
                ':telefono'             => $_POST["telefono"],
                ':sexo'                 => $_POST["sexo"],
                ':fecha_nac'            => $_POST["fecha_nac"],
                ':sueldo_bruto'         => $_POST["sueldo_bruto"],
                ':horas_trabajo'        => $_POST["horas_trabajo"],
                ':id_entrenador'        => $_POST["id_entrenador"]
            )
        );
        $info = array(
            "mensaje"   => "REGISTRO MODIFICADO",
            "icono"     => "success",
            "exito"     =>  true
        );
    } else {
        $stmt = $conexion->prepare("SELECT id_entrenador, ruc_ci FROM entrenadores WHERE id_entrenador = :id_entrenador");
        $stmt->execute(array(':id_entrenador' => $_POST["id_entrenador"]));
        $resultado = $stmt->fetchAll();
        foreach ($resultado as $fila) {
            $codigo = $fila["id_entrenador"];
            $ruc = $fila["ruc_ci"];
        }
        if ($ruc == $_POST["ruc"]) {
            $stmt = $conexion->prepare("UPDATE entrenadores SET ruc_ci = :ruc_ci,nombre = :nombre, apellido = :apellido, 
            id_ciudad = :id_ciudad, direccion = :direccion, telefono = :telefono, sexo = :sexo, 
            fecha_nac = :fecha_nac WHERE id_entrenador = :id_entrenador");

            $resultado = $stmt->execute(
                array(
                    ':ruc_ci'               => $_POST["ruc"],
                    ':nombre'               => $_POST["nombre"],
                    ':apellido'             => $_POST["apellido"],
                    ':id_ciudad'            => $_POST["ciudad"],
                    ':direccion'            => $_POST["direccion"],
                    ':telefono'             => $_POST["telefono"],
                    ':sexo'                 => $_POST["sexo"],
                    ':fecha_nac'            => $_POST["fecha_nac"],
                    ':id_entrenador'        => $_POST["id_entrenador"]
                )
            );
            $info = array(
                "mensaje"   => "REGISTRO MODIFICADO",
                "icono"     => "success",
                "exito"     =>  true
            );
        } else {
            $stmt = $conexion->prepare("SELECT id_entrenador, ruc_ci FROM entrenadores WHERE ruc_ci = :ruc_ci");
            $stmt->execute(array(':ruc_ci' => $_POST["ruc"]));
            $resultado = $stmt->fetchAll();
            if (count($resultado) > 0) {
                $info = array(
                    "mensaje"        => "EL CI O RUC INGRESADO YA PERTENECE A OTRO ENTRENADOR.!!!",
                    "icono"          => "warning",
                    "focus"          => "#ruc",
                    "exito"          => false
                );
            } else {
                $stmt = $conexion->prepare("UPDATE entrenadores SET ruc_ci = :ruc_ci,nombre = :nombre, apellido = :apellido, 
                id_ciudad = :id_ciudad, direccion = :direccion, telefono = :telefono, sexo = :sexo, 
                fecha_nac = :fecha_nac, sueldo_bruto = :sueldo_bruto, horas_trabajo = :horas_trabajo
                WHERE id_entrenador = :id_entrenador");

                $resultado = $stmt->execute(
                    array(
                        ':ruc_ci'               => $_POST["ruc"],
                        ':nombre'               => $_POST["nombre"],
                        ':apellido'             => $_POST["apellido"],
                        ':id_ciudad'            => $_POST["ciudad"],
                        ':direccion'            => $_POST["direccion"],
                        ':telefono'             => $_POST["telefono"],
                        ':sexo'                 => $_POST["sexo"],
                        ':fecha_nac'            => $_POST["fecha_nac"],
                        ':sueldo_bruto'         => $_POST["sueldo_bruto"],
                        ':horas_trabajo'        => $_POST["horas_trabajo"],
                        ':id_entrenador'        => $_POST["id_entrenador"]
                    )
                );
                $info = array(
                    "mensaje"   => "REGISTRO MODIFICADO",
                    "icono"     => "success",
                    "exito"     =>  true
                );
            }
        }
    }
}

echo json_encode($info);
