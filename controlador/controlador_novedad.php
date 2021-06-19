<?php
require_once '../modelo/modelo_novedad.php';
require_once '../modelo/conexion.php';

class novedadFull
{
    public $tipo;
    public $descripcion;
    public $ticket;
}

if (isset($_POST['tipo'])) {
    $novedad = new novedadFull();
    $novedad->tipo = $_POST['tipo'];
    $novedad->descripcion = $_POST['descripcion'];
    $novedad->ticket = $_POST['ticket'];
}

switch ($_POST['accion']) {
    case 'registrar':
        $PR = new Modelo_Novedad();
        $consulta = $PR->RegistrarNovedad($novedad);
        echo json_encode($consulta);
        break;
    case 'eliminar':
        $PR = new Modelo_Novedad();
        $consulta = $PR->EliminarNovedad($_POST['id']);
        echo json_encode($consulta);
        break;
    case 'actualizar':
        $PR = new Modelo_Novedad();
        $consulta = $PR->ActualizarNovedad($novedad);
        echo json_encode($consulta);
        break;
    case 'listar':
        $PR = new Modelo_Novedad();
        $consulta = $PR->ListarNovedades();
        echo json_encode($consulta);
        break;
    case 'consultar':
        $PR = new Modelo_Novedad();
        $consulta = $PR->ConsultarNovedad($_POST['id']);
        echo json_encode($consulta);
        break;
    case 'cargar':
        $PR = new Modelo_Novedad();
        $consulta = $PR->CargarNovedadesPorNumeroTicket($_POST['id']);
        echo json_encode($consulta);
        break;
}