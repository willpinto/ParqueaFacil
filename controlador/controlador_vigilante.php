<?php
require_once '../modelo/modelo_vigilante.php';
require_once '../modelo/conexion.php';

class vigilanteFull
{
    public $cedula;
    public $nombres;
    public $turno;
    public $rol;
    public $contrasena;
    public $documentoadm;
}

if(isset($_POST['nombres'])) {
    $vigilante = new vigilanteFull();
    $vigilante->cedula = $_POST['cedula'];
    $vigilante->nombres = $_POST['nombres'];
    $vigilante->turno = $_POST['turno'];
    $vigilante->rol = $_POST['rol'];
    $vigilante->contrasena = $_POST['contrasena'];
    $vigilante->documentoadm = $_POST['documentoadm'];
}

switch ($_POST['accion']) {
    case 'registrar':
        $PR = new Modelo_Vigilante();
        $consulta = $PR->RegistrarVigilante($vigilante);
        echo json_encode($consulta);
        break;
    case 'eliminar':
        $PR = new Modelo_Vigilante();
        $consulta = $PR->EliminarVigilante($_POST['cedula']);
        echo json_encode($consulta);
        break;
    case 'actualizar':
        $PR = new Modelo_Vigilante();
        $consulta = $PR->ActualizarVigilante($vigilante);
        echo json_encode($consulta);
        break;
    case 'listar':
        $PR = new Modelo_Vigilante();
        $consulta = $PR->ListarVigilantes();
        echo json_encode($consulta);
        break;
    case 'consultar':
        $PR = new Modelo_Vigilante();
        $consulta = $PR->ConsultarVigilante($_POST['cedula']);
        echo json_encode($consulta);
        break;
}
