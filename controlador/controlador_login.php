<?php
require_once '../modelo/modelo_login.php';
require_once '../modelo/conexion.php';

//inicio de sesion
session_start();

$PR = new Modelo_Login();
if (isset($_POST['user']) && isset($_POST['pass'])) {
    $consulta = $PR->IniciarSesionAdministrador();

    if ($consulta != null) {
        $_SESSION['tipo_usuario'] = array("user" => "admin", "login" => date('Y-m-d'));
        $consulta[0]['tipo'] = "admin";
        echo json_encode($consulta);
        return;
    }

    $consulta = $PR->IniciarSesionVigilante();

    if ($consulta != null) {
        $_SESSION['tipo_usuario'] = array("user" => "vigi", "login" => date('Y-m-d'));
        $consulta[0]['tipo'] = "vigi";
        echo json_encode($consulta);
        return;
    }
} else {
    $consulta = $PR->IniciarRevisarVehiculo();

    if ($consulta != null) {
        $_SESSION['tipo_usuario'] = array("user" => "prop", "login" => date('Y-m-d'));
        $consulta[0]['tipo'] = "prop";
        echo json_encode($consulta);
        return;
    }
}

echo json_encode($consulta);
