<?php
class Modelo_Login
{
    private $pdo;
    public function __construct()
    {
        try {
            $this->pdo = conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public  function IniciarSesionAdministrador()
    {
        try {
            $comando = $this->pdo->prepare("CALL consultarloginadministrador(:documento,:password)");
            $documento = $_POST['user'];
            $password = $_POST['pass'];
            $comando->bindParam(':documento', $documento);
            $comando->bindParam(':password', $password);
            $comando->execute();
            $resultado = $comando->fetchAll();
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function IniciarSesionVigilante()
    {
        try {
            $comando = $this->pdo->prepare("CALL consultarloginvigilante(:documento,:password)");
            $documento = $_POST['user'];
            $password = $_POST['pass'];
            $comando->bindParam(':documento', $documento);
            $comando->bindParam(':password', $password);
            $comando->execute();
            $resultado = $comando->fetchAll();
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function IniciarRevisarVehiculo() {
        try {
            $comando = $this->pdo->prepare("CALL consultarregistroactivo(:cedula,:placa)");
            $documento = $_POST['documento'];
            $placa = $_POST['placa'];
            $comando->bindParam(':cedula', $documento);
            $comando->bindParam(':placa', $placa);
            $comando->execute();
            $resultado = $comando->fetchAll();
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
