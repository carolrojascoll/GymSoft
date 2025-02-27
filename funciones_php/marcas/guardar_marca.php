<?php

include("../conexion.php");

if ($_POST["operacion"] == "Nuevo") {
    $stmt = $conexion->prepare("SELECT id_marca, marca FROM marcas WHERE marca = :marca");
    $stmt->execute(array(':marca'    => $_POST["marca"]));
    $resultado = $stmt->fetchAll();
    if (count($resultado) > 0) {
        $info = array(
            "mensaje"        => $_POST["marca"] . " YA EXSTE.!!!\nINGRESE OTRA MARCA.!!!",
            "icono"          => "warning",
            "exito"          => false
        );
    } else {
        $stmt = $conexion->prepare("INSERT INTO marcas (marca) VALUES (:marca)");
        $resultado = $stmt->execute(
            array(
                ':marca'   => $_POST["marca"]
            )
        );
        $info = array(
            "mensaje"   => "REGISTRO INSERTADO",
            "icono"     => "success",
            "exito"     => true
        );
    }
} else {
    $cod = "";
    $marca = "";
    $stmt = $conexion->prepare("SELECT id_marca, marca FROM marcas WHERE id_marca = :id_marca AND marca = :marca");
    $stmt->execute(
        array(
            ':id_marca'  => $_POST["id_marca"],
            ':marca'    => $_POST["marca"]
        )
    );
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $cod = $fila["id_marca"];
        $marca = $fila["marca"];
    }

    if ($_POST["marca"] == $marca) {
        $stmt = $conexion->prepare("UPDATE marcas SET marca = :marca WHERE id_marca = :id_marca");
        $resultado = $stmt->execute(
            array(
                ':marca'       => $_POST["marca"],
                ':id_marca'    => $_POST["id_marca"]
            )
        );
        $info = array(
            "mensaje"       => "REGISTRO MODIFICADO.!!!",
            "icono"         => "success",
            "exito"         => true
        );
    } else {
        $stmt = $conexion->prepare("SELECT id_marca, marca FROM marcas WHERE marca = :marca");
        $stmt->execute(
            array(
                ':marca'  => $_POST["marca"]
            )
        );
        $resultado = $stmt->fetchAll();
        if (count($resultado) > 0) {
            $info = array(
                "mensaje"       => $_POST["marca"] . " YA EXISTE.\nINGRESE OTRA MARCA.!!!",
                "icono"         => "warning",
                "exito"         => false
            );
        } else {
            $stmt = $conexion->prepare("UPDATE marcas SET marca = :marca WHERE id_marca = :id_marca");
            $resultado = $stmt->execute(
                array(
                    ':marca'       => $_POST["marca"],
                    ':id_marca'    => $_POST["id_marca"]
                )
            );
            $info = array(
                "mensaje"       => "REGISTRO MODIFICADO.!!!",
                "icono"         => "success",
                "exito"         => true
            );
        }
    }
}
echo json_encode($info);
