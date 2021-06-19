<?php
require_once '../modelo/modelo_vehiculo.php';
require_once '../modelo/conexion.php';

class vehiculoFull
{
    public $placa;
    public $tipo;
    public $marca;
    public $linea;
    public $modelo;
    public $servicio;
    public $cilindraje;
    public $chasis;
    public $motor;
    public $color;
    public $tcarroceria;
}

if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
    $vehiculo = new vehiculoFull();
    if ($usuario == "vigi") {
        $vehiculo->placa = $_POST['placa'];
        $vehiculo->tipo = "";
        $vehiculo->marca = "";
        $vehiculo->linea = "";
        $vehiculo->modelo = 0;
        $vehiculo->servicio = "";
        $vehiculo->cilindraje = 0;
        $vehiculo->chasis = "";
        $vehiculo->motor = "";
        $vehiculo->color = "";
        $vehiculo->tcarroceria = "";
    } else {
        $vehiculo->placa = $_POST['placa'];
        $vehiculo->tipo = $_POST['tipo'];
        $vehiculo->marca = $_POST['marca'];
        $vehiculo->linea = $_POST['linea'];
        $vehiculo->modelo = $_POST['modelo'];
        $vehiculo->servicio = $_POST['servicio'];
        $vehiculo->cilindraje = $_POST['cilindraje'];
        $vehiculo->chasis = $_POST['chasis'];
        $vehiculo->motor = $_POST['motor'];
        $vehiculo->color = $_POST['color'];
        $vehiculo->tcarroceria = $_POST['tcarroceria'];
    }
}

switch ($_POST['accion']) {
    case 'registrar':
        $PR = new Modelo_Vehiculo();
        $consulta = $PR->RegistrarVehiculo($vehiculo);
        echo json_encode($consulta);
        break;
    case 'eliminar':
        $PR = new Modelo_Vehiculo();
        $consulta = $PR->EliminarVehiculo($_POST['placa']);
        echo json_encode($consulta);
        break;
    case 'actualizar':
        $PR = new Modelo_Vehiculo();
        $consulta = $PR->ActualizarVehiculo($vehiculo);
        echo json_encode($consulta);
        break;
    case 'listar':
        $PR = new Modelo_Vehiculo();
        $consulta = $PR->ListarVehiculos();
        echo json_encode($consulta);
        break;
    case 'consultar':
        $PR = new Modelo_Vehiculo();
        $consulta = $PR->ConsultarVehiculo($_POST['placa']);
        echo json_encode($consulta);
        break;
    case 'obtener':
        $PR = new Modelo_Vehiculo();
        $consulta = $PR->ConsultarVehiculoPorPlacaDocumento($_POST['placa'], $_POST['cedula']);
        echo json_encode($consulta);
        break;
    case 'adquirir':
        $PR = new Modelo_Vehiculo();
        $consulta = $PR->ConsultarVehiculosPorPropietario($_POST['cedula']);
        echo json_encode($consulta);
        break;
}
