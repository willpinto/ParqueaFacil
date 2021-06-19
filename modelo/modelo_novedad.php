<?php
class Modelo_Novedad
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

    function ListarNovedades()
    {
        try {
            $comando = $this->pdo->prepare("CALL listarnovedades");
            $comando->execute();
            $resultado = $comando->fetchAll();
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ConsultarNovedad($id)
    {
        try {
            $comando = $this->pdo->prepare("CALL consultarnovedad(:id)");
            $comando->bindParam(':id', $id);
            $comando->execute();
            $resultado = $comando->fetchAll();
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function RegistrarNovedad($novedad)
    {
        try {
            $comando = $this->pdo->prepare("CALL registrarnovedad(:tipo,:descripcion,:ticket)");
            $comando->bindParam(':tipo', $novedad->tipo);
            $comando->bindParam(':descripcion', $novedad->descripcion);
            $comando->bindParam(':ticket', $novedad->ticket);
            $comando->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function EliminarNovedad($id)
    {
        try {
            $comando = $this->pdo->prepare("CALL eliminarnovedad(:id)");
            $comando->bindParam(':id', $id);
            $comando->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ActualizarNovedad($novedad)
    {
        try {
            $comando = $this->pdo->prepare("CALL actualizarnovedad(:tipo,:descripcion,:ticket)");
            $comando->bindParam(':tipo', $novedad->tipo);
            $comando->bindParam(':descripcion', $novedad->descripcion);
            $comando->bindParam(':ticket', $novedad->ticket);
            $comando->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function CargarNovedadesPorNumeroTicket($id)
    {
        try {
            $comando = $this->pdo->prepare("CALL cargarNovedadesPorNumeroTicket(:id)");
            $comando->bindParam(':id', $id);
            $comando->execute();
            $resultado = $comando->fetchAll();
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}