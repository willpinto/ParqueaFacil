<?php
require_once '../modelo/modelo_administrador.php';
require_once '../modelo/conexion.php';

class administradorFull
{
    public $cedula;
    public $nombres;
    public $cargo;
    public $contrasena;
}

if (isset($_POST['nombres'])) {
    $administrador = new administradorFull();
    $administrador->cedula = $_POST['cedula'];
    $administrador->nombres = $_POST['nombres'];
    $administrador->cargo = $_POST['cargo'];
    $administrador->contrasena = $_POST['contrasena'];
}

switch ($_POST['accion']) {
    case 'registrar':
        $PR = new Modelo_Administrador();
        $consulta = $PR->RegistrarAdministrador($administrador);
        echo json_encode($consulta);
        break;
    case 'eliminar':
        $PR = new Modelo_Administrador();
        $consulta = $PR->EliminarAdministrador($_POST['cedula']);
        echo json_encode($consulta);
        break;
    case 'actualizar':
        $PR = new Modelo_Administrador();
        $consulta = $PR->ActualizarAdministrador($administrador);
        echo json_encode($consulta);
        break;
    case 'listar':
        $PR = new Modelo_Administrador();
        $consulta = $PR->ListarAdministradores();
        echo json_encode($consulta);
        break;
    case 'consultar':
        $PR = new Modelo_Administrador();
        $consulta = $PR->ConsultarAdministrador($_POST['cedula']);
        echo json_encode($consulta);
        break;
    case 'nvt':
        $PR = new Modelo_Administrador();
        $consulta = $PR->ListarVehiculosPorTipo($_POST['tipoveh']);
        echo json_encode($consulta);
        break;
    case 'vif':
        $PR = new Modelo_Administrador();
        $consulta = $PR->ListarVehiculosIngresadosEntreFechas($_POST['finicio'], $_POST['ffinal']);
        echo json_encode($consulta);
        break;
    case 'vef':
        $PR = new Modelo_Administrador();
        $consulta = $PR->ListarVehiculosEgresadosEntreFechas($_POST['finicio'], $_POST['ffinal']);
        echo json_encode($consulta);
        break;
}
