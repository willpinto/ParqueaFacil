<?php
define('RutaUnica', true);
session_start();

if (isset($_POST['perfil'])) {
    if ($_POST['perfil'] == "salir") {
        unset($_SESSION['tipo_usuario']); //destruye la sesión
    }
}

if (isset($_SESSION['tipo_usuario'])) {
    $perfil = $_SESSION['tipo_usuario']['user'];
    if((strtotime(date('Y-m-d')) - strtotime($_SESSION['tipo_usuario']['login'])) > 86400) {
        unset($_SESSION['tipo_usuario']);
        $perfil = "login";
    }
} else {
    $perfil = "login";
}

switch ($perfil) {
    case 'login':
        require("vistas/login.html");
        break;
    case 'admin':
        require("vistas/administrador/administradorindex.php");
        break;
    case 'vigi':
        require("vistas/vigilante/vigilanteindex.php");
        break;
    case 'prop':
        require("vistas/propietario/propietarioinfo.php");
        break;
}
