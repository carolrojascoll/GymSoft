<?php

include("../conexion.php");

$cod = "";
$desc = "";
$cod_marca = "";
$nom_marca = "";

if ($_POST["operacion"] == "Nuevo") {
    $stmt = $conexion->prepare(
        "SELECT a.id_articulo, a.codigo, a.descripcion, a.id_marca, m.marca
        FROM articulos a INNER JOIN marcas m ON a.id_marca = m.id_marca
        WHERE a.codigo = :codigo"
    );
    $stmt->execute(array(':codigo' => $_POST["codigo"]));
    $resultado = $stmt->fetchAll();
    if (count($resultado) > 0) {
        $info = array(
            'mensaje' => "EL CÓDIGO INGRESADO YA FUE REGISTRADO.\nINGRESE OTRO CÓDIGO.!!!",
            'icono'   => "warning",
            'timer'     => 2000,
            'exito'   => false
        );
    } else {
        $stmt = $conexion->prepare(
            "SELECT a.id_articulo, a.codigo, a.descripcion, a.id_marca, m.marca
            FROM articulos a INNER JOIN marcas m ON a.id_marca = m.id_marca
            WHERE a.descripcion = :descripcion AND a.id_marca = :id_marca"
        );
        $stmt->execute(array(':descripcion' => $_POST["descripcion"], ':id_marca' => $_POST["marcas"]));
        $resultado = $stmt->fetchAll();
        if (count($resultado) > 0) {
            foreach ($resultado as $fila) {
                $desc       = $fila["descripcion"];
                $nom_marca  = $fila["marca"];
            }
            $info = array(
                'mensaje' => $desc . ' ' . $nom_marca . " YA EXISTE.\nSELECCIONE OTRA MARCA O INGRESE OTRA DESCRIPCIÓN",
                'icono'   => "warning",
                'timer'     => 2000,
                'exito'   => false
            );
        } else {
            $stmt = $conexion->prepare("INSERT INTO articulos 
            (codigo, id_marca, descripcion, id_iva, stock_actual, precio_compra, porcent_ganancia, precio_venta)
            VALUES (:codigo, :id_marca, :descripcion, :id_iva, :stock_actual, :precio_compra, :porcent_ganancia, :precio_venta)");

            $resultado = $stmt->execute(array(
                ':codigo'                        => $_POST["codigo"],
                ':id_marca'                      => $_POST["marcas"],
                ':descripcion'                   => $_POST["descripcion"],
                ':id_iva'                        => $_POST["iva"],
                ':stock_actual'                  => $_POST["stock"],
                ':precio_compra'                 => $_POST["p_compra"],
                ':porcent_ganancia'              => $_POST["porcent"],
                ':precio_venta'                  => $_POST["p_venta"]
            ));

            $info = array(
                "mensaje"       => "REGISTRO INSERTADO.!!!",
                "icono"         => "success",
                'timer'         => 1500,
                "exito"         => true
            );
        }
    }
} else {
    $stmt = $conexion->prepare(
        "SELECT a.id_articulo, a.codigo, a.descripcion, a.id_marca, m.marca
        FROM articulos a INNER JOIN marcas m ON a.id_marca = m.id_marca
        WHERE a.id_articulo = :id_articulo"
    );
    $stmt->execute(array(':id_articulo' => $_POST["id_articulo"]));
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $cod        = $fila["codigo"];
        $desc       = $fila["descripcion"];
        $cod_marca  = $fila["id_marca"];
        $nom_marca  = $fila["marca"];
    }
    if ($cod == $_POST["codigo"]) {

        if ($desc == $_POST["descripcion"] && $cod_marca == $_POST["marcas"]) {
            
            $stmt = $conexion->prepare(
                "UPDATE articulos SET codigo = :codigo, id_marca = :id_marca,
                            descripcion = :descripcion, id_iva = :iva, stock_actual = :stock_actual,
                            precio_compra = :precio_compra, porcent_ganancia = :porcent_ganancia,
                            precio_venta = :precio_venta WHERE id_articulo = :id_articulo;"
            );

            $stmt->execute(
                array(
                    ':codigo'                        => $_POST["codigo"],
                    ':id_marca'                      => $_POST["marcas"],
                    ':descripcion'                   => $_POST["descripcion"],
                    ':iva'                           => $_POST["iva"],
                    ':stock_actual'                  => $_POST["stock"],
                    ':precio_compra'                 => $_POST["p_compra"],
                    ':porcent_ganancia'              => $_POST["porcent"],
                    ':precio_venta'                  => $_POST["p_venta"],
                    ':id_articulo'                   => $_POST["id_articulo"]
                )
            );
            $info = array(
                "mensaje"   => "REGISTRO MODIFICADO",
                "icono"     => "success",
                'timer'     => 1500,
                "exito"     => true
            );
        } else {
            $stmt = $conexion->prepare(
                "SELECT a.id_articulo, a.codigo, a.descripcion, a.id_marca, m.marca
                    FROM articulos a INNER JOIN marcas m ON a.id_marca = m.id_marca
                    WHERE a.descripcion = :descripcion AND a.id_marca = :id_marca"
            );
            $stmt->execute(array(':descripcion' => $_POST["descripcion"], ':id_marca' => $_POST["marcas"]));
            $resultado = $stmt->fetchAll();
            if (count($resultado) > 0) {
                foreach ($resultado as $fila) {
                    $desc       = $fila["descripcion"];
                    $nom_marca  = $fila["marca"];
                }
                $info = array(
                    'mensaje' => $desc . ' ' . $nom_marca . " YA EXISTE.\nSELECCIONE OTRA MARCA O INGRESE OTRA DESCRIPCIÓN",
                    'icono'   => "warning",
                    'timer'   => 2000,
                    'exito'   => false
                );
            }
        }
    } else {
        $stmt = $conexion->prepare(
            "SELECT a.id_articulo, a.codigo, a.descripcion, a.id_marca, m.marca
            FROM articulos a INNER JOIN marcas m ON a.id_marca = m.id_marca
            WHERE a.codigo = :codigo"
        );
        $stmt->execute(array(':codigo' => $_POST["codigo"]));
        $resultado = $stmt->fetchAll();
        if (count($resultado) > 0) {
            $info = array(
                'mensaje'   => "EL CÓDIGO INGRESADO YA FUE REGISTRADO.\nINGRESE OTRO CÓDIGO.!!!",
                'icono'     => "warning",
                'timer'     => 2000,
                'exito'     => false
            );
        } else {
            $stmt = $conexion->prepare(
                "SELECT a.id_articulo, a.codigo, a.descripcion, a.id_marca, m.marca
                    FROM articulos a INNER JOIN marcas m ON a.id_marca = m.id_marca
                    WHERE a.descripcion = :descripcion AND a.id_marca = :id_marca"
            );
            $stmt->execute(array(':descripcion' => $_POST["descripcion"], ':id_marca' => $_POST["marcas"]));
            $resultado = $stmt->fetchAll();
            if (count($resultado) > 0) {
                foreach ($resultado as $fila) {
                    $desc       = $fila["descripcion"];
                    $nom_marca  = $fila["marca"];
                }
                $info = array(
                    'mensaje' => $desc . ' ' . $nom_marca . " YA EXISTE.\nSELECCIONE OTRA MARCA O INGRESE OTRA DESCRIPCIÓN",
                    'icono'   => "warning",
                    'timer'   => 2000,
                    'exito'   => false
                );
            } else {
                $stmt = $conexion->prepare(
                    "UPDATE articulos SET codigo = :codigo, id_marca = :id_marca,
                                descripcion = :descripcion, id_iva = :iva, stock_actual = :stock_actual,
                                precio_compra = :precio_compra, porcent_ganancia = :porcent_ganancia,
                                precio_venta = :precio_venta WHERE id_articulo = :id_articulo;"
                );

                $stmt->execute(
                    array(
                        ':codigo'                        => $_POST["codigo"],
                        ':id_marca'                      => $_POST["marcas"],
                        ':descripcion'                   => $_POST["descripcion"],
                        ':iva'                           => $_POST["iva"],
                        ':stock_actual'                  => $_POST["stock"],
                        ':precio_compra'                 => $_POST["p_compra"],
                        ':porcent_ganancia'              => $_POST["porcent"],
                        ':precio_venta'                  => $_POST["p_venta"],
                        ':id_articulo'                   => $_POST["id_articulo"]
                    )
                );
                $info = array(
                    "mensaje"   => "REGISTRO MODIFICADO",
                    "icono"     => "success",
                    'timer'     => 1500,
                    "exito"     => true
                );
            }
        }
    }
}

echo json_encode($info);
