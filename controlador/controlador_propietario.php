<?php
require_once '../modelo/modelo_propietario.php';
require_once '../modelo/conexion.php';

class propietarioFull
{
    public $documento;
    public $tdocumento;
    public $nombres;
    public $apellidos;
    public $direccion;
    public $telefono;
    public $correo;
    public $fnacimiento;
    public $genero;
    public $tlicencia;
    public $nlicencia;
}

if(isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
    $propietario = new propietarioFull();
    if($usuario == "vigi") {
        $propietario->documento = $_POST['cedula'];
        $propietario->tdocumento = "";
        $propietario->nombres = "";
        $propietario->apellidos = "";
        $propietario->direccion = "";
        $propietario->telefono = "";
        $propietario->correo = "";
        $propietario->fnacimiento = date("Y-m-d");
        $propietario->genero = "";
        $propietario->tlicencia = "";
        $propietario->nlicencia = "";
    } else {
        $propietario->documento = $_POST['cedula'];
        $propietario->tdocumento = $_POST['tipoDocumento'];
        $propietario->nombres = $_POST['nombres'];
        $propietario->apellidos = $_POST['apellidos'];
        $propietario->direccion = $_POST['direccion'];
        $propietario->telefono = $_POST['telefono'];
        $propietario->correo = $_POST['correo'];
        $propietario->fnacimiento = $_POST['fechaNacimiento'];
        $propietario->genero = $_POST['genero'];
        $propietario->tlicencia = $_POST['tipoLicencia'];
        $propietario->nlicencia = $_POST['numeroLicencia'];
    }
}

switch ($_POST['accion']) {
    case 'registrar':
        $PR = new Modelo_Propietario();
        $consulta = $PR->RegistrarPropietario($propietario);
        echo json_encode($consulta);
        break;
    case 'eliminar':
        $PR = new Modelo_Propietario();
        $consulta = $PR->EliminarPropietario($_POST['cedula']);
        echo json_encode($consulta);
        break;
    case 'actualizar':
        $PR = new Modelo_Propietario();
        $consulta = $PR->ActualizarPropietario($propietario);
        echo json_encode($consulta);
        break;
    case 'listar':
        $PR = new Modelo_Propietario();
        $consulta = $PR->ListarPropietarios();
        echo json_encode($consulta);
        break;
    case 'consultar':
        $PR = new Modelo_Propietario();
        $consulta = $PR->ConsultarPropietario($_POST['cedula']);
        echo json_encode($consulta);
        break;
}
