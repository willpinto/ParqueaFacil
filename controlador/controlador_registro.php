<?php
require_once '../modelo/modelo_registro.php';
require_once '../modelo/conexion.php';

class registroFull
{
    public $id;
    public $fingreso;
    public $fsalida;
    public $estado;
    public $placaveh;
    public $documentovig;
    public $idAsociado;
}

class conductorVehiculo
{
    public $documento;
    public $placa;
}

if (isset($_POST['check'])) {
    $tipoCheck = $_POST['check'];
    $registro = new registroFull();
    if ($tipoCheck == "in") {
        $registro->id = "";
        $registro->fingreso = date("Y-m-d h:i:s");
        $registro->fsalida = "";
        $registro->estado = true;
        $registro->placaveh = $_POST['placa'];
        $registro->documentovig = $_POST['cedula'];
        $registro->idAsociado = $_POST['idAsociado'];
    } else {
        $registro->id = $_POST['id'];
        $registro->fingreso = $_POST['fingreso'];
        $registro->fsalida = date("Y-m-d h:i:s");
        $registro->estado = false;
        $registro->placaveh = $_POST['placa'];
        $registro->documentovig = $_POST['cedula'];
    }
}

if(isset($_POST['usuario'])) {
    //$usuario = $_POST['usuario'];
    $condVeh = new conductorVehiculo();
    $condVeh->documento = $_POST['cedula'];
    $condVeh->placa = $_POST['placa'];
}

switch ($_POST['accion']) {
    case 'registrar':
        $PR = new Modelo_Registro();
        $consulta = $PR->RegistrarRegistro($registro);
        echo $consulta;
        break;
    case 'asociar':
        $PR = new Modelo_Registro();
        $consulta = $PR->AsociarConductorVehiculo($condVeh);
        echo $consulta;
        break;
    case 'eliminar':
        $PR = new Modelo_Registro();
        $consulta = $PR->EliminarRegistro($_POST['id']);
        echo json_encode($consulta);
        break;
    case 'actualizar':
        $PR = new Modelo_Registro();
        $consulta = $PR->ActualizarRegistro($registro);
        echo json_encode($consulta);
        break;
    case 'listar':
        $PR = new Modelo_Registro();
        $consulta = $PR->ListarRegistros();
        echo json_encode($consulta);
        break;
    case 'consultar':
        $PR = new Modelo_Registro();
        $consulta = $PR->ConsultarRegistro($_POST['id']);
        echo json_encode($consulta);
        break;
    case 'verificar': //Login Conductor
        $PR = new Modelo_Registro();
        $consulta = $PR->VerificarRegistro($_POST['cedula'], $_POST['placa']);
        echo json_encode($consulta);
        break;
    case 'detectar':
        $PR = new Modelo_Registro();
        $consulta = $PR->ObtenerIDRegistroActivoPorPlaca($_POST['placa']);
        echo $consulta;
        break;
    case 'traerRegistro':
        $PR = new Modelo_Registro();
        $consulta = $PR->ConsultarRegistroActivoPorPlaca($_POST['placa']);
        echo json_encode($consulta);
        break;
    case 'indagar':
        $PR = new Modelo_Registro();
        $consulta = $PR->ConsultarRegistroActivoPorTicket($_POST['numero']);
        echo json_encode($consulta);
        break;
    case 'buscarAsociado':
        $PR = new Modelo_Registro();
        $consulta = $PR->ObtenerIDAsociadoConductorVehiculo($condVeh);
        echo $consulta;
        break;
    case 'abstraer':
        $PR = new Modelo_Registro();
        $consulta = $PR->ConsultarPlacasActivas();
        echo json_encode($consulta);
        break;
}
