<?php

include("../conexion.php");
include("../funciones.php");

$query = "";
$salida = array();
$query =
    "SELECT u.id_usuario, u.id_entrenador, 
    CONCAT(e.nombre,' ',e.apellido) as entrenador, 
    r.rol, u.email, u.imagen, u.usuario
    FROM usuarios u INNER JOIN entrenadores e ON u.id_entrenador = e.id_entrenador
    INNER JOIN roles r ON u.id_rol = r.id_rol ";

if (isset($_POST["search"]["value"])) {
    $query .= ' WHERE u.usuario LIKE "%' . $_POST["search"]["value"] . '%" ';
}

if (isset($_POST["order"])) {
    $query .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST["order"][0]['dir'] . ' ';
} else {
    $query .= ' ORDER BY u.id_usuario';
}

$stmt = $conexion->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();
$datos = array();
$filtered_rows = $stmt->rowCount();
foreach ($resultado as $fila) {
    $imagen = '';
    if ($fila["imagen"] != '') {
        $imagen = '<img src="../../img/usuarios/' . $fila["imagen"] . '"  class="img-thumbnail rounded" width="50px" height="35" />';
    } else {
        $imagen = '';
    }
    $sub_array = array();
    $sub_array[] = $fila["id_usuario"];
    $sub_array[] = $fila["id_entrenador"];
    $sub_array[] = $fila["entrenador"];
    $sub_array[] = $fila["rol"];
    $sub_array[] = $fila["email"];
    $sub_array[] = $imagen;
    $sub_array[] = $fila["usuario"];
    $sub_array[] = '<button type="button" name="editar" id="' . $fila["id_usuario"] . '" 
        class="btn btn-primary btn-xs editar"><i class="bi bi-pencil-square"></i></button>';
    $sub_array[] = '<button type="button" name="borrar" id="' . $fila["id_usuario"] . '" 
        class="btn btn-danger btn-xs borrar"><i class="bi bi-trash3"></i></button>';
    $datos[] = $sub_array;
}

$salida = array(
    "draw"              => intval($_POST["draw"]),
    "recordsTotal"      => $filtered_rows,
    "recordsFiltered"   => obtener_usuarios(),
    "data"              => $datos
);

echo json_encode($salida);
