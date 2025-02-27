<?php

function subir_imagen()
{
    if (isset($_FILES["imagen_usuario"])) {
        $extension = explode('.', $_FILES["imagen_usuario"]['name']);
        $nuevo_nombre = $_POST["entrenador"] . '.' . $extension[1];
        $ubicacion = dirname(dirname(__FILE__)) . '/img/usuarios/' . $nuevo_nombre;
        move_uploaded_file($_FILES["imagen_usuario"]['tmp_name'], $ubicacion);
        return $nuevo_nombre;
    }
}

function obtener_nombre_imagen($id_usuario)
{
    include('conexion.php'); 
    $stmt = $conexion->prepare("SELECT imagen FROM usuarios WHERE id_usuario = '$id_usuario'");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        return $fila["imagen"];
    }
}

function obtener_ciudades()
{
    include('conexion.php');
    $stmt = $conexion->prepare("SELECT * FROM ciudades");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
function obtener_roles()
{
    include('conexion.php');
    $stmt = $conexion->prepare("SELECT * FROM roles");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
function obtener_marcas()
{
    include('conexion.php');
    $stmt = $conexion->prepare("SELECT * FROM marcas");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
function obtener_clientes()
{
    include('conexion.php');
    $stmt = $conexion->prepare(
        "SELECT c.`id_cliente`, c.`ruc`, c.`razon_social`, cs.`ciudad`, c.`direccion`, c.`telefono`, c.`sexo`, 
        TIMESTAMPDIFF(YEAR, c.f_nacimiento, CURDATE()) as f_nacimiento
        FROM clientes c INNER JOIN ciudades cs ON c.id_ciudad = cs.id_ciudad;"
    );
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}

function obtener_proveedores()
{
    include('conexion.php');
    $stmt = $conexion->prepare(
        "SELECT p.id_proveedor, p.ruc, p.razon_social, p.direccion, c.ciudad, p.telefono
        FROM proveedores p INNER JOIN ciudades c ON p.id_ciudad = c.id_ciudad"
    );
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}

function obtener_ejercicios()
{
    include('conexion.php');
    $stmt = $conexion->prepare("SELECT * FROM ejercicios");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
function obtener_detalle_rutina()
{
    include('conexion.php');
    $stmt = $conexion->prepare(
        "SELECT rd.id_detalle, rc.descripcion, e.ejercicio, rd.cant_serie, rd.cant_repeticiones
    FROM rutina_detalle rd INNER JOIN rutina_cabecera rc ON rd.id_rutina = rc.id_rutina
    INNER JOIN ejercicios e ON rd.id_ejercicio = e.id_ejercicio "
    );
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
function obtener_articulos()
{
    include('conexion.php');
    $stmt = $conexion->prepare("SELECT * FROM articulos");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}

function obtener_asistencias()
{
    include('conexion.php');
    $stmt = $conexion->prepare("SELECT * FROM asistencia");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
function obtener_usuarios()
{
    include('conexion.php');
    $stmt = $conexion->prepare("SELECT * FROM usuarios");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
function obtener_medidas()
{
    include('conexion.php');
    $stmt = $conexion->prepare("SELECT * FROM medidas");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}

function obtener_rutinas()
{
    include('conexion.php');
    $stmt = $conexion->prepare("SELECT * FROM rutina_cabecera");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $stmt->rowCount();
}
