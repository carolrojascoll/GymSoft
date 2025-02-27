<?php

include("../conexion.php");

if (isset($_POST["id_usuario"])) {
    $salida = array();
    $stmt = $conexion->prepare(
        "SELECT u.id_entrenador, e.ruc_ci, CONCAT(e.nombre, ' ',e.apellido) AS entrenador,
            u.id_rol, u.email, u.imagen, u.usuario, u.contrasena
            FROM usuarios u INNER JOIN entrenadores e ON u.id_entrenador = e.id_entrenador 
            INNER JOIN roles r ON u.id_rol = r.id_rol 
            WHERE u.id_usuario = '" . $_POST["id_usuario"] . "' LIMIT 1"
    );
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $salida["id_entrenador"]        = $fila["id_entrenador"];
        $salida["ruc_ci"]               = $fila["ruc_ci"];
        $salida["entrenador"]           = $fila["entrenador"];
        $salida["id_rol"]               = $fila["id_rol"];
        $salida["correo"]               = $fila["email"];
        $salida["imagen"]               = $fila["imagen"];
        if ($fila["imagen"] != "") {
            $salida["imagen_usuario"] = '<img src="../../img/usuarios/' . $fila["imagen"] . '"  class="img-thumbnail" 
            width="100" height="50" />
            <input type="hidden" name="imagen_usuario_oculta" value="' . $fila["imagen"] . '" />';
        } else {
            $salida["imagen_usuario"] = '<input type="hidden" name="imagen_usuario_oculta" value="" />';
        }
        $salida["usuario"]              = $fila["usuario"];
        $salida["contrasena"]           = $fila["contrasena"];
    }
    echo json_encode($salida);
}
