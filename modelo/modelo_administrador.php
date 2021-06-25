<?php
class Modelo_Administrador
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

    function ListarAdministradores()
    {
        try {
            $comando = $this->pdo->prepare("CALL listaradministradores");
            $comando->execute();
            $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ConsultarAdministrador($id)
    {
        try {
            $comando = $this->pdo->prepare("CALL consultaradministrador(:id)");
            $comando->bindParam(':id', $id);
            $comando->execute();
            $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function RegistrarAdministrador($administrador)
    {
        try {
            $comando = $this->pdo->prepare("CALL registraradministrador(:cedula,:nombres,:cargo,:contrasena)");
            $comando->bindParam(':cedula', $administrador->cedula);
            $comando->bindParam(':nombres', $administrador->nombres);
            $comando->bindParam(':cargo', $administrador->cargo);
            $comando->bindParam(':contrasena', $administrador->contrasena);
            $comando->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function EliminarAdministrador($id)
    {
        try {
            $comando = $this->pdo->prepare("CALL eliminaradministrador(:id)");
            $comando->bindParam(':id', $id);
            $comando->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ActualizarAdministrador($administrador)
    {
        try {
            $comando = $this->pdo->prepare("CALL actualizaradministrador(:cedula,:nombres,:cargo,:contrasena)");
            $comando->bindParam(':cedula', $administrador->cedula);
            $comando->bindParam(':nombres', $administrador->nombres);
            $comando->bindParam(':cargo', $administrador->cargo);
            $comando->bindParam(':contrasena', $administrador->contrasena);
            $comando->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ListarVehiculosPorTipo($tipo)
    {
        try {
            $comando = $this->pdo->prepare("CALL consultarnumerovehiculosportipo(:tipo)");
            $comando->bindParam(':tipo', $tipo);
            $comando->execute();
            $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ListarVehiculosIngresadosEntreFechas($finicio, $ffinal)
    {
        try {
            $comando = $this->pdo->prepare("CALL consultarvehiculosingresadosentrefechas(:fi,:ff)");
            $comando->bindParam(':fi', $finicio);
            $comando->bindParam(':ff', $ffinal);
            $comando->execute();
            $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ListarVehiculosEgresadosEntreFechas($finicio, $ffinal)
    {
        try {
            $comando = $this->pdo->prepare("CALL consultarvehiculosegresadosentrefechas(:fi,:ff)");
            $comando->bindParam(':fi', $finicio);
            $comando->bindParam(':ff', $ffinal);
            $comando->execute();
            $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}