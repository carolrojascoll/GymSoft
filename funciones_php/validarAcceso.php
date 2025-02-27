<?php
header('Content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
require_once("ConexionBD.php");

if (isset($_POST)) {
    //recibo los datos y los decodifico con PHP
    @$nombre = $_POST['user'];
    @$contrasena = $_POST['pass'];
    if ($nombre == null || $nombre == "") {
             $jsondata = array("mensaje" => "No autorizado!!...");
    }else {
        $conexion = ConexionBD();
        try {
            $stmt = $conexion->prepare("SELECT * FROM usuarios
            WHERE usuario = :parametro1 and contrasena = :parametro2 ");
            $stmt->bindParam(":parametro1", $nombre);
            $stmt->bindParam(":parametro2", $contrasena);
            $resultado = $stmt->execute();

        } catch (PDOException $e) {
            // tratamiento del error
            $jsondata = array("operacion" => "false", "mensaje" => $e->GetMessage());
        }
        $bandera = 0;
        foreach ($stmt as $row) {
            $jsondata = array("operacion" => "true");
            $bandera = 1;
        }
        if ($bandera === 0) {
            $jsondata = array("operacion" => "false");
        }
    }
}
echo json_encode($jsondata);
?>
